<?php
session_start();

if (!isset($_SESSION['usuario'])) {
  header("Location: login.html");
  exit();
}

$tiposPermitidos = ['Administrador', 'Advogado'];
if (!in_array($_SESSION['usuario']['tipo'], $tiposPermitidos)) {
  echo "Acesso negado. Você não tem permissão para acessar esta página.";
  header("Location: cliente.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dra Francielli</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    body {
      font-family: 'Inter', sans-serif;
    }

    .bg-black-gold {
      background-color: #000;
    }

    .text-gold {
      color: #FFD700;
    }

    .border-gold {
      border-color: #FFD700;
    }

    .hover\:bg-gold-700:hover {
      background-color: #b8860b;
    }

    .focus\:ring-gold-500:focus {
      box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.5);
    }

    .bodyDefault {
      background-color: #000;
      color: #fff;
      height: 100vh;
      margin: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .login-container {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
    }

    .login-box {
      background-color: #222;
      padding: 40px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
      text-align: center;
      width: 100%;
      max-width: 400px;
    }

    h2 {
      color: #FFD700;
      margin-bottom: 20px;
    }

    .textbox {
      margin-bottom: 20px;
    }

    .textbox input {
      width: 100%;
      padding: 15px;
      background-color: #333;
      border: 2px solid #444;
      border-radius: 4px;
      color: #fff;
      font-size: 16px;
      box-sizing: border-box;
    }

    .textbox input:focus {
      outline: none;
      border-color: #FFD700;
    }

    .btn-login {
      width: 100%;
      padding: 15px;
      background-color: #FFD700;
      border: none;
      border-radius: 4px;
      color: #000;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .btn-login:hover {
      background-color: #e6c200;
    }
  </style>
</head>
<body class="bg-black-gold text-white bodyDefault">

  <header class="py-4 px-6 w-full">
    <div class="container mx-auto flex justify-between items-center">
       <img src="img/Logo.png" alt="Logo do Escritório" class="h-10">
      <nav class="hidden md:block">
        <ul class="flex space-x-6">
          <li><a href="index.php" class="hover:text-gold transition duration-300">Início</a></li>
          <li><a href="sobre.html" class="hover:text-gold transition duration-300">Sobre</a></li>
          <li><a href="cliente.php" class="hover:text-gold transition duration-300">Processos</a></li>
          <li><a href="financeiro.php" class="hover:text-gold transition duration-300">Financeiro</a></li>
          <li><a href="usuario.php" class="hover:text-gold transition duration-300">Usuários</a></li>
          <li><a href="agendamento.php" class="hover:text-gold transition duration-300">Agendamento</a></li>
          <li><a href="../PHP/logout.php" class="hover:text-gold transition duration-300">Sair</a></li>
          
        </ul>
      </nav>
      <button id="menu-button" class="md:hidden text-gold focus:outline-none" aria-label="Menu">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
      </button>
    </div>
  </header>

    <div class="login-container">
        <div class="login-box">
             <h2>Cadastro de Cliente</h2>
            <form action="../PHP/cadastro.php" method="POST">
                <div class="textbox">
                    <input type="text" name="nome" placeholder="Nome completo" required>
                </div>
                <div class="textbox">
                    <input type="text" name="cpf" placeholder="CPF (000.000.000-00)" required>
                </div>
                <div class="textbox">
                    <input type="email" name="email" placeholder="E-mail" required>
                </div>
                <div class="textbox">
                    <input type="text" name="telefone" placeholder="Telefone (com DDD)" required>
                </div>
                <div class="textbox">
                    <input type="text" name="endereco" placeholder="Endereço completo" required>
                </div>
                <div class="textbox">
                    <select name="estado_civil" required>
                        <option class="text-black" value="">Estado civil</option>
                        <option class="text-black" value="Solteiro">Solteiro</option>
                        <option class="text-black" value="Casado">Casado</option>
                        <option class="text-black" value="Divorciado">Divorciado</option>
                        <option class="text-black" value="Viúvo">Viúvo</option>
                        <option class="text-black" value="União Estável">União Estável</option>
                    </select>
                </div>
                <button type="submit" class="btn-login">Cadastrar</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
