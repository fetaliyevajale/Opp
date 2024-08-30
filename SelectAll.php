<?php

require_once 'Database.php';

$database = new Database();
$conn = $database->conn();

$query = "SELECT * FROM users"; 
$users = $database->selectAll($query);

foreach ($users as $user) {
    echo $user['name'] . ' - ' . $user['email'] . '<br>'; # istifadəçilerin adını və emailini göstəririk.
}


