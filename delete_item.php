<?php
require_once('php/database.php');

$id = $_POST['id'];

$stmt = $conn->prepare("
    DELETE FROM inventory WHERE id = ?
");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Item permanently deleted.";
} else {
    echo "Error deleting record: " . $stmt->error;
}

$stmt->close();
$conn->close();