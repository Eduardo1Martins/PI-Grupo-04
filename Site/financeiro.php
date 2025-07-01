<?php

session_start();

require_once ('../PHP/financeiro.php');
require_once ('../PHP/processos.php');

if (!isset($_SESSION['usuario'])) {
  header("Location: index.html");
  exit();
}

$tiposPermitidos = ['Administrador', 'Advogado'];

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema Financeiro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #000;
      color: #fff;
    }
    .valor-vermelho {
      color: red;
      font-weight: bold;
    }
    .logo {
      height: 40px;
    }
    .card {
      background-color: #1a1a1a;
      border-color: #333;
    }
    .table {
      color: #fff;
    }
    .table thead {
      background-color: #333;
    }
    .navbar, .navbar-brand, .nav-link {
      color: #fff !important;
    }
    .navbar {
      background-color: #111;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="img/Logo.png" alt="Logo" class="logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active" href="index.php">Início</a></li>
          <li class="nav-item"><a class="nav-link" href="sobre.html">Sobre</a></li>
          <li class="nav-item"><a class="nav-link" href="cliente.php">Processos</a></li>

          <?php if (in_array($usuario['tipo'], ['Administrador', 'Advogado'])): ?>
          <li class="nav-item"><a class="nav-link" href="usuario.php">Usuários</a></li>
          <li class="nav-item"><a class="nav-link" href="agendamento.php">Agendamento</a></li>
          <li class="nav-item"><a class="nav-link" href="cadastro.php">Cadastro</a></li>
          <?php endif; ?>
          <li class="nav-item"><a class="nav-link" href="../PHP/logout.php">Sair</a></li>
          
        </ul>
      </div>
    </div>
  </nav>

  <!-- Conteúdo principal -->
  <div class="container mt-5">
    <h2 class="mb-4 text-center text-gold">Sistema Financeiro - Escritório de Advocacia</h2>

    <main class="container">
  <?php if (in_array($usuario['tipo'], ['Advogado', 'Administrador'])): ?>
    <table class="table table-bordered table-dark table-hover text-center">
      <thead>
        <tr>
          <th>Número</th>
          <th>Cliente</th>
          <th>Valor Pago</th>
          <th>Valor a Pagar</th>
          <th>Valor Total</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($processos as $proc): ?>
          <tr>
            <td><?= htmlspecialchars($proc['numero_processo']) ?></td>
            <td><?= htmlspecialchars($proc['nome']) ?></td>
            <td>R$ <?= number_format($proc['valor_pago'], 2, ',', '.') ?></td>
            <td>R$ <?= number_format($proc['valor_a_pagar'], 2, ',', '.') ?></td>
            <td>R$ <?= number_format($proc['valor_total'], 2, ',', '.') ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
  <div class="container mt-5">

  <?php if (empty($processos)): ?>
    <p class="text-muted">Você não possui processos registrados.</p>
  <?php else: ?>
    <table class="table table-bordered table-dark table-hover text-center align-middle">
      <thead>
        <tr>
          <th>Número</th>
          <th>Valor Pago</th>
          <th>Valor a Pagar</th>
          <th>Valor Total</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($processos as $proc): ?>
          <tr>
            <td><?= htmlspecialchars($proc['numero_processo']) ?></td>
            <td>R$ <?= number_format($proc['valor_pago'], 2, ',', '.') ?></td>
            <td>R$ <?= number_format($proc['valor_a_pagar'], 2, ',', '.') ?></td>
            <td>R$ <?= number_format($proc['valor_total'], 2, ',', '.') ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    </div>
  <?php endif; ?>
<?php endif; ?>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
