<?php

require_once '../PHP/usuarios.php';

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
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Usuários Cadastrados</title>
  <link rel="stylesheet" href="styles.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    .text-gold { color: #FFD700; }
    .bg-black-gold { background-color: #000; }
    .table thead { background-color: #222; color: #FFD700; }
    .btn-warning, .btn-danger { color: #000; }
  </style>
</head>
<body class="bg-black-gold text-white">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center" href="index.html">
        <img src="img/Logo.png" alt="Logo" class="me-2" style="height: 40px;">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.php">Início</a></li>
          <li class="nav-item"><a class="nav-link" href="sobre.html">Sobre</a></li>
          <li class="nav-item"><a class="nav-link" href="cliente.php">Processos</a></li>
          <li class="nav-item"><a class="nav-link" href="cadastro.php">Cadastro</a></li>
          <li class="nav-item"><a class="nav-link" href="agendamento.php">Agendamento</a></li>
          <li class="nav-item"><a class="nav-link" href="financeiro.php">Financeiro</a></li>
          <li class="nav-item"><a class="nav-link" href="../PHP/logout.php">Sair</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Tabela de Usuários -->
  <div class="container my-5">
    <h2 class="text-center text-gold mb-4">Usuários Cadastrados</h2>

    <?php if ($editarUsuario): ?>
<div class="container my-4">
  <h4 class="text-gold">Editar Usuário</h4>
  <form method="POST" onsubmit="return confirm('Tem certeza que deseja alterar este usuário?');" style="display:inline;">
    <input type="hidden" name="cliente_id" value="<?= $editarUsuario['cliente_id'] ?>">
    <input class="form-control my-1" type="text" name="nome" value="<?= $editarUsuario['nome'] ?>" placeholder="Nome">
    <input class="form-control my-1" type="text" name="telefone" value="<?= $editarUsuario['telefone'] ?>" placeholder="Telefone">
    <input class="form-control my-1" type="text" name="cpf" value="<?= $editarUsuario['cpf'] ?>" placeholder="CPF">
    <input class="form-control my-1" type="email" name="email" value="<?= $editarUsuario['email'] ?>" placeholder="Email">
    <input class="form-control my-1" type="text" name="endereco" value="<?= $editarUsuario['endereco'] ?>" placeholder="Endereço">
    <select class="form-control my-1" name="estado_civil">
      <?php foreach (['Solteiro', 'Casado', 'Divorciado', 'Viúvo', 'União Estável'] as $estado): ?>
        <option value="<?= $estado ?>" <?= $editarUsuario['estado_civil'] === $estado ? 'selected' : '' ?>>
          <?= $estado ?>
        </option>
      <?php endforeach; ?>
    </select>
    <button type="submit" name="atualizar_usuario" class="btn btn-success mt-2">Salvar Alterações</button>
    <a href="usuario.php" class="btn btn-secondary mt-2 ms-2">Cancelar</a>
  </form>
</div>
<?php endif; ?>

    <?php if (!empty($usuarios)): ?>
    <div class="table-responsive">
      <table class="table table-bordered table-dark table-hover text-center align-middle">
        <thead>
          <tr class="text-gold">
            <th>ID</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>CPF</th>
            <th>Email</th>
            <th>Endereço</th>
            <th>Estado Civil</th>
            <th>Data de Cadastro</th>
            <th>Ações</th>
          </tr>
        </thead>

        <?php foreach ($usuarios as $usuario): ?>
        <tbody>
          <!-- Exemplo de usuário -->
          <tr>
            <td><?= htmlspecialchars($usuario['cliente_id']) ?></td>
            <td><?= htmlspecialchars($usuario['nome']) ?></td>
            <td><?= htmlspecialchars($usuario['telefone']) ?></td>
            <td><?= htmlspecialchars($usuario['cpf']) ?></td>
            <td><?= htmlspecialchars($usuario['email']) ?></td>
            <td><?= htmlspecialchars($usuario['endereco']) ?></td>
            <td><?= htmlspecialchars($usuario['estado_civil']) ?></td>
            <td><?= htmlspecialchars($usuario['data_cadastro']) ?></td>
            <td>

              <div class="d-flex flex-wrap gap-1">
              <form method="POST" action="">
            <input type="hidden" name="alterar_id" value="<?= $usuario['cliente_id'] ?>">
            <button class="btn btn-warning btn-sm" type="submit" name="alterar_usuario">Alterar</button>
          </form>
          <form method="POST" action="" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');" style="display:inline;">
            <input type="hidden" name="excluir_id" value="<?= $usuario['cliente_id'] ?>">
            <button class="btn btn-danger btn-sm" type="submit" name="excluir_usuario">Excluir</button>
          </form>
          </div>
        </td>
          </tr>
          <?php endforeach; ?>
          <!-- Adicione mais linhas dinamicamente via PHP/MySQL -->
        </tbody>
      </table>
      <?php else: ?>
        <p>Nenhum usuário encontrado.</p>
    <?php endif; ?>
    </div>
  </div>

  <!-- Rodapé -->
  <footer class="text-center py-3 border-top border-gold bg-black-gold">
    <p class="mb-0 text-white">© 2025 Escritório de Advocacia. Todos os direitos reservados.</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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