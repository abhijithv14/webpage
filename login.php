<?php
session_start();

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username exists
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the user data
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, start a session
            $_SESSION['username'] = $username;

            // Reset quantity in burgers table to 0
            $reset_sql = "UPDATE burgers SET quantity = 0";
            if ($conn->query($reset_sql) === TRUE) {
                // Redirect to home page
                header("Location: Home_Page_P.html");
                exit();
            } else {
                echo "Error resetting quantity: " . $conn->error;
            }
        } else {
            // Password is incorrect
            echo "<script>alert('Incorrect password'); window.location.href='Login_Page_P.html';</script>";
        }
    } else {
        // Username does not exist
        echo "<script>alert('Username does not exist'); window.location.href='Login_Page_P.html';</script>";
    }
    exit();
}

$conn->close();
?>

