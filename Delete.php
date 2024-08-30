<?php

require_once 'Database.php';

$database = new Database();
$conn = $database->conn();

$query = "DELETE FROM users WHERE id = :id"; 
$params = [':id' => 1]; 
$rowCount = $database->delete($query, $params); 

if ($rowCount) {
    echo "Məlumat silindi, Silinmiş sətir sayı: " . $rowCount; 
}


