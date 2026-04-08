<?php
// =============================================
//  CONFIGURAÇÃO DO BANCO DE DADOS
//  Ajuste as credenciais conforme seu ambiente
// =============================================

define('DB_HOST', 'localhost');
define('DB_USER', 'root');        // usuário do phpMyAdmin
define('DB_PASS', '');            // senha do phpMyAdmin (vazio no XAMPP padrão)
define('DB_NAME', 'cadastro_db'); // nome do banco de dados

// Cria conexão
function getConnection(): mysqli {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        http_response_code(500);
        die(json_encode([
            'success' => false,
            'message' => 'Erro de conexão com o banco de dados: ' . $conn->connect_error
        ]));
    }

    $conn->set_charset('utf8mb4');
    return $conn;
}