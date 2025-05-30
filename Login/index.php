<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "datacon.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="bootstrap-5.3.2-dist/css/bootstrap_1.min.css">
	<link rel="stylesheet" href="stylesheet.css">
	<title>User | Login </title>
</head>

<body>
	<?php
	if (isset($_SESSION['UserName']) && ($_SESSION['Account_Type'])) {
		echo "<script> alert('User Already Logged In');</script>";
		if ($_SESSION['Account_Type'] == "Nurse") {
			header("Location:../NursesDashboard");
		} else if ($_SESSION['Account_Type'] == "Doctor") {
			header("Location:../DoctorsDashboard");
		} else if ($_SESSION['Account_Type'] == "Cashier") {
			header("Location:../DoctorsDashboard");
		} else if ($_SESSION['Account_Type'] == "Physic") {
			header("Location:../DoctorsDashboard");
		}
	} else {

		if (mysqli_connect_errno()) {
			echo "<script> alert('No connection to database!!!');</script>";
		} else {
			?>
			<div style="height:100vh;">
				<h1 style=" margin-top: 10vh; ">User Login Page</h1>
				<form style="margin-top: 5vh;" name="login" method="post">
					<label style=" margin-top:20px; " for="username">Username:</label>
					<input type="text" id="username" placeholder="Username" name="UserName" required>

					<label for="password">Password:</label>
					<input type="password" placeholder="Password" id="password" name="PassWord" required>

					<input style="margin-bottom:20px" name="LogIn" type="submit" value="Sign In">

					<p><a href="./forgotpassword.php">Forgot password?</a></p>
				</form>
			</div>
			<!-- The Full-Screen Popup Modal -->

			<!-- Include Bootstrap JS from a CDN -->
			<script src="JavaScript/jquery-3.5.1/slim.min.js"></script>
			<script src="JavaScript/jsdelivr/popper.min.js"></script>
			<script src="bootstrap-5.3.2-dist/js/bootstrap_1.min.js"></script>

			<!-- <script>
						// JavaScript functions to redirect to different URLs
						function redirectToOption1() {
							window.location.href = '../Register/';
						}

						function redirectToOption2() {
							window.location.href = '../Register';
						}
					</script> -->

			<?php
			if (isset($_POST['LogIn'])) {
				$User__Name = mysqli_real_escape_string($conn, $_POST['UserName']);
				$passwordhash = mysqli_real_escape_string($conn, $_POST['PassWord']);
				$sql = "SELECT * FROM UserTables WHERE username = '$User__Name'";
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) {
					$row = mysqli_fetch_assoc($result);
					$pass_db = $row['Password'];
					$Account_Type = $row['AccountType'];
					if (password_verify($passwordhash, $pass_db)) {
						$_SESSION["UserName"] = $User__Name;
						$_SESSION["Account_Type"] = $Account_Type;
						if ($_SESSION['Account_Type'] == "Nurse") {
							header("Location:../NursesDashboard");
						} else if ($_SESSION['Account_Type'] == "Doctor") {
							header("Location:../DoctorsDashboard");
						} else if ($_SESSION['Account_Type'] == "Cashier") {
							header("Location:../AccountantsDashboard");
						} else if ($_SESSION['Account_Type'] == "Physic") {
							header("Location:../PhysiciansDashboard");
						}
					} else {
						echo (" <script>alert('Invalid Credentials !!!')</script>");
					}
				} else {
					echo (" <script>alert('Invalid Credentials !!!')</script>");
				}
			}
			if (isset($_POST['Doctor'])) {
				$_SESSION["RegType"] = "Doctor";

			} else if (isset($_POST['Nurse'])) {
				$_SESSION["RegType"] = "Nurse";
			}
		}
	}

	?>

</body>

</html>