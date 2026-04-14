<?php
$host = getenv('MYSQLHOST') ?: 'localhost'; 
$user = getenv('MYSQLUSER') ?: 'root'; 
$pass = getenv('MYSQLPASSWORD') ?: ''; 
$db   = getenv('MYSQLDATABASE') ?: 'cadastro_db';
$port = getenv('MYSQLPORT') ?: '3306';

$conn = new mysqli($host, $user, $pass, $db, $port);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

?>