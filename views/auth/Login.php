<?php

namespace Views\Auth;

// TODO Crear sistema para recuperar contraseñas y crear roles (super-admin y vendedores)

class Login
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

    <main class="container section content-center">

      <h1>Iniciar Sesión</h1>

      <?php foreach ($errors as $error): ?>
      <div class="alert error">
        <?php echo $error; ?>
      </div>
      <?php endforeach; ?>

      <form class="form" method="POST" action="/login">

        <fieldset>

          <legend>e-Mail y Contraseña</legend>

          <label for="email">e-Mail:</label>
          <input id="email" name="email" type="email" placeholder="ej. correo@dominio.com">

          <label for="password">Contraseña:</label>
          <input id="password" name="password" type="password" placeholder="ej. password1234">

        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="btn-greenInline">

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
