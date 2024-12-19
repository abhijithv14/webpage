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

function resetQuantity($conn) {
    $reset_sql = "UPDATE burgers SET quantity = 0";
    if ($conn->query($reset_sql) !== TRUE) {
        echo "Error resetting quantity: " . $conn->error;
    }
}

function placeOrder($conn) {
    resetQuantity($conn);
    session_destroy();
    echo "<h1 class='no-items' style='color: green; text-align: center;'>Order Placed Sucessfully!!!</h1>";
    exit();
}

function cancelOrder($conn) {
    resetQuantity($conn);
    session_destroy();
    echo "<h1 class='no-items' style='color: red; text-align: center;'>Order Cancelled.... </h1>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['place_order'])) {
        placeOrder($conn);
    } elseif (isset($_POST['cancel_order'])) {
        cancelOrder($conn);
    }
}

// Fetch items from burgers table with quantity > 0
$sql = "SELECT * FROM burgers WHERE quantity > 0";
$result = $conn->query($sql);

echo "<div style='text-align: center;'>";
if ($result->num_rows > 0) {
    // Output items in a table format
    echo "<table style='margin: 0 auto; border-spacing: 15px;'>";
    echo "<tr><th>Item</th><th>Quantity</th><th>Price</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["quantity"] . "</td>";
        echo "<td>Rs" . ($row["rate"] * $row["quantity"]) . "</td>";
        echo "</tr>";
    }
    echo "<tr><td colspan='2'>Total Price</td><td>Rs";
    $sql = "SELECT SUM(rate * quantity) AS total FROM burgers WHERE quantity > 0";
    $total_result = $conn->query($sql);
    $total_row = $total_result->fetch_assoc();
    echo $total_row["total"];
    echo "</td></tr>";
    echo "</table>";

    // Add buttons for Place Order and Cancel
    echo "<div style='margin-top: 20px;'>";
    echo "<form method='post' style='display: inline;'>";
    echo "<input type='submit' name='place_order' value='Place Order' style='padding: 10px 20px;'>";
    echo "<input type='submit' name='cancel_order' value='Cancel' style='padding: 10px 20px; margin-left: 20px;'>";
    echo "</form>";
    echo "</div>";
} else {
    // Output message when there are no items in cart
    echo "<h1 class='no-items' style='color: red; text-align: center;'>No items in cart</h1>";
}
echo "</div>";

$conn->close();
?>
