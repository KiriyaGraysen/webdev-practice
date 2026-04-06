<?php
require_once('php/database.php');

$id = $_POST['id'];
$name = $_POST['itemName'];
$qty = $_POST['itemQty'];

$stmt = $conn->prepare("
    UPDATE inventory SET item_name = ?, quantity = ? WHERE id = ?
");
$stmt->bind_param("ssi", $name, $qty, $id);

if ($stmt->execute()) {
    echo "Successfully updated $name!";
} else {
    echo "Error updating record: " . $stmt->error;
}

$stmt->close();
$conn->close();