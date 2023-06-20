<?php

namespace Views\Pages;

// TODO Crear Botón Tipo de Anuncio y navegación limitada a mostrar cada 10 resultados
// TODO Crear campo de Búsqueda, Filtro de Anuncios, (Locación, Tipo de Anuncio)
// TODO Crear sistema para ordenar resultados por precio, numero de habitaciones, etc,.

// Imports
use Views\pages\Ads;

class ClassifiedAds
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
    $data = self::$data;
    extract(self::$data);

    ?>

    <main class="container section">

      <h2>Anuncios</h2>

      <?php Ads::ads($data); ?>

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
