<?php

namespace Views\Pages;

// Imports
use Views\pages\Ads;
use Views\pages\Icons;

class Index
{
  // Save Model Content
  public static $data;

  // Get Model Content
  public static function addContent($data)
  {
    self::$data = $data;
  }

  // Layout
  public static function main()
  {
    // Index Unique Header
    extract(self::$data);
    \Views\Layout::$home = $home;

    ?>

    <main class="container section">

      <?php Icons::icons(); ?>

    </main>

    <section class="container section">

      <h2>Descubre nuevas propiedades a la venta</h2>

      <?php

      $data = [
        'result' => $result,
        'source' => 'realestates'
      ];
      Ads::ads($data);

      ?>

      <h2>Descubre nuevas propiedades en alquiler</h2>

      <?php

      $data = [
        'result' => $result,
        'source' => 'rentals'
      ];
      Ads::ads($data);

      ?>

      <div class="show-realestate">
        <a href="/classified-ads" rel="noopener noreferrer" class="btn-greenInline">Ver más</a>
      </div>

    </section>

    <section class="home-contact">

      <h2>Encuentra la casa de tus sueños</h2>
      <p>Deja tus datos de contacto y un agente se comunicará contigo a la brevedad</p>
      <a href="/contact" rel="noopener noreferrer" class="btn-orangeInline">Contáctanos</a>

    </section>

    <div class="container section home-lowersection">

      <section class="home-blog">

        <!-- TODO Hacer Blog Dinámico -->
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

            <a href="/blog-entry" rel="noopener noreferrer">

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

            <a href="/blog-entry" rel="noopener noreferrer">

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
  }

  // Send View
  public static function getContent()
  {
    ob_start();
    self::main();
    return ob_get_clean();
  }
}
