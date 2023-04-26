<?php
  require_once 'includes/functions.php';

  includeTemplate('head');
  includeTemplate('header', $home = true);
?>
<main class="container section">
  <h1>¿Qué nos hace especiales?</h1>
  <div class="home-icons"> <!-- Home Icons -->
    <div class="home-icon">
      <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
      <h3>Seguridad</h3>
      <p>Precios reales y finales, sin cobros sorpresas ni comisiones ocultas. Ten la seguridad de que nuestros bienes raíces y alquileres son tal cual en la publicación ¡Sin engaños!</p>
    </div>
    <div class="home-icon">
      <img src="build/img/icono2.svg" alt="Icono beneficios" loading="lazy">
      <h3>Mejores precios</h3>
      <p>Encuentra casas o alquileres de acuerdo a tu presupuesto y necesidades, puedes comparar entre las opciones para
        encontrar esa casa o alquiler ideal por tu dinero.</p>
    </div>
    <div class="home-icon">
      <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
      <h3>Rápido</h3>
      <p>¡Atención garantizada antes de 24hrs! Al momento de contactarte nuestro agente se pondrá en contacto contigo para resolver dudas o solicitar una cita.</p>
    </div>
  </div>
</main>
<section class="container section"> <!-- Homepage Cards -->
  <h2>Descubre nuevas propiedades a la venta</h2>
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
  </div>
  <div class="show-realestate">
    <a href="realestates.html" rel="noopener noreferrer" class="btn-showrealestates">Ver más</a>
  </div>
</section>
<section class="home-contact"> <!-- Contact -->
  <h2>Encuentra la casa de tus sueños</h2>
  <p>Deja tus datos de contacto y un agente se comunicará contigo a la brevedad</p>
  <a href="contact.html" rel="noopener noreferrer" class="btn-contact">Contáctanos</a>
</section>
<div class="container section home-lowersection"> <!-- Blog, News & Testimonials -->
  <section class="home-blog"> <!-- Blog Entries -->
    <h3>Noticias</h3>
    <article class="blog-entry">
      <div class="blog-image">
        <picture>
          <source srcset="build/img/blog1.webp" type="image/webp">
          <source srcset="build/img/blog1.jpg" type="image/jpeg">
          <img src="build/img/blog1.jpg" alt="Imagen Noticias" loading="lazy">
        </picture>
      </div>
      <div class="blog-text">
        <a href="entry.html" rel="noopener noreferrer">
          <h4>Demo Noticia</h4>
          <p class="meta-info">Escrito el: <span>01/04/2023</span> por: <span>Admin</span></p>
          <p>Resumen de la noticia o entrada</p>
        </a>
      </div>
    </article>
    <article class="blog-entry">
      <div class="blog-image">
        <picture>
          <source srcset="build/img/blog2.webp" type="image/webp">
          <source srcset="build/img/blog2.jpg" type="image/jpeg">
          <img src="build/img/blog2.jpg" alt="Imagen Noticias" loading="lazy">
        </picture>
      </div>
      <div class="blog-text">
        <a href="entry.html" rel="noopener noreferrer">
          <h4>Demo Entrada del Blog</h4>
          <p class="meta-info">Escrito el: <span>01/04/2023</span> por: <span>Admin</span></p>
          <p>Resumen de la noticia o entrada</p>
        </a>
      </div>
    </article>
  </section>
  <section class="home-testimonial"> <!-- Testimonials -->
    <h3>Opiniones</h3>
    <div class="home-testimonial-text">
      <blockquote>El agente se comportó de forma excelente, muy buena atención y la casa que me ofrecieron era justamente lo que buscaba.</blockquote>
      <p>- Mary Sossa</p>
    </div>
  </section>
</div>
<?php
  includeTemplate('footer');
?>
