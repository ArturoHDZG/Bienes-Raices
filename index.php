<?php

// Imports
require_once 'includes/app.php';

// View Template
includeTemplate('header', $home = true);

?>

    <main class="container section">

      <h1>¿Qué nos hace especiales?</h1>

      <div class="home-icons">

        <div class="home-icon">

          <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
          <h3>Seguridad</h3>
          <p>
            Precios reales y finales, sin cobros sorpresas ni comisiones ocultas. Ten la seguridad de que
            nuestros bienes raíces y alquileres son tal cual en la publicación ¡Sin engaños!
          </p>

        </div>

        <div class="home-icon">

          <img src="build/img/icono2.svg" alt="Icono beneficios" loading="lazy">
          <h3>Mejores precios</h3>
          <p>
            Encuentra casas o alquileres de acuerdo a tu presupuesto y necesidades, puedes comparar entre las opciones para
            encontrar esa casa o alquiler ideal por tu dinero.
          </p>

        </div>

        <div class="home-icon">

          <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
          <h3>Rápido</h3>
          <p>
            ¡Atención garantizada antes de 24hrs! Al momento de contactarte nuestro agente se pondrá en
            contacto contigo para resolver dudas o solicitar una cita.
          </p>

        </div>

      </div>

    </main>

    <section class="container section">

      <h2>Descubre nuevas propiedades a la venta</h2>

      <?php

      $limit = 3;
      $source = 'realestates';
      include_once 'includes/templates/ads.php';

      ?>

      <h2>Descubre nuevas propiedades en alquiler</h2>

      <?php

      $limit = 3;
      $source = 'rentals';
      include_once 'includes/templates/ads.php';

      ?>

      <div class="show-realestate">
        <a href="realestates.php" rel="noopener noreferrer" class="btn-greenInline">Ver más</a>
      </div>

    </section>

    <section class="home-contact">

      <h2>Encuentra la casa de tus sueños</h2>
      <p>Deja tus datos de contacto y un agente se comunicará contigo a la brevedad</p>
      <a href="contact.php" rel="noopener noreferrer" class="btn-orangeInline">Contáctanos</a>

    </section>

    <div class="container section home-lowersection">

      <section class="home-blog">

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

            <a href="entry.php" rel="noopener noreferrer">

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

            <a href="entry.php" rel="noopener noreferrer">

              <h4>Demo Entrada del Blog</h4>
              <p class="meta-info">Escrito el: <span>01/04/2023</span> por: <span>Admin</span></p>
              <p>Resumen de la noticia o entrada</p>

            </a>

          </div>

        </article>

      </section>

      <section class="home-testimonial">

        <h3>Opiniones</h3>

        <div class="home-testimonial-text">

          <blockquote>
            El agente se comportó de forma excelente, muy buena atención y la casa que me
            ofrecieron era justamente lo que buscaba.
          </blockquote>
          <p>- Mary Sossa</p>

        </div>

      </section>

    </div>

<?php

// View Template
includeTemplate('footer');

?>
