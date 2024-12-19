<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to update quantity to zero for all items in the burgers table
$sql = "UPDATE burgers SET quantity = 0";

if ($conn->query($sql) === TRUE) {
   // Redirect to login page
    header("Location: Login_Page_P.html");}
 else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
