<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "groceries";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$itemID = $_POST["itemID"];

$sql = "DELETE FROM items WHERE itemID='$itemID'";

if ($conn->query($sql) === TRUE) {
    echo "Item deleted successfully";
    exit;
} else {
    echo '<div class="error">Error deleting item: ' . $conn->error . '</div>';
}

$conn->close();
?>