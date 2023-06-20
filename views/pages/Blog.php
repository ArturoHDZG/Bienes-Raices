<?php

namespace Views\Pages;

// TODO Ordenar entradas del Blog por mas reciente y crear una navegación con limite de 10 entradas

class Blog
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
    extract(self::$data);

    ?>

    <main class="container section content-center">

      <h1>Nuestro Blog</h1>

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

      <article class="blog-entry">

        <div class="blog-image">

          <picture>

            <source srcset="build/img/blog3.webp" type="image/webp">
            <source srcset="build/img/blog3.jpg" type="image/jpeg">
            <img src="build/img/blog3.jpg" alt="Imagen Noticias" loading="lazy">

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

            <source srcset="build/img/blog4.webp" type="image/webp">
            <source srcset="build/img/blog4.jpg" type="image/jpeg">
            <img src="build/img/blog4.jpg" alt="Imagen Noticias" loading="lazy">

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

    </main>

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
