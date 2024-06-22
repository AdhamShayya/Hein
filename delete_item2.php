<?php
session_start();
require_once("db_connect.php");
    $item_id = $_POST['item_id'];
    $category = $_POST['category'];

if ($category === 'Sdelete') {
    $delete_query = "DELETE FROM starters WHERE id = $item_id";
} elseif ($category === 'Bdelete') {
    $delete_query = "DELETE FROM breakfast WHERE id = $item_id";
} elseif ($category === 'Ddelete') {
    $delete_query = "DELETE FROM dinner WHERE id = $item_id";
} else {
    echo "Invalid category";
    exit;
}

if (mysqli_query($conn, $delete_query)) {
    echo "Item deleted successfully";
} else {
    echo "Error deleting item: " . mysqli_error($conn);
}

mysqli_close($conn);
?>