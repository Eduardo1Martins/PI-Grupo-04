<?php
session_start();

require_once ('../PHP/processos.php');

$tiposPermitidos = ['Administrador', 'Advogado'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Escritório de Advocacia Dra Francielli</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
  </style>
</head>
<body class="bg-black-gold text-white">
  <header class="py-4 px-3">
    <div class="container d-flex justify-content-between align-items-center">
      <h1 class="h5 text-gold mb-0">Escritório de Advocacia Dra Francielli Palma Maciel</h1>
      <nav class="d-none d-md-block">
        <ul class="nav">

          <?php if (!isset($_SESSION['usuario'])) : ?>
          <li class="nav-item"><a href="#sobre" class="nav-link text-white hover:text-gold">Início</a></li>
          <li class="nav-item"><a href="sobre.html" class="nav-link text-white hover:text-gold">Sobre</a></li>
          <li class="nav-item"><a href="cliente.php" class="nav-link text-white hover:text-gold">Área do Cliente</a></li>
          <li class="nav-item"><a href="usuario.php" class="nav-link text-white hover:text-gold">Área do Advogado</a></li>

          <?php elseif (in_array($usuario['tipo'], ['Cliente'])) : ?>
          <li class="nav-item"><a href="#sobre" class="nav-link text-white hover:text-gold">Início</a></li>
          <li class="nav-item"><a href="sobre.html" class="nav-link text-white hover:text-gold">Sobre</a></li>
          <li class="nav-item"><a href="cliente.php" class="nav-link text-white hover:text-gold">Área do Cliente</a></li>
          <li class="nav-item"><a href="financeiro.php" class="nav-link text-white hover:text-gold">Financeiro</a></li> 
          <li class="nav-item"><a href="../PHP/logout.php" class="nav-link text-white hover:text-gold">Sair</a></li>   

          <?php elseif (in_array($usuario['tipo'], ['Administrador', 'Advogado'])) : ?>
          <li class="nav-item"><a href="#sobre" class="nav-link text-white hover:text-gold">Início</a></li>
          <li class="nav-item"><a href="sobre.html" class="nav-link text-white hover:text-gold">Sobre</a></li>
          <li class="nav-item"><a href="cliente.php" class="nav-link text-white hover:text-gold">Processos</a></li>
          <li class="nav-item"><a href="agendamento.php" class="nav-link text-white hover:text-gold">Agendamento</a></li>
          <li class="nav-item"><a href="cadastro.php" class="nav-link text-white hover:text-gold">Cadastro</a></li>
          <li class="nav-item"><a href="financeiro.php" class="nav-link text-white hover:text-gold">Financeiro</a></li>
          <li class="nav-item"><a href="usuario.php" class="nav-link text-white hover:text-gold">Usuários</a></li> 
          <li class="nav-item"><a href="../PHP/logout.php" class="nav-link text-white hover:text-gold">Sair</a></li>
          <?php endif ; ?>

        </ul>
      </nav>
      <button id="menu-button" class="d-md-none btn text-gold" aria-label="Menu">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" height="24" width="24" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>
  </header>

  <div class="container my-4">
    <div class="row">
      <div class="col-md-6 mb-4">
        <!-- Conteúdo da primeira coluna -->
      </div>
      <div class="col-md-6 mb-4">
        <!-- Conteúdo da segunda coluna -->
      </div>
    </div>
  </div>

  <div id="mobile-menu" class="d-none position-fixed top-0 start-0 w-100 h-100 bg-black bg-opacity-90 z-50">
    <div class="bg-dark position-absolute top-0 end-0 p-4" style="width: 280px; height: 100%;">
      <div class="text-end mb-3">
        <button id="close-menu-button" class="btn text-gold" aria-label="Fechar">
          <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" fill="currentColor" viewBox="0 0 24 24">
            <path d="M6 6l12 12M6 18L18 6" />
          </svg>
        </button>
      </div>
      <nav>
        <ul class="nav flex-column">
          <li class="nav-item"><a href="sobre.html" class="nav-link text-white hover:text-gold">Sobre</a></li>
          <li class="nav-item"><a href="#servicos1" class="nav-link text-white hover:text-gold">Serviços</a></li>
          <li class="nav-item"><a href="#equipe" class="nav-link text-white hover:text-gold">Equipe</a></li>
          <li class="nav-item"><a href="#contato" class="nav-link text-white hover:text-gold">Contato</a></li>
        </ul>
      </nav>
    </div>
  </div>

  <main>
    <section id="sobre" class="py-5 px-3">
      <div class="container">
        <div class="row align-items-center g-4">
          <div class="col-md-6">
            <h2 class="text-gold h3 mb-3">Sobre Nós</h2>
            <p class="text-lg">
              Nosso escritório oferece serviços especializados com ética e compromisso, focando na defesa dos direitos dos nossos clientes. Com experiência em diversas áreas do direito, nossa equipe busca sempre a melhor solução para cada caso.
            </p>
          </div>
          <div class="col-md-6">
            <img src="img/Logo.png" alt="Sobre Nós" class="img-fluid rounded shadow" />
          </div>
        </div>
      </div>
    </section>

    <!-- Serviços (único ID) -->
    <section id="servicos1" class="py-5 px-3 bg-dark">
      <div class="container">
        <h2 class="text-gold h3 text-center mb-5">Nossos Serviços</h2>
        <div class="row g-4">
          <!-- Repita os blocos abaixo conforme necessário -->
          <div class="col-md-4">
            <div class="bg-black p-4 border border-gold rounded shadow">
              <h3 class="text-gold h5 mb-2">Direito Empresarial</h3>
              <p>Assessoria em contratos, fusões e aquisições, propriedade intelectual e direito societário.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="bg-black p-4 border border-gold rounded shadow">
              <h3 class="text-gold h5 mb-2">Direito Civil</h3>
              <p>Atuação em questões de família, sucessões, contratos e responsabilidade civil.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="bg-black p-4 border border-gold rounded shadow">
              <h3 class="text-gold h5 mb-2">Direito Trabalhista</h3>
              <p>Planejamento tributário, defesa em processos administrativos e judiciais.</p>
            </div>
          </div>
               <div class="col-md-4">
            <div class="bg-black p-4 border border-gold rounded shadow">
              <h3 class="text-gold h5 mb-2">Direito Imobiliário</h3>
              <p>Assessoria em contratos, fusões e aquisições, propriedade intelectual e direito societário.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="bg-black p-4 border border-gold rounded shadow">
              <h3 class="text-gold h5 mb-2">Direito Previdenciário</h3>
              <p>Atuação em questões de família, sucessões, contratos e responsabilidade civil./p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="bg-black p-4 border border-gold rounded shadow">
              <h3 class="text-gold h5 mb-2">Direito da Família</h3>
              <p>Planejamento tributário, defesa em processos administrativos e judiciais.</p>
            </div>
          </div>
                         <div class="col-md-4">
            <div class="bg-black p-4 border border-gold rounded shadow">
              <h3 class="text-gold h5 mb-2">Acessoria Jurídica</h3>
              <p>Assessoria em contratos, fusões e aquisições, propriedade intelectual e direito societário.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="bg-black p-4 border border-gold rounded shadow">
              <h3 class="text-gold h5 mb-2">Direito do Consumidor</h3>
              <p>Atuação em questões de família, sucessões, contratos e responsabilidade civil../p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="bg-black p-4 border border-gold rounded shadow">
              <h3 class="text-gold h5 mb-2">BPC Loas</h3>
              <p>Benefício de Prestação Continuada da Lei Orgânica da Assistência Social.</p>
            </div>
          </div>
          
          <!-- Continue com mais serviços -->
        </div>
      </div>
    </section>

    <!-- Equipe -->
    <section id="equipe" class="py-5 px-3">
      <div class="container text-center">
        <h2 class="text-gold h3 mb-5">Nossa Equipe</h2>
        <div class="row g-4">
          <div class="col-md-4">
            <div class="bg-dark p-3 rounded shadow">
              <img src="img/Fran.jpg" class="rounded-circle border border-gold border-4 mb-3 img-fluid" alt="Dra. Francielli" />
              <h3 class="text-gold h5">Dra. Francielli Palma Maciel</h3>
              <p>Sócia Fundadora</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="bg-dark p-3 rounded shadow">
              <img src="img/Ivana.jpg" class="rounded-circle border border-gold border-4 mb-3 img-fluid" alt="Ivana" />
              <h3 class="text-gold h5">Ivana Aparecida Palma</h3>
              <p>Sócia</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="bg-dark p-3 rounded shadow">
              <img src="img/Fer.jpg" class="rounded-circle border border-gold border-4 mb-3 img-fluid" alt="Fernanda" />
              <h3 class="text-gold h5">Fernanda Palma Maciel</h3>
              <p>Financeiro</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Contato -->
    <section id="contato" class="py-5 px-3 bg-dark">
      <div class="container">
        <h2 class="text-gold h3 text-center mb-5">Contato</h2>
        <div class="row g-4">
          <div class="col-md-6">
            <p><strong>Endereço:</strong> Rua Benedita Nogueira, 263, Centro - Araras/SP</p>
            <p><strong>Telefone:</strong> (19) 199623-7233</p>
            <p><strong>Email:</strong> franciellipalma@hotmail.com</p>
            <a href="https://wa.me/19996237233" target="_blank" style="text-decoration: none; color: #25D366; font-size: 18px;">
  <i class="fab fa-whatsapp"></i> Fale Conosco no WhatsApp
</a>
          </div>
          <div class="col-md-6">
            <form class="bg-black p-4 border border-gold rounded shadow">
              <div class="mb-3">
                <label for="nome" class="form-label text-gold">Nome</label>
                <input type="text" class="form-control" id="nome" placeholder="Seu Nome" />
              </div>
              <div class="mb-3">
                <label for="email" class="form-label text-gold">Email</label>
                <input type="email" class="form-control" id="email" placeholder="seuemail@exemplo.com" />
              </div>
              <div class="mb-3">
                <label for="mensagem" class="form-label text-gold">Mensagem</label>
                <textarea class="form-control" id="mensagem" rows="4" placeholder="Sua mensagem..."></textarea>
              </div>
              <button type="submit" class="btn text-black" style="background-color: #FFD700;">Enviar Mensagem</button>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main>





  <footer class="text-center py-3 border-top border-gold bg-black-gold">
    <p class="mb-0 text-white">© 2025 Escritório de Advocacia. Todos os direitos reservados.</p>
  </footer>

  <script>
    const menuButton = document.getElementById('menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const closeMenuButton = document.getElementById('close-menu-button');

    menuButton.addEventListener('click', () => {
      mobileMenu.classList.toggle('d-none');
    });

    closeMenuButton.addEventListener('click', () => {
      mobileMenu.classList.add('d-none');
    });

    document.querySelectorAll('#mobile-menu a').forEach(link => {
      link.addEventListener('click', () => {
        mobileMenu.classList.add('d-none');
      });
    });
  </script>
</body>
</html>
