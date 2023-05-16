<?php
// Functions
require_once 'includes/functions.php';

// URL protection
$auth = loginOn();

if ($auth) {
  header("Location:/");
}

// DB connection
require_once 'includes/config/database.php';
$db = connectionBD();

// Define error array
$errors = [];

// Validate form data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (!$email) {

    $errors[] = 'Dirección de correo inválida';

  }

  if (!$password) {

    $errors[] = 'Contraseña inválida';

  }

  if (empty($errors)) {

    $query = "SELECT * FROM vendors WHERE email = '{$email}'";
    $result = mysqli_query($db, $query);

    if ($result->num_rows) {

      $vendor = mysqli_fetch_assoc($result);
      $auth = password_verify($password, $vendor['password']);

      if ($auth) {

        session_start();

        $_SESSION['name'] = $vendor['name'];
        $_SESSION['lastname'] = $vendor['lastname'];
        $_SESSION['phone'] = $vendor['phone'];
        $_SESSION['email'] = $vendor['email'];
        $_SESSION['date'] = $vendor['date'];
        $_SESSION['login'] = true;

        header("Location:/admin");

      } else {

        $errors[] = 'Contraseña incorrecta';

      }

    } else {

      $errors[] = 'Dirección de correo incorrecta';

    }

  }

}

// View Template
includeTemplate('header');

?>

    <main class="container section content-center">

      <h1>Iniciar Sesión</h1>

      <?php foreach ($errors as $error): ?>

        <div class="alert error">
          <?php echo $error; ?>
        </div>

      <?php endforeach; ?>

      <form method="POST" class="form">

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

// View Template
includeTemplate('footer');

?>
