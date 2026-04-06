<?php
require_once('php/database.php');

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