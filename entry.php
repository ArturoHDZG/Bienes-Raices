<?php
require_once 'includes/functions.php';

includeTemplate('head');
includeTemplate('header');
?>
<main class="container section content-center">
  <h1>Entrada del Blog o Noticia</h1>
  <picture>
    <source srcset="build/img/destacada2.webp" type="image/webp">
    <source srcset="build/img/destacada2.jpg" type="image/jpeg">
    <img src="build/img/destacada2.jpg" alt="Foto piscina" loading="lazy">
  </picture>
  <p class="meta-info">Escrito el: <span>01/04/2023</span> por: <span>Admin</span></p>
  <div class="ad-resume">
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
      magna
      aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis
      aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
      occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla veniam numquam quos recusandae, alias et quasi
      consectetur rerum distinctio voluptas porro ducimus. Voluptas, facere cumque ipsa deserunt recusandae corrupti
      iste!</p>
  </div>
</main>
<?php
  includeTemplate('footer');
?>
