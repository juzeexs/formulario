<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Cadastro Animado</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

    <!-- Mensagem de feedback (toast) -->
    <div id="toast" class="toast"></div>

    <div class="container" id="container">

        <!-- ===== FORMULÁRIO DE CADASTRO ===== -->
        <div class="form-container sign-up">
            <form id="formCadastro">
                <h1>Criar Conta</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>ou use seu e-mail para o cadastro</span>
                <input type="text"     id="cad-nome"  name="nome"  placeholder="Nome" required>
                <input type="email"    id="cad-email" name="email" placeholder="E-mail" required>
                <input type="password" id="cad-senha" name="senha" placeholder="Senha (mín. 6 caracteres)" required minlength="6">
                <button type="submit" id="btnCadastrar">Cadastrar</button>
            </form>
        </div>

        <!-- ===== FORMULÁRIO DE LOGIN ===== -->
        <div class="form-container sign-in">
            <form id="formLogin">
                <h1>Entrar</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>ou use sua senha de e-mail</span>
                <input type="email"    id="login-email" name="email" placeholder="E-mail" required>
                <input type="password" id="login-senha" name="senha" placeholder="Senha" required>
                <a href="#">Esqueceu sua senha?</a>
                <button type="submit" id="btnEntrar">Entrar</button>
            </form>
        </div>

        <!-- ===== PAINEL DE TRANSIÇÃO ===== -->
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Bem-vindo de volta!</h1>
                    <p>Insira seus dados pessoais para utilizar todos os recursos do site</p>
                    <button class="hidden" id="login">Entrar</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Olá, Amigo!</h1>
                    <p>Cadastre-se com seus dados pessoais para utilizar todos os recursos do site</p>
                    <button class="hidden" id="register">Cadastrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script>
    // =============================================
    //  FUNÇÕES AUXILIARES
    // =============================================

    function showToast(msg, tipo = 'sucesso') {
        const toast = document.getElementById('toast');
        toast.textContent = msg;
        toast.className = 'toast show ' + tipo;
        setTimeout(() => toast.className = 'toast', 3500);
    }

    function setLoading(btn, loading) {
        btn.disabled = loading;
        btn.style.opacity = loading ? '0.7' : '1';
        btn.textContent = loading
            ? 'Aguarde...'
            : (btn.id === 'btnCadastrar' ? 'Cadastrar' : 'Entrar');
    }

    // =============================================
    //  CADASTRO — envia para cadastrar.php
    // =============================================
    document.getElementById('formCadastro').addEventListener('submit', async function (e) {
        e.preventDefault();

        const btn = document.getElementById('btnCadastrar');
        setLoading(btn, true);

        const dados = new FormData(this);

        try {
            const res  = await fetch('cadastrar.php', { method: 'POST', body: dados });
            const json = await res.json();

            if (json.success) {
                showToast(json.message, 'sucesso');
                this.reset();
                // Volta para o painel de login após cadastro bem-sucedido
                setTimeout(() => {
                    document.getElementById('container').classList.remove('active');
                }, 1000);
            } else {
                showToast(json.message, 'erro');
            }
        } catch (err) {
            showToast('Erro de comunicação com o servidor.', 'erro');
        } finally {
            setLoading(btn, false);
        }
    });

    // =============================================
    //  LOGIN — envia para login.php
    // =============================================
    document.getElementById('formLogin').addEventListener('submit', async function (e) {
        e.preventDefault();

        const btn = document.getElementById('btnEntrar');
        setLoading(btn, true);

        const dados = new FormData(this);

        try {
            const res  = await fetch('login.php', { method: 'POST', body: dados });
            const json = await res.json();

            if (json.success) {
                showToast('Olá, ' + json.usuario.nome + '! Bem-vindo(a)!', 'sucesso');
                this.reset();
                // Redireciona após 1.5s (ajuste o destino conforme necessário)
                setTimeout(() => {
                    window.location.href = 'dashboard.php';
                }, 1500);
            } else {
                showToast(json.message, 'erro');
            }
        } catch (err) {
            showToast('Erro de comunicação com o servidor.', 'erro');
        } finally {
            setLoading(btn, false);
        }
    });
    </script>
</body>
</html>