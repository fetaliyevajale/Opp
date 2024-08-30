<?php

require_once 'Database.php';

$database = new Database();
$conn = $database->conn();

$query = "SELECT * FROM users WHERE id = :id"; 
$params = [':id' => 1]; 
$user = $database->selectOne($query, $params); 

if ($user) {
    echo "Ad: " . $user['name'] . ", Email: " . $user['email']; 
}


