<?php

require './dbConnection.php';

if(isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $query = "UPDATE user SET is_deleted = 1 WHERE user_id = :user_id";
    $statement = $conn->prepare($query);
    $statement->bindParam(':user_id', $user_id);
    if ($statement->execute()) {
        echo "Item soft deleted successfully.";
    } else {
        echo "Error soft deleting item.";
    }
}


?>
