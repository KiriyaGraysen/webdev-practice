<?php
$conn = new mysqli("127.0.0.1", "root", "", "system_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['itemName'];
$qty = $_POST['itemQty'];

$sql = "
    INSERT INTO inventory (item_name, quantity)
    VALUES ('$name', '$qty')";

if ($conn->query($sql) === TRUE) {
    echo "Success! $qty units of $name were saved to the database.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();

?>