<?php

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

session_start();

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
    exit;
}

$email = trim($_POST['email'] ?? '');
$senha = trim($_POST['senha'] ?? '');

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($senha)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'E-mail ou senha inválidos.']);
    exit;
}

$conn = getConnection();

$stmt = $conn->prepare('SELECT id, nome, email, senha FROM usuarios WHERE email = ? LIMIT 1');
$stmt->bind_param('s', $email);
$stmt->execute();

$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
$stmt->close();
$conn->close();

if (!$usuario || !password_verify($senha, $usuario['senha'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'E-mail ou senha incorretos.']);
    exit;
}

$_SESSION['usuario_id']   = $usuario['id'];
$_SESSION['usuario_nome'] = $usuario['nome'];

echo json_encode([
    'success' => true,
    'message' => 'Login realizado com sucesso!',
    'usuario' => [
        'id'    => $usuario['id'],
        'nome'  => $usuario['nome'],
        'email' => $usuario['email'],
    ]
]);