<?php
require_once 'includes/functions.php';

includeTemplate('head');
includeTemplate('header');
?>
<main class="container section">
  <h2>Anuncios</h2>
  <div class="cards-container">
    <div class="card"> <!-- Card 1 -->
      <picture>
        <source srcset="build/img/anuncio1.webp" type="image/webp">
        <source srcset="build/img/anuncio1.jpg" type="image/jpeg">
        <img src="build/img/anuncio1.jpg" alt="Casa Lago" loading="lazy">
      </picture>
      <div class="card-content">
        <p class="text-demo">Demo</p>
        <h3>Casa de Lujo Rústica en el Lago</h3>
        <p>Casa en el lago con excelente vista, acabados de lujo a un muy buen precio.</p>
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
        <a href="classifiedad.html" rel="noopener noreferrer" class="btn-showad">Ver Propiedad</a>
      </div>
    </div>
    <div class="card"> <!-- Card 2 -->
      <picture>
        <source srcset="build/img/anuncio2.webp" type="image/webp">
        <source srcset="build/img/anuncio2.jpg" type="image/jpeg">
        <img src="build/img/anuncio2.jpg" alt="Casa Lujo" loading="lazy">
      </picture>
      <div class="card-content">
        <p class="text-demo">Demo</p>
        <h3>Casa Terminados de Lujo</h3>
        <p>Casa en zona residencial exclusiva, terminados en lujo, balcón y vigilancia 24hrs.</p>
        <p class="price">$115,000.00 USD</p>
        <ul class="icons-amenities">
          <li>
            <img src="build/img/icono_wc.svg" alt="Icono WC" loading="lazy">
            <p>1</p>
          </li>
          <li>
            <img src="build/img/icono_estacionamiento.svg" alt="Icono Parking" loading="lazy">
            <p>2</p>
          </li>
          <li>
            <img src="build/img/icono_dormitorio.svg" alt="Icono Habitación" loading="lazy">
            <p>4</p>
          </li>
        </ul>
        <a href="classifiedad.html" rel="noopener noreferrer" class="btn-showad">Ver Propiedad</a>
      </div>
    </div>
    <div class="card"> <!-- Card 3 -->
      <picture>
        <source srcset="build/img/anuncio3.webp" type="image/webp">
        <source srcset="build/img/anuncio3.jpg" type="image/jpeg">
        <img src="build/img/anuncio3.jpg" alt="Casa Piscina" loading="lazy">
      </picture>
      <div class="card-content">
        <p class="text-demo">Demo</p>
        <h3>Casa de Lujo con Piscina</h3>
        <p>Bonita casa a 800 metros de la playa, estilo colonial, amplia y con portico de madera.</p>
        <p class="price">$130,000.00 USD</p>
        <ul class="icons-amenities">
          <li>
            <img src="build/img/icono_wc.svg" alt="Icono WC" loading="lazy">
            <p>2</p>
          </li>
          <li>
            <img src="build/img/icono_estacionamiento.svg" alt="Icono Parking" loading="lazy">
            <p>2</p>
          </li>
          <li>
            <img src="build/img/icono_dormitorio.svg" alt="Icono Habitación" loading="lazy">
            <p>3</p>
          </li>
        </ul>
        <a href="classifiedad.html" rel="noopener noreferrer" class="btn-showad">Ver Propiedad</a>
      </div>
    </div>
    <div class="card"> <!-- Card 4 -->
      <picture>
        <source srcset="build/img/anuncio4.webp" type="image/webp">
        <source srcset="build/img/anuncio4.jpg" type="image/jpeg">
        <img src="build/img/anuncio4.jpg" alt="Casa Lago" loading="lazy">
      </picture>
      <div class="card-content">
        <p class="text-demo">Demo</p>
        <h3>Casa de Lujo en el Lago</h3>
        <p>Casa en el lago con excelente vista, acabados de lujo a un muy buen precio.</p>
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
        <a href="classifiedad.html" rel="noopener noreferrer" class="btn-showad">Ver Propiedad</a>
      </div>
    </div>
    <div class="card"> <!-- Card 5 -->
      <picture>
        <source srcset="build/img/anuncio5.webp" type="image/webp">
        <source srcset="build/img/anuncio5.jpg" type="image/jpeg">
        <img src="build/img/anuncio5.jpg" alt="Casa Lujo" loading="lazy">
      </picture>
      <div class="card-content">
        <p class="text-demo">Demo</p>
        <h3>Casa Terminados de Lujo</h3>
        <p>Casa en zona residencial exclusiva, terminados en lujo, balcón y vigilancia 24hrs.</p>
        <p class="price">$115,000.00 USD</p>
        <ul class="icons-amenities">
          <li>
            <img src="build/img/icono_wc.svg" alt="Icono WC" loading="lazy">
            <p>1</p>
          </li>
          <li>
            <img src="build/img/icono_estacionamiento.svg" alt="Icono Parking" loading="lazy">
            <p>2</p>
          </li>
          <li>
            <img src="build/img/icono_dormitorio.svg" alt="Icono Habitación" loading="lazy">
            <p>4</p>
          </li>
        </ul>
        <a href="classifiedad.html" rel="noopener noreferrer" class="btn-showad">Ver Propiedad</a>
      </div>
    </div>
    <div class="card"> <!-- Card 6 -->
      <picture>
        <source srcset="build/img/anuncio6.webp" type="image/webp">
        <source srcset="build/img/anuncio6.jpg" type="image/jpeg">
        <img src="build/img/anuncio6.jpg" alt="Casa Piscina" loading="lazy">
      </picture>
      <div class="card-content">
        <p class="text-demo">Demo</p>
        <h3>Casa de Lujo con Piscina</h3>
        <p>Bonita casa a 800 metros de la playa, estilo colonial, amplia y con portico de madera.</p>
        <p class="price">$130,000.00 USD</p>
        <ul class="icons-amenities">
          <li>
            <img src="build/img/icono_wc.svg" alt="Icono WC" loading="lazy">
            <p>2</p>
          </li>
          <li>
            <img src="build/img/icono_estacionamiento.svg" alt="Icono Parking" loading="lazy">
            <p>2</p>
          </li>
          <li>
            <img src="build/img/icono_dormitorio.svg" alt="Icono Habitación" loading="lazy">
            <p>3</p>
          </li>
        </ul>
        <a href="classifiedad.html" rel="noopener noreferrer" class="btn-showad">Ver Propiedad</a>
      </div>
    </div>
  </div>
</main>
<?php
  includeTemplate('footer');
?>
