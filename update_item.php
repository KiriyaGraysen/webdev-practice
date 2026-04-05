<?
$conn = new mysqli("127.0.0.1", "root", "", "system_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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