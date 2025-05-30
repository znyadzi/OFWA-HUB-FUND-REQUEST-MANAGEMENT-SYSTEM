<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
    session_start();
    include "../../Resources/Datacon.php";
    $querychlog = "SELECT * FROM `AdminLogs`";
	$resultadminlog = mysqli_fetch_assoc(mysqli_query($conn,$querychlog));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>RMU Diagnostic System | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
    <link rel="stylesheet" href="dashboard.css">
    <link href="bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap.bundle.js"></script>

</head>

<body>
    <?php
    if (!($resultadminlog)) {
        session_destroy();
        echo "<script> window.location='../Login'; </script>";
    }
    if (!isset($_SESSION['UserName']) && !(isset($_SESSION['Account_Type']))) {
        echo "<script> alert('User Must Be Logged In !!!'); window.location='../Login'; </script>";
    } else {
        ?>
        <div class="col">
            <div class="left_sideBar" style="">
                <p style="position:fixed; right: 20px; " id="Usersname"> </p>
                <h3>Administrator</h3>
                <div style="margin-top:10%; ">
                    <div class="options_select" id="viewStaff" onclick="
                                    document.getElementById('View_Staff_View').style.display = 'block';
                                    document.getElementById('Add_Staff_View').style.display = 'none';
                                ">
                        <h3>View Health Workers</h3>
                    </div>
                    <div class="options_select" id="addStaff" id="viewStaff" onclick="
                                    document.getElementById('View_Staff_View').style.display = 'none';
                                    document.getElementById('Add_Staff_View').style.display = 'block';
                                ">
                        <h3>Add Health Workers</h3>
                    </div>
                    <div class="options_select" id="logout" onclick="window.location='logout.php';">
                        <h3>Logout</h3>
                    </div>
                </div>
            </div>
            <div class="right_sidebar">
                <?php

                // Fetch data from the Health Care Professional table
                $query = "SELECT * FROM UserTables";
                $result = mysqli_query($conn, $query);

                // Table Header Display ?>
                <div style="display: block; " id="View_Staff_View"><?php
                echo '<h1 style="width: 100%; text-align: center; margin-bottom: 2%;  " >List of Health Workers</h1>';
                echo '<div>';
                echo '<table class="decorative-table">';
                echo '<tr>';
                echo '<th style="width:10%;" >ID</th>';
                echo '<th>Full Name</th>';
                echo '<th>Email</th>';
                echo '<th>Telephone</th>';
                echo '<th>User Type</th>';
                echo '<th>Action</th>';
                echo '</tr>';
                $Table_Id = 0;

                // Table Content Display
                while ($row = mysqli_fetch_assoc($result)) {
                    $Table_Id += 1;
                    echo '<tr>';
                    echo '<td>' . $Table_Id . '</td>';
                    echo '<td>' . $row['FullName'] . '</td>';
                    echo '<td>' . $row['Email'] . '</td>';
                    echo '<td>' . $row['Telephone'] . '</td>';
                    echo '<td>' . $row['AccountType'] . '</td>';
                    echo '<td><button class="delete-button" onclick="deleteUser(' . $row['ID'] . ')" name="Delete_">Edit</button></td>';
                    echo '</tr>';
                }

                echo '</table>';
                echo '</div>'; ?>
                </div>
                <script>
                    function deleteUser(tableId) {
                        if (confirm("Are you sure you want to Edit this User's Details?")) {
                            // Send an AJAX request to delete_User.php
                            var xhttp = new XMLHttpRequest();
                            xhttp.onreadystatechange = function () {
                                if (this.readyState == 4 && this.status == 200) {
                                    // Handle the response from the server, if needed
                                    console.log(this.responseText);
                                    // Reload the page or update the UI as necessary
                                    location.reload();
                                }
                            }
                        }
                        xhttp.open("GET", "deleteUser.php?table_id=" + tableId, true);
                        xhttp.send();
                    }
                </script>


                <div id="Add_Staff_View" style="display: none;">
                    <h1 style="width: 100%; text-align: center; margin-bottom: 2%; ">Register a new Health Worker</h1>
                    <form name="registerUser" action="registerUser.php" method="post">

                        <label style="" for="Fullname">Username:</label>
                        <input type="text" id="Username" placeholder="Enter a Prefered Username" name="Username" required>

                        <label for="FullName">Full Name:</label>
                        <input type="text" placeholder="Enter your Full Name" id="FullName" name="FullName" required>

                        <label for="Email">Email:</label>
                        <input type="email" placeholder="Enter your Email Address" id="Email" name="Email" required>

                        <label for="Telephone">Telephone:</label>
                        <input type="number" placeholder="Telephone" id="Telephone" name="Telephone" required>

                        <label for="Address">Address:</label>
                        <input type="text" placeholder="Enter your Residential Address" id="Address" name="Address"
                            required>

                        <label for="Account Type" style=" margin-bottom:15px;">Account Type:</label>
                        <select id="AccountType" name="AccountType" required>
                            <option value="Nurse">Nurse</option>
                            <option value="Doctor">Doctor</option>
                            <option value="Cashier">Cashier</option>
                            <option value="Physician">Physician</option>
                        </select>

                        <input style="margin-bottom:20px;margin-top:30px" id="reg_submit_button" name="registerUser"
                            type="submit" value="Register">
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <script src="index.js"></script>
</body>

</html>