<?php
require_once 'includes/functions.php';

includeTemplate('head');
includeTemplate('header');
?>

<main class="container section">
  <h1>Titulo Pagina</h1>
</main>

<footer class="footer section">
  <div class="container footer-content">
    <nav class="navigation" aria-label="Menú Inferior">
      <a href="about.html" rel="noopener noreferrer">Nosotros</a>
      <a href="realestates.html" rel="noopener noreferrer">Anuncios</a>
      <a href="blog.html" rel="noopener noreferrer">Blog</a>
      <a href="contact.html" rel="noopener noreferrer">Contacto</a>
    </nav>
    <p class="copyright">Tico Casas 2023 &copy;</p>
  </div>
<?php
  includeTemplate('footer');
?>
