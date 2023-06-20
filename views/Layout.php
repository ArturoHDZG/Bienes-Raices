<?php

namespace Views;

// TODO Crear mensaje con el nombre del vendedor conectado
// TODO crear un campo para cambiar el idioma de la pagina
// TODO agregar botones de redes sociales

class Layout
{
  public static $home;

  // Master Page
  public static function layout($content)
  {
    $home = self::$home;

    // TODO Session Check for menu
    if (!isset($_SESSION)) {

      session_start();
    }

    $auth = $_SESSION['login'] ?? false;

    if (!isset($home)) {
      $home = false;
    }

    ?>

    <!DOCTYPE html>
    <html lang="es-CR">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Compra, venta y alquiler de bienes raíces en Costa Rica.
       Encuentra tu propiedad ideal con nosotros.">
      <meta name="author" content="Arturo Hernández">
      <meta name="twitter:card" content="summary_large_image">
      <meta name="twitter:site" content="@arturo_hdzg">
      <meta name="twitter:creator" content="@arturo_hdzg">
      <meta name="twitter:title" content="Bienes Raíces Tico Casas">
      <meta name="twitter:description" content="Compra, venta y alquiler de bienes raíces en Costa Rica.
       Encuentra tu propiedad ideal con nosotros.">
      <meta name="twitter:image" content="https://ticocasas.domcloud.io/images/Tico-Casas-Preview.jpg">
      <meta property="og:title" content="Bienes Raíces Tico Casas">
      <meta property="og:description" content="Compra, venta y alquiler de bienes raíces en Costa Rica.
       Encuentra tu propiedad ideal con nosotros.">
      <meta property="og:image" content="https://ticocasas.domcloud.io/images/Tico-Casas-Preview.jpg">
      <meta property="og:url" content="https://ticocasas.domcloud.io/">
      <meta property="og:type" content="website">
      <meta name="keywords" content="bienes raíces, real estate, Costa Rica, compra, buy, venta, sale,
       alquiler, rent, propiedades, properties">
      <meta name="msapplication-TileColor" content="#2d89ef">
      <meta name="msapplication-TileImage" content="/favicon/mstile-144x144.png">
      <meta name="theme-color" content="#ffffff">
      <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
      <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
      <link rel="icon" type="image/png" sizes="192x192" href="/favicon/android-chrome-192x192.png">
      <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
      <link rel="manifest" href="/favicon/site.webmanifest">
      <link rel="mask-icon" href="/favicon/safari-pinned-tab.svg" color="#5bbad5">
      <link rel="stylesheet" href="/build/css/app.css">
      <title>Tico Casas</title>
    </head>

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
                <a href="/about" rel="noopener noreferrer">Nosotros</a>
                <a href="/classified-ads" rel="noopener noreferrer">Anuncios</a>
                <a href="/blog" rel="noopener noreferrer">Blog</a>
                <a href="/contact" rel="noopener noreferrer">Contacto</a>
                <?php if ($auth) : ?>
                  <a href="/admin" rel="noopener noreferrer">Administrar</a>
                  <a href="/logout" rel="noopener noreferrer">Cerrar Sesión</a>
                <?php else : ?>
                  <a href="/login" rel="noopener noreferrer">Iniciar Sesión</a>
                <?php endif; ?>
              </nav>
            </div>
          </div>
          <?php if ($home) { ?>
            <h1>Compraventas y Alquileres</h1>
          <?php } ?>
        </div>
      </header>

      <?php echo $content; ?>

      <footer class="footer section">
        <div class="container footer-content">
          <nav class="navigation" aria-label="Menú Inferior">
            <a href="/about" rel="noopener noreferrer">Nosotros</a>
            <a href="/classified-ads" rel="noopener noreferrer">Anuncios</a>
            <a href="/blog" rel="noopener noreferrer">Blog</a>
            <a href="/contact" rel="noopener noreferrer">Contacto</a>
          </nav>
          <p class="copyright">Tico Casas <?php echo date('Y'); ?>&copy;</p>
          <p class="copyright">Designed by Arturo Hernández Garza</p>
        </div>
      </footer>

      <script src="/build/js/bundle.min.js"></script>
    </body>
    </html>
    <?php
  }
}
