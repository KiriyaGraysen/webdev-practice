<?php
$conn = new mysqli("127.0.0.1", "root", "", "system_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "
    SELECT id, item_name, quantity
    FROM inventory
    ORDER BY id DESC
    ";
$result = $conn->query($sql);

$inventory = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $inventory[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($inventory);

$conn->close();