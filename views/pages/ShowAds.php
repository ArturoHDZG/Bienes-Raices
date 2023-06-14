<?php

namespace Views\Pages;

// Imports
use Views\Pages\Ads;

class ShowAds
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
    <h1>Detalles del Anuncio</h1>
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
