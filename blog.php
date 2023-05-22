<?php

// Imports
require_once 'includes/app.php';

// View Template
includeTemplate('header');

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

      <article class="blog-entry">

        <div class="blog-image">

          <picture>

            <source srcset="build/img/blog3.webp" type="image/webp">
            <source srcset="build/img/blog3.jpg" type="image/jpeg">
            <img src="build/img/blog3.jpg" alt="Imagen Noticias" loading="lazy">

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

            <source srcset="build/img/blog4.webp" type="image/webp">
            <source srcset="build/img/blog4.jpg" type="image/jpeg">
            <img src="build/img/blog4.jpg" alt="Imagen Noticias" loading="lazy">

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

    </main>

<?php

  // View Template
  includeTemplate('footer');

?>
