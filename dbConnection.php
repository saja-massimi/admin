<?php

$path = "localhost";
$user = "root";
$pass = "";
$db = "admin";

try{
    $conn = new PDO("mysql:host=$path;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}



?>