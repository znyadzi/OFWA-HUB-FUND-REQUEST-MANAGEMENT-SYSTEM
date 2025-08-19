<?php
<?php
declare(strict_types=1);

// Simple JSON API for registration (returns JSON). Drop debug in production.
error_reporting(E_ALL);
ini_set('display_errors', '1');
header('Content-Type: application/json; charset=utf-8');

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Method not allowed']);
    exit;
}

// Collect inputs (use null coalescing; trim where useful)
$full_name = trim((string)($_POST['full_name'] ?? ''));
$email = trim((string)($_POST['email'] ?? ''));
$phone_number = trim((string)($_POST['phone_number'] ?? ''));
$user_role = trim((string)($_POST['user_role'] ?? 'Hub Lead'));
$hub_name = trim((string)($_POST['hub_name'] ?? ''));
$hub_location = trim((string)($_POST['hub_location'] ?? ''));
$username = trim((string)($_POST['username'] ?? ''));
$password = (string)($_POST['password'] ?? '');
$reason = trim((string)($_POST['reason_for_application'] ?? ''));

// Basic server-side validation
$errors = [];

if ($full_name === '') $errors[] = 'Full name is required';
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required';
if ($username === '') $errors[] = 'Username is required';
if ($password === '' || mb_strlen($password) < 6) $errors[] = 'Password must be at least 6 characters';
if ($hub_name === '') $errors[] = 'Hub name is required';

if (count($errors) > 0) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => implode('; ', $errors)]);
    exit;
}

// DB config (match your environment)
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

// Hash password
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Insert user
$sql = "INSERT INTO hub_lead_applications
    (full_name, email, phone_number, user_role, hub_name, hub_location, username, password_hash, reason_for_application)
    VALUES (:full_name, :email, :phone_number, :user_role, :hub_name, :hub_location, :username, :password_hash, :reason)";

$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([
        ':full_name' => $full_name,
        ':email' => $email,
        ':phone_number' => $phone_number ?: null,
        ':user_role' => $user_role ?: 'Hub Lead',
        ':hub_name' => $hub_name,
        ':hub_location' => $hub_location ?: null,
        ':username' => $username,
        ':password_hash' => $password_hash,
        ':reason' => $reason ?: null,
    ]);
    $newId = (int)$pdo->lastInsertId();
    http_response_code(201);
    echo json_encode([
        'ok' => true,
        'message' => 'Registration successful',
        'user_id' => $newId,
    ]);
    exit;
} catch (PDOException $e) {
    // Duplicate username or email error handling (MySQL error code 1062)
    $errorInfo = $e->errorInfo;
    if (isset($errorInfo[1]) && (int)$errorInfo[1] === 1062) {
        // Try to detect which unique field caused the duplicate from the message
        $msg = $e->getMessage();
        if (stripos($msg, 'email') !== false) {
            $friendly = 'Email is already registered';
        } elseif (stripos($msg, 'username') !== false) {
            $friendly = 'Username is already taken';
        } else {
            $friendly = 'A user with that email or username already exists';
        }
        http_response_code(409);
        echo json_encode(['ok' => false, 'error' => $friendly]);
        exit;
    }

    // Generic DB error
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'Database error']);
    exit;
}