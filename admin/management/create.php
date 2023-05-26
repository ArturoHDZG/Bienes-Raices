<?php
// Header function cache
ob_start();

// Imports
require_once '../../includes/app.php';

use App\Property;
use App\Validation;
use App\ImagesUpload;

// Instances
$property = new Property($_POST);
$validation = new Validation();

// URL protection
login();

// Define starting errors array
$errors = [];

// Define starting variables
$type = '';
$vendorId = '';

// Get POST data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Filled input fields if user make a mistake
  $title = $_POST['title'];
  $price = $_POST['price'];
  $description = $_POST['description'];
  $rooms = $_POST['rooms'];
  $wc = $_POST['wc'];
  $parking = $_POST['parking'];
  $date = date('Y-m-d');

  // Filled not input field variables
  if (isset($_POST['currency'])) {
    $currency = $_POST['currency'];
  }

  if (isset($_FILES['images'])) {
    $images = $_FILES['images'];
  }

  if (isset($_POST['province'])) {
    $province = $_POST['province'];
  }

  if (isset($_POST['canton'])) {
    $canton = $_POST['canton'];
  }

  if (isset($_POST['type'])) {
    $type = $_POST['type'];
  }

  if (isset($_POST['vendorId'])) {
    $vendorId = $_POST['vendorId'];
  }

  // Processing images
  $imagesUpload = new ImagesUpload($_FILES['images']);
  $imageInstances = $imagesUpload->processImages();

  // Error messages
  $validation->validateAll($_POST, $_FILES, $imageInstances);
  $errors = $validation->getErrors();

  // Valid form
  if (empty($errors)) {

    // Upload images to server and insert to DB
    $imagesUpload->saveImages($imageInstances, FOLDER_IMAGES, $property);

    // Insert into DB and result of insertion
    $writeDB = $property->insert($type);

    if ($writeDB) {
      header("Location:/admin?result=1", true, 303);
      exit;
    }
  }
}

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

<script>
  const cantonValue = <?php echo json_encode($canton); ?>;
</script>

<?php

// View Template
includeTemplate('footer');

?>
