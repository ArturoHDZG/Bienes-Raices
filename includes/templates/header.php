<body>
  <header class="header <?php echo ($home) ? 'home' : ''; ?>">
    <div class="container header-content">
      <div class="header-topbar">
        <a href="/" rel="noopener noreferrer">
          <img src="/build/img/TicoCasas-logo.png" alt="Logotipo Tico Casas">
        </a>
        <div class="header-mobile-menu">
          <img src="/build/img/barras.svg" alt="Icono Menú">
        </div>
        <div class="header-darkmode">
          <img class="btn-darkmode" src="/build/img/dark-mode.svg" alt="Icono Modo Oscuro">
          <nav class="navigation" aria-label="Menú Superior">
            <a href="about.php" rel="noopener noreferrer">Nosotros</a>
            <a href="realestates.php" rel="noopener noreferrer">Anuncios</a>
            <a href="blog.php" rel="noopener noreferrer">Blog</a>
            <a href="contact.php" rel="noopener noreferrer">Contacto</a>
          </nav>
        </div>
      </div>
      <?php if ($home) { ?>
        <h1>Compraventas y Alquileres</h1>
      <?php } ?>
    </div>
  </header>
