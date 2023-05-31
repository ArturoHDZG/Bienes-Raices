<?php
// Header function cache
ob_start();

// Imports
require_once '../../includes/app.php';

use App\Property;
use App\Validation;
use App\ImagesUpload;

// Instances
$property = new Property;
$validation = new Validation;

// URL protection
login();

// Define starting errors array
$errors = [];

// Define necessary starting variables
$canton = '';
$type = '';
$vendorId = '';
$imagesOutput = '';

$includeHiddenField = false;

// Get POST data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Instances
  $property = new Property($_POST);

  // Save canton selection from JS
  if (isset($_POST['canton'])) {
    $canton = $_POST['canton'];
  }

  if (isset($_POST['type'])) {
    $type = $_POST['type'];
  }

  // Processing images
  $imagesUpload = new ImagesUpload($_FILES);
  $imageInstances = $imagesUpload->processImages();

  // Error messages
  $validation->validateAll($_POST, $_FILES, $imageInstances);
  $errors = $validation->getErrors();

  // Valid form
  if (empty($errors)) {
    // Upload images to server and insert name fot DB
    $imagesUpload->saveImages($imageInstances, FOLDER_IMAGES, $property);

    // Insert into DB and result of insertion
    $writeDB = $property->insert($type);

    if ($writeDB) {
      header("Location:/admin?result=1", true, 303);
      exit;
    }
  }
}

// Send $canton value to app.js to use in fetch canton menu
cantonValue($canton);

// View Template
includeTemplate('header');

?>

<main class="container section">

  <h1>Crear Anuncio</h1>

  <a href="/admin" class="btn-greenInline btnCreate-up">Cancelar</a>

  <?php foreach ($errors as $error) : ?>
    <div class="alert error">
      <?php echo $error; ?>
    </div>
  <?php endforeach; ?>

  <form class="form" method="POST" enctype="multipart/form-data">

  <?php require_once '../../includes/templates/formAdmin.php'; ?>

    <div class="btnCreate-down">
      <input class="btn-greenInline" type="submit" value="Enviar">
    </div>

  </form>

</main>

<?php

// View Template
includeTemplate('footer');

?>
