<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <style>
        *{
            font-family: Arial, sans-serif;
            background-color: purple;
            color: white;
            font-weight: bold;

        }

        

        h2 {
            text-align: center;
        }

        .item {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .item h3 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .item p {
            margin: 0;
        }
    </style>
</head>
</html>
<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "groceries";

$conn = new mysqli($hostname, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM items";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Item ID: " . $row["itemID"] . "<br>";
        echo "Item Name: " . $row["itemName"] . "<br>";
        echo "Item Price: " . $row["itemPrice"] . "<br>";
        echo "Item Quantity: " . $row["itemQuantity"] . "<br>";
        echo "<br>";
    }
} else {
    echo "No items found in the database.";
}

$conn->close();
?>