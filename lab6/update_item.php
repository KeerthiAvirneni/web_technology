
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
    $itemId = $_POST["itemID"];
    $itemName = $_POST["itemName"];
    $itemPrice = $_POST["itemPrice"];
    $itemQuantity = $_POST["itemQuantity"];

    $stmt = $conn->prepare("UPDATE items SET itemName = ?, itemPrice = ?, itemQuantity = ? WHERE itemID = ?");
    $stmt->bind_param("ssdi", $itemName, $itemPrice, $itemQuantity, $itemID);

    if ($stmt->execute()) {
        echo "Item updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>