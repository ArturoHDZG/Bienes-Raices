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

// Get vendor ID
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
  header('Location:/admin');
}

$tableName = 'vendors';
$vendor = Vendors::find($id, $tableName);

// Define starting errors array
$errors = [];

// Get POST data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Updated vendor
  $args = $_POST;
  $vendor->modifyMap($args);

  // Error messages
  $validation->validateVendors($_POST);
  $errors = $validation->getErrors();

  // Valid form
  if (empty($errors)) {
    $writeDB = $vendor->update();

    if ($writeDB) {
      header("Location:/admin?result=5", true, 303);
      exit;
    }
  }
}

// View Template
includeTemplate('header');

?>

<main class="container section">

  <h1>Modificar Vendedor</h1>

  <a href="/admin" class="btn-greenInline btnCreate-up">Cancelar</a>

  <?php foreach ($errors as $error) : ?>
    <div class="alert error">
      <?php echo $error; ?>
    </div>
  <?php endforeach; ?>

  <form class="form" method="POST">

    <?php require_once '../../includes/templates/formVendor.php'; ?>

    <div class="btnCreate-down">
      <input class="btn-greenInline" type="submit" value="Actualizar">
    </div>

  </form>

</main>

<?php

// View Template
includeTemplate('footer');

?>
