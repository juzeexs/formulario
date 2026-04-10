<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>
  <div class="welcome-card">
    <p class="welcome-label">Sessão ativa</p>
    <h1>Bem-vindo, <span><?= htmlspecialchars($_SESSION['usuario_nome']) ?>!</span></h1>
    <p class="welcome-subtitle">Você está autenticado com sucesso.</p>
    <div class="divider"></div>
    <a href="logout.php" class="btn-logout">Sair da conta</a>
  </div>
</body>
</html>