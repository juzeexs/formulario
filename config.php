<?php

define('DB_HOST', getenv('MYSQLHOST') ?: 'localhost');
define('DB_USER', getenv('MYSQLUSER') ?: 'root');
define('DB_PASS', getenv('MYSQLPASSWORD') ?: '');
define('DB_NAME', getenv('MYSQLDATABASE') ?: 'cadastro_db');
define('DB_PORT', getenv('MYSQLPORT') ?: '3306');

function getConnection(): mysqli {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, (int)DB_PORT);

    if ($conn->connect_error) {
        http_response_code(500);
        die(json_encode([
            'success' => false,
            'message' => 'Erro de conexão: ' . $conn->connect_error
        ]));
    }

    $conn->set_charset('utf8mb4');
    return $conn;
}