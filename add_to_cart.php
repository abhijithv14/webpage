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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['quantity'])) {
        $itemId = intval($_POST['id']);
        $quantity = intval($_POST['quantity']);

        // Update the quantity in the burgers table
        $stmt = $conn->prepare("UPDATE burgers SET quantity = ? WHERE id = ?");
        $stmt->bind_param("ii", $quantity, $itemId);

        if ($stmt->execute()) {
            echo "Item quantity updated successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Invalid input";
    }
}

$conn->close();
?>
