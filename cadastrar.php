<?php
// =============================================
//  ENDPOINT: Cadastro de usuário
//  Método: POST
//  Campos: nome, email, senha
// =============================================

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

require_once 'config.php';

// Só aceita POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
    exit;
}

// Lê e valida os dados recebidos
$nome  = trim($_POST['nome']  ?? '');
$email = trim($_POST['email'] ?? '');
$senha = trim($_POST['senha'] ?? '');

$erros = [];

if (empty($nome) || strlen($nome) < 2) {
    $erros[] = 'Nome inválido (mínimo 2 caracteres).';
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erros[] = 'E-mail inválido.';
}

if (strlen($senha) < 6) {
    $erros[] = 'A senha deve ter pelo menos 6 caracteres.';
}

if (!empty($erros)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => implode(' ', $erros)]);
    exit;
}

// Conecta ao banco
$conn = getConnection();

// Verifica se o e-mail já existe
$stmt = $conn->prepare('SELECT id FROM usuarios WHERE email = ? LIMIT 1');
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->close();
    $conn->close();
    http_response_code(409);
    echo json_encode(['success' => false, 'message' => 'E-mail já cadastrado.']);
    exit;
}
$stmt->close();

// Hash seguro da senha
$senhaHash = password_hash($senha, PASSWORD_BCRYPT);

// Insere o usuário
$stmt = $conn->prepare('INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)');
$stmt->bind_param('sss', $nome, $email, $senhaHash);

if ($stmt->execute()) {
    $novoId = $stmt->insert_id;
    $stmt->close();
    $conn->close();

    http_response_code(201);
    echo json_encode([
        'success' => true,
        'message' => 'Conta criada com sucesso!',
        'id'      => $novoId
    ]);
} else {
    $stmt->close();
    $conn->close();

    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro ao cadastrar. Tente novamente.']);
}