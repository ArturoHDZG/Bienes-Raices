<?php

namespace Views\Admin\Sellers;

// Imports
use Views\Admin\Sellers\Form;

class Create
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
    extract($data);

    ?>

    <main class="container section">

      <h1>Registrar Vendedor</h1>

      <a href="/admin" class="btn-greenInline btnCreate-up">Cancelar</a>

      <?php foreach ($errors as $error) : ?>
        <div class="alert error">
          <?php echo $error; ?>
        </div>
      <?php endforeach; ?>

      <form class="form" method="POST">

        <?php Form::form($data); ?>

        <div class="btnCreate-down">
          <input class="btn-greenInline" type="submit" value="Enviar">
        </div>

      </form>

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
