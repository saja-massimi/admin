<?php

require './dbConnection.php';

if(isset($_GET['id'])) {
    $item_id = $_GET['id'];
    $query = "UPDATE items SET is_deleted = 1 WHERE item_id = :item_id";
    $statement = $conn->prepare($query);
    $statement->bindParam(':item_id', $item_id);
    if ($statement->execute()) {
        echo "Item soft deleted successfully.";
    } else {
        echo "Error soft deleting item.";
    }
}


?>
