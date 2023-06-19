<?php

namespace Views\Pages;

class BlogEntry
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

      <h1>Entrada del Blog o Noticia</h1>

      <picture>

        <source srcset="build/img/destacada2.webp" type="image/webp">
        <source srcset="build/img/destacada2.jpg" type="image/jpeg">
        <img src="build/img/destacada2.jpg" alt="Foto piscina" loading="lazy">

      </picture>

      <p class="meta-info">Escrito el: <span>01/04/2023</span> por: <span>Admin</span></p>

      <div class="ad-resume">

        <p>
        ¿Alguna vez has escuchado la frase “más vale prevenir que lamentar”? Esta sabiduría popular se aplica
        perfectamente al mantenimiento de casas. Realizar un mantenimiento preventivo regularmente puede ahorrarte
        muchos dolores de cabeza a largo plazo. Imagina que tu casa es como un coche. Si no le cambias el aceite
        regularmente, eventualmente el motor se dañará y tendrás que pagar una reparación costosa. Lo mismo ocurre
        con tu casa. Si no realizas un mantenimiento preventivo, eventualmente tendrás que enfrentarte a problemas
        costosos y difíciles de solucionar.
        </p>

        <p>
        Pero no solo se trata de ahorrar dinero. Realizar un mantenimiento preventivo también puede mejorar tu
        calidad de vida. Una casa limpia y ordenada es más saludable y agradable de habitar. Además, una casa
        bien cuidada también es más segura y estéticamente atractiva. En resumen, el mantenimiento preventivo
        es una inversión inteligente en tu hogar y en tu bienestar. No lo descuides y verás cómo tu casa
        te lo agradecerá.
        </p>

      </div>

      <div class="ad-btn">
        <a href="/blog" rel="noopener noreferrer" class="btn-greenInline">Volver</a>
      </div>

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
