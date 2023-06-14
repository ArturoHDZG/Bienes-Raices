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
    <h1>Entrada del Blog</h1>
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
