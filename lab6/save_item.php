<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "groceries";

$conn = new mysqli($hostname, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemName = $_POST["itemName"];
    $itemID = $_POST["itemID"];
    $itemPrice = $_POST["itemPrice"];
    $itemQuantity = $_POST["itemQuantity"];

    $stmt = $conn->prepare("INSERT INTO items (itemName, itemID, itemPrice, itemQuantity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $itemName, $itemID, $itemPrice, $itemQuantity);

    if ($stmt->execute()) {
        echo "Item added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
