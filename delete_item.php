<?php
session_start();
require_once("db_connect.php");

if (isset($_POST['cartItemId'])) {
    $cartItemId = $_POST['cartItemId'];
    
    $deleteQuery = "DELETE FROM shopping_cart WHERE id = '$cartItemId'";
    $deleteResult = $conn->query($deleteQuery);

    if ($deleteResult) {
        echo "Item deleted successfully";
        
    } else {
        echo "Error deleting item";
    }
    
    $conn->close();
} else {
    echo "Invalid request";
}
?>
