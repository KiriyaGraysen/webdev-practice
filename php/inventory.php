<?php
require_once('database.php');

header('Content-Type: application/json');

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'get':
        $sql = "
            SELECT id, item_name, quantity
            FROM inventory
            WHERE status = 'active'
            ORDER BY id DESC
        ";
        $result = $conn->query($sql);
        $inventory = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $inventory[] = $row;
            }
        }
        echo json_encode($inventory);
        break;
        
    case 'create':
        $name = $_POST['itemName'];
        $qty = $_POST['itemQty'];
        $stmt = $conn->prepare("
            INSERT INTO inventory (item_name, quantity)
            VALUES (?, ?)
        ");
        $stmt->bind_param("si", $name, $qty);
        if ($stmt->execute()) {
            echo "Success! $qty units of $name were saved to the database.";
        } else {
            echo "Connection failed: " . $conn->connect_error;
        }
        $stmt->close();
        break;
    
    case 'update':
        $id = $_POST['id'];
        $name = $_POST['itemName'];
        $qty = $_POST['itemQty'];
        $stmt = $conn->prepare("
            UPDATE inventory
            SET item_name = ?, quantity = ?
            WHERE id = ?
        ");
        $stmt->bind_param("sii", $name, $qty, $id);
        if ($stmt->execute()) {
            echo "Successfully updated $name!";
        } else {
            echo "Connection failed: " . $conn->connect_error;
        }
        $stmt->close();
        break;
    
    case 'delete':
        $id = $_POST['id'];
        $stmt = $conn->prepare("
            UPDATE inventory
            SET status = 'archived'
            WHERE id = ?
        ");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "Deleted successfully!";
        } else {
            echo "Connection failed: " . $conn->connect_error;
        }
        $stmt->close();
        break;
        
    default:
        echo "Invalid API action requested.";
        break;
}

$conn->close();