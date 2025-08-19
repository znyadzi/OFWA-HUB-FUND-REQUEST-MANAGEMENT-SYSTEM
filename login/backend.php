<?php
// backend.php - login verifier for hub_lead_applications
// GitHub Copilot

declare(strict_types=1);

// Development helpers (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', '1');

header('Content-Type: application/json; charset=utf-8');

session_start();

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Method not allowed']);
    exit;
}

// Accept either email or username field names from the form/client
$emailOrUser = trim((string)($_POST['email'] ?? $_POST['user'] ?? $_POST['username'] ?? ''));
$password = (string)($_POST['password'] ?? '');

if ($emailOrUser === '' || $password === '') {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Missing credentials']);
    exit;
}

// Database configuration - adjust to your environment (MAMP defaults shown)
$dbHost = '127.0.0.1';
$dbPort = '8889';
$dbName = 'loginPortal';
$dbUser = 'root';
$dbPass = 'root';
$dsn = "mysql:host={$dbHost};port={$dbPort};dbname={$dbName};charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'Database connection failed']);
    exit;
}

// Find user by username OR email in hub_lead_applications
$sql = 'SELECT id, username, email, full_name, password_hash
        FROM hub_lead_applications
        WHERE username = :u OR email = :u
        LIMIT 1';
$stmt = $pdo->prepare($sql);
$stmt->execute([':u' => $emailOrUser]);
$user = $stmt->fetch();

if (!$user) {
    // Do not reveal whether username/email exists
    http_response_code(401);
    echo json_encode(['ok' => false, 'error' => 'Invalid credentials']);
    exit;
}

// Verify password (assumes password_hash() was used when registering)
if (!password_verify($password, $user['password_hash'])) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'error' => 'Invalid credentials']);
    exit;
}

// Successful login: regenerate session id and store minimal info
session_regenerate_id(true);
$_SESSION['user_id'] = (int)$user['id'];
$_SESSION['username'] = $user['username'];
$_SESSION['email'] = $user['email'];
$_SESSION['full_name'] = $user['full_name'] ?? '';

// Respond with success (do not return password_hash)
echo json_encode([
    'ok' => true,
    'message' => 'Login successful',
    'user' => [
        'id' => (int)$user['id'],
        'username' => $user['username'],
        'email' => $user['email'],
        'full_name' => $user['full_name'] ?? null,
    ],
]);
exit;