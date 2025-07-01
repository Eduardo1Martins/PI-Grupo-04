<?php
session_start();

require_once ('../PHP/processos.php');

if (!isset($_SESSION['usuario'])) {
  header("Location: login.html");
  exit();
}

$tiposPermitidos = ['Administrador', 'Advogado'];

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Portal do Cliente</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #000;
      color: #fff;
    }

    .logo {
      width: 100px;
      height: auto;
    }

    .text-gold {
      color: #FFD700;
    }

    .hover\:text-gold:hover {
      color: #FFD700;
    }

    header h1,
    header p {
      margin: 0;
    }

    main {
      padding: 30px;
    }

    h1, h2 {
      color: #FFD700;
    }

    a {
      color: #FFD700;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    ul {
      list-style: none;
      padding: 0;
    }

    ol {
      padding-left: 20px;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-black-gold">
    <a class="navbar-brand" href="#">
      <img src="img/Logo.png" alt="Logo" class="logo">
    </a>
    <button class="navbar-toggler text-white" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active"><a href="index.php" class="nav-link text-white hover:text-gold">Início</a></li>
        <li class="nav-item"><a href="sobre.html" class="nav-link text-white hover:text-gold">Sobre</a></li>

         <?php if (in_array($usuario['tipo'], ['Administrador', 'Advogado'])): ?>
      <li class="nav-item"><a href="agendamento.php" class="nav-link text-white hover:text-gold">Agendamento</a></li>
      <li class="nav-item"><a href="cadastro.php" class="nav-link text-white hover:text-gold">Cadastro</a></li>
      <li class="nav-item"><a href="usuario.php" class="nav-link text-white hover:text-gold">Usuários</a></li>
        <?php endif; ?>

        <li class="nav-item"><a href="financeiro.php" class="nav-link text-white hover:text-gold">Financeiro</a></li>
        <li class="nav-item"><a href="../PHP/logout.php" class="nav-link text-white hover:text-gold">Sair</a></li>
      </ul>
    </div>
  </nav>

  <!-- Boas-vindas -->
   <?php if(in_array($usuario['tipo'], ['Administrador', 'Advogado'])) : ?>
     <div class="text-center my-4">
    <h1>Portal de processos</h1>
  </div>
  <?php else : ?>
  <div class="text-center my-4">
    <h1>Portal do Cliente</h1>
    <p class="text-white">Bem-vindo ao seu painel de acompanhamento de processos!</p>
  </div>
  <?php endif ; ?>

  <main class="container">
  <?php if (in_array($usuario['tipo'], ['Administrador', 'Advogado'])): ?>
    <table class="table table-bordered table-dark table-hover">
      <thead>
        <tr class="text-center">
          <th>Número</th>
          <th>Cliente</th>
          <th>Pendências</th>
          <th>Valor Total</th>
          <th>Fases</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($processos as $proc): ?>
          <tr>
            <td><?= htmlspecialchars($proc['numero_processo']) ?></td>
            <td><?= htmlspecialchars($proc['nome']) ?></td>
            <td>R$ <?= number_format($proc['pendencias'], 2, ',', '.') ?></td>
            <td>R$ <?= number_format($proc['valor_total'], 2, ',', '.') ?></td>
            <td>
              <ul>
                <?php foreach ($faseObj->listarPorProcesso((int)$proc['processo_id']) as $fase): ?>
                  <li><?= $fase['etapa'] ?> (<?= $fase['tipo_fase'] ?><?= $fase['data_conclusao'] ? ' - ' . $fase['data_conclusao'] : '' ?>)</li>
                <?php endforeach; ?>
              </ul>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php else: ?>
  <h2 class="mb-4">Seus Processos</h2>

  <?php if (empty($processos)): ?>
    <p class="text-muted">Você não possui processos registrados.</p>
  <?php else: ?>
    <div class="row">
      <?php foreach ($processos as $proc): ?>
        <div class="col-md-6 mb-4">
          <div class="card bg-dark text-white border border-gold h-100 shadow-sm">
            <div class="card-body">
              <h5 class="card-title text-gold"><?= htmlspecialchars($proc['numero_processo']) ?></h5>
              <p class="card-text mb-1">
                <strong>Valor total:</strong> R$ <?= number_format($proc['valor_total'], 2, ',', '.') ?><br>
                <strong>Valor pago:</strong> R$ <?= number_format($proc['valor_pago'], 2, ',', '.') ?><br>
                <strong>À pagar:</strong> R$ <?= number_format($proc['valor_a_pagar'], 2, ',', '.') ?><br>
                <strong>Pendências:</strong> R$ <?= number_format($proc['pendencias'], 2, ',', '.') ?>
              </p>
              <hr class="border-gold">
              <h6 class="text-gold">Fases</h6>
              <ul class="pl-3">
                <?php foreach ($faseObj->listarPorProcesso((int)$proc['processo_id']) as $fase): ?>
                  <li><?= $fase['etapa'] ?> (<?= $fase['tipo_fase'] ?><?= $fase['data_conclusao'] ? ' - ' . $fase['data_conclusao'] : '' ?>)</li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
<?php endif; ?>
</main>

  <!-- Scripts Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
          integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
          crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
          integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGaFjF0m4jG6fEjfZr7c2v2n5M"
          crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
          integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
          crossorigin="anonymous"></script>
</body>
</html>
