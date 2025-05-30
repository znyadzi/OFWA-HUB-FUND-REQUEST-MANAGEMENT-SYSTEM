<?php
// Check if the table_id parameter is set
if (isset($_GET['table_id'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        
    </body>
    </html>
    <?php
    // Retrieve the table_id value
    $tableId = $_GET['table_id'];

    // Perform necessary input validation and security checks before executing the query

    // Connect to your database
    include "datacon.php";

    // Prepare and execute the DELETE query
    $sql = "DELETE FROM UserTables WHERE ID = '$tableId'";
    if (mysqli_query($conn, $sql)) {
        // Deletion successful
        echo "User Details deleted successfully";
    } else {
        // Deletion failed
        echo "Error deleting User Details : " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // Handle the case when the table_id parameter is not set
    echo "Invalid request";
}
?>
