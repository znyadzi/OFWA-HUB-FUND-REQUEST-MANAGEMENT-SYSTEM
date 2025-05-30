<?php
session_start();
include "datacon.php";
if (isset($_POST['registerUser'])) {

    $Username = mysqli_real_escape_string($conn, $_POST['Username']);
    $FullName = mysqli_real_escape_string($conn, $_POST['FullName']);
    $Email = mysqli_real_escape_string($conn, $_POST['Email']);
    $Telephone = mysqli_real_escape_string($conn, $_POST['Telephone']);
    // Generating Password:
    $firstThreeName = substr($FullName, 0, 3);
    $lastThreePhone = substr($Telephone, -3);
    $passwordhash = $firstThreeName . $lastThreePhone . '@123';
    
    $Pass_Word = password_hash($passwordhash, PASSWORD_BCRYPT);
    $Address = mysqli_real_escape_string($conn, $_POST['Address']);
    $AccountType = mysqli_real_escape_string($conn, $_POST['AccountType']);

    $sql = " INSERT INTO `UserTables` (`FullName`, `Username`, `Password`, `Email`, `Telephone`, `UserAddress`, `AccountType`)
        VALUES ('$FullName', '$Username', '$Pass_Word', '$Email', '$Telephone', '$Address',  '$AccountType')";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo (" <script>alert('Please check your inputs and try again');window.location:'../Dashboard</script>");
    } else {
        echo (" <script>alert('Health Personnel Added Successfully');</script>");
    }
    echo "<script> window.location='../Dashboard'; </script>";
}