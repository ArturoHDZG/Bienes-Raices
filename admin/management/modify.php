<?php
// Header Function Cache
ob_start();

// Imports
require_once '../../includes/app.php';

use App\Property;
use App\Vendors;
use App\Validation;
use App\ImagesUpload;

// Instances
$validation = new Validation();

// URL protection
login();

// Get property ID and Table_name
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
$tableName = $_GET['table_name'];

// Validate URL
$validTableNames = ['realestates', 'rentals'];

if (!in_array($tableName, $validTableNames) || !$id) {
  header("Location:/admin");
}

// Get variables by title
if ($tableName == 'realestates') {
  $type = '1';
} elseif ($tableName == 'rentals') {
  $type = '2';
}

if ($tableName == 'realestates') {
  $originalType = '1';
} elseif ($tableName == 'rentals') {
  $originalType = '2';
}

// Define starting errors array
$errors = [];

// Define necessary starting variables
$cantonValue = '';
$vendorId = '';

$includeHiddenField = true;

// Get property data from correct table
$property = Property::find($id, $tableName);

// Query for vendors
$vendors = Vendors::all($type);

// Get starting variables from DB
$canton = $property->canton;
$vendorId = $property->vendorId;

// Show property saved images
$imagesOutput = $property->showImages();

// Get POST data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Read and change property attributes from POST
  if (isset($_POST['type'])) {
    $type = $_POST['type'];
  }

  $args = $_POST;
  $property->modifyMap($args);

  // Processing loaded images
  $imagesUpload = new ImagesUpload($_FILES);
  $imageInstances = $imagesUpload->processImages();

  // Error messages
  $data = get_object_vars($property);
  $validation->validateProperty($data, $_FILES, $imageInstances);
  $errors = $validation->getErrors();

  // Valid form
  if (empty($errors)) {
    // Process old, new and removed images
    $imageNames = array_column($imageInstances, 'name');
    $propertyImages = explode(',', $property->images);

    $imagesUpload->combineArrays($imageNames, $propertyImages);
    $imagesUpload->deleteImagesFromPost($_POST, FOLDER_IMAGES);
    $imageNamesStr = $imagesUpload->processImageNames();
    $imagesUpload->saveImages($imageInstances, FOLDER_IMAGES, $property);

    // Validate for ad type changes
    $typeChanged = ($originalType != $type);

    // Query into db
    if ($typeChanged) {
      // Delete row registry by correct table
      $deleteDB = $property->delete($originalType);

      // Insert new row registry by ad type change
      $writeDB = $property->insert($type);

      if ($writeDB) {
        header("Location:/admin?result=2", true, 303);
        exit;
      }
    } else {
      // Update row registry into correct table
      $updateDB = $property->update($originalType);

      if ($updateDB) {
        header("Location:/admin?result=2", true, 303);
        exit;
      }
    }
  }
}

// Send $canton value to app.js to use in fetch canton menu
cantonValue($canton);

// View Template
includeTemplate('header');

?>

<main class="container section">

  <h1>Modificar Anuncio</h1>

  <a href="/admin" class="btn-greenInline btnCreate-up">Cancelar</a>

  <?php foreach ($errors as $error) : ?>
    <div class="alert error">
      <?php echo $error; ?>
    </div>
  <?php endforeach; ?>

  <form class="form" method="POST" enctype="multipart/form-data">

    <?php require_once '../../includes/templates/formAdmin.php'; ?>

    <div class="btnCreate-down">
      <input class="btn-greenInline" type="submit" value="Actualizar">
    </div>

  </form>

</main>

<?php

// View Template
includeTemplate('footer');

?>
