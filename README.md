# 🔐 Formulário de Login & Cadastro Animado

> Interface de autenticação com animação de transição, integração com banco de dados MySQL e sessões PHP.

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=flat-square&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=flat-square&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=flat-square&logo=javascript&logoColor=black)

---

## 📸 Preview

> Tela de login e cadastro com transição animada entre os painéis, feedback via toast e redirecionamento para o dashboard.

---

## ✨ Funcionalidades

- **Cadastro de usuário** com validação de campos (nome, e-mail, senha)
- **Login seguro** com verificação de senha via `password_verify()` (bcrypt)
- **Sessão PHP** para manter o usuário autenticado
- **Dashboard** de boas-vindas pós-login
- **Animação de transição** suave entre os painéis de login e cadastro
- **Toast de feedback** para sucesso e erro
- **Proteção contra e-mail duplicado** no cadastro
- **Variáveis de ambiente** para configuração do banco (compatível com Railway, PlanetScale etc.)

---

## 🗂️ Estrutura de Arquivos

```
/
├── index.php        # Página principal com os formulários de login e cadastro
├── login.php        # Endpoint POST — autentica o usuário e inicia sessão
├── cadastrar.php    # Endpoint POST — valida e registra novo usuário
├── dashboard.php    # Página protegida (exige sessão ativa)
├── config.php       # Configuração e função de conexão com o banco
├── conexao.php      # Conexão direta alternativa (legado)
├── style.css        # Estilos da página de login/cadastro
├── dashboard.css    # Estilos do dashboard
└── script.js        # Animação de alternância entre os painéis
```

---

## 🛠️ Tecnologias Utilizadas

| Camada      | Tecnologia                        |
|-------------|-----------------------------------|
| Back-end    | PHP 8.x                           |
| Banco       | MySQL (via MySQLi)                |
| Front-end   | HTML5, CSS3, JavaScript (Vanilla) |
| Tipografia  | Google Fonts — Montserrat         |
| Ícones      | Font Awesome 6                    |
| Segurança   | bcrypt (`PASSWORD_BCRYPT`)        |

---

## ⚙️ Como Rodar Localmente

### Pré-requisitos

- PHP 8.x
- MySQL 5.7+ ou MariaDB
- Servidor local: [XAMPP](https://www.apachefriends.org/), [Laragon](https://laragon.org/) ou similar

### Passo a passo

**1. Clone o repositório**

```bash
git clone https://github.com/juzeexs/Formulario.git
cd Formulario
```

**2. Crie o banco de dados**

```sql
CREATE DATABASE cadastro_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE cadastro_db;

CREATE TABLE usuarios (
  id       INT AUTO_INCREMENT PRIMARY KEY,
  nome     VARCHAR(100)  NOT NULL,
  email    VARCHAR(150)  NOT NULL UNIQUE,
  senha    VARCHAR(255)  NOT NULL,
  criado_em TIMESTAMP   DEFAULT CURRENT_TIMESTAMP
);
```

**3. Configure as credenciais**

Edite o arquivo `config.php` ou defina variáveis de ambiente:

```env
MYSQLHOST=localhost
MYSQLUSER=root
MYSQLPASSWORD=sua_senha
MYSQLDATABASE=cadastro_db
MYSQLPORT=3306
```

**4. Inicie o servidor**

Coloque os arquivos na pasta `htdocs` (XAMPP) ou `www` (Laragon) e acesse:

```
http://localhost/Formulario/
```

---

## 🔒 Segurança

- Senhas armazenadas com hash **bcrypt** — nunca em texto puro
- Prepared statements com **MySQLi bind_param** — proteção contra SQL Injection
- Dados de saída escapados com **htmlspecialchars** — proteção contra XSS
- Sessão PHP para controle de acesso ao dashboard

---

## 📡 Deploy em Nuvem

O projeto é compatível com plataformas que oferecem MySQL e PHP, como:

- [Railway](https://railway.app/)
- [Render](https://render.com/)
- [InfinityFree](https://infinityfree.net/)

Basta configurar as variáveis de ambiente `MYSQLHOST`, `MYSQLUSER`, `MYSQLPASSWORD`, `MYSQLDATABASE` e `MYSQLPORT`.

---

## 📄 Licença

Este projeto está sob a licença **MIT**. Sinta-se livre para usar, modificar e distribuir.

---
