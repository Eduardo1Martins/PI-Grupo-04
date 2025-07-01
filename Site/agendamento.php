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
  <title>Escritório de Advocacia Dra Francielli</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
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
          <li><a href="cadastro.php" class="hover:text-gold transition duration-300">Cadastro</a></li>
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
      <h2>Agendamento de Clientes</h2>
      <form action="../PHP/agendamento.php" method="POST">
        <div class="textbox">
          <input type="text" name="nome" placeholder="Nome do Cliente" required>
        </div>
        <div class="textbox">
          <input type="date" name="data" required>
        </div>
        <div class="textbox">
          <input type="time" name="hora" required>
        </div>
        <div class="textbox">
          <input type="text" name="observacoes" placeholder="Observações">
        </div>
        <button type="submit" class="btn-login">Agendar</button>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
