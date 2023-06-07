<?php
// Header function cache
ob_start();

// Imports
require_once '../../includes/app.php';

use App\Vendors;
use App\Validation;

// Instances
$vendor = new Vendors;
$validation = new Validation;

// URL protection
login();

// Define starting errors array
$errors = [];

// Get POST data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Instances
  $vendor = new Vendors($_POST);

  // Error messages
  $validation->validateVendors($_POST);
  $errors = $validation->getErrors();

  // Valid form
  if (empty($errors)) {
    $attributes = $vendor->attributes();
    $writeDB = $vendor->insert($attributes);

    if ($writeDB) {
      header("Location:/admin?result=4", true, 303);
      exit;
    }
  }
}

// View Template
includeTemplate('header');

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

    <?php require_once '../../includes/templates/formVendor.php'; ?>

    <div class="btnCreate-down">
      <input class="btn-greenInline" type="submit" value="Enviar">
    </div>

  </form>

</main>

<?php

// View Template
includeTemplate('footer');

?>
