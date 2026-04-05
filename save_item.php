<?php
$conn = new mysqli("127.0.0.1", "root", "", "system_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['itemName'];
$qty = $_POST['itemQty'];

$stmt = $conn->prepare("
    INSERT INTO inventory (item_name, quantity)
    VALUES (?, ?)");
$stmt->bind_param("ss", $name, $qty);

if ($stmt->execute()) {
    echo "Success! $qty units of $name were saved to the database.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();