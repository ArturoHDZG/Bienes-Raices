<?php
require_once 'includes/functions.php';

includeTemplate('head');
includeTemplate('header');
?>
<main class="container section content-center">
  <h1>Casa en venta frente al Bosque</h1>
  <picture>
    <source srcset="build/img/destacada.webp" type="image/webp">
    <source srcset="build/img/destacada.jpg" type="image/jpeg">
    <img src="build/img/destacada.jpg" alt="Foto casa enfrente del Bosque" loading="lazy">
  </picture>
  <div class="ad-resume">
    <p class="price">$165,000.00 USD</p>
    <ul class="icons-amenities">
      <li>
        <img src="build/img/icono_wc.svg" alt="Icono WC" loading="lazy">
        <p>3</p>
      </li>
      <li>
        <img src="build/img/icono_estacionamiento.svg" alt="Icono Parking" loading="lazy">
        <p>3</p>
      </li>
      <li>
        <img src="build/img/icono_dormitorio.svg" alt="Icono Habitación" loading="lazy">
        <p>4</p>
      </li>
    </ul>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
      magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
      Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
      laborum.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla veniam numquam quos recusandae, alias et quasi
      consectetur rerum distinctio voluptas porro ducimus. Voluptas, facere cumque ipsa deserunt recusandae corrupti
      iste!</p>
    <div class="ad-btn">
      <a href="contact.php" rel="noopener noreferrer" class="btn-greenInline">Contactar</a>
    </div>
  </div>
</main>
<?php
includeTemplate('footer');
?>
