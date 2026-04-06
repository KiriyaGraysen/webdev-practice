<?php
require_once('php/database.php');

$name = $_POST['itemName'];
$qty = $_POST['itemQty'];

$stmt = $conn->prepare("
    INSERT INTO inventory (item_name, quantity)
    VALUES (?, ?)
");
$stmt->bind_param("ss", $name, $qty);

if ($stmt->execute()) {
    echo "Success! $qty units of $name were saved to the database.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();