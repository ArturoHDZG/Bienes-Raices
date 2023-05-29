<?php
// Header Function Cache
ob_start();

// Imports
require_once '../../includes/app.php';

use App\Property;
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

// Get starting variables from DB
$canton = $property->canton;
$vendorId = $property->vendorId;

// Show property saved images
$imagesOutput = $property->showImages();

// Get POST data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Read and change property attributes from POST
  $args = $_POST;
  $property->modifyMap($args);

  // Processing images
  $imagesUpload = new ImagesUpload($_FILES['images']);
  $imageInstances = $imagesUpload->processImages();

  // Error messages
  $validation->validateAll($_POST, $_FILES, $imageInstances);
  $errors = $validation->getErrors();

  exit;
  // Valid form
  if (empty($errors)) {

    // Upload images to server and insert to DB
    $imagesUpload->saveImages($imageInstances, FOLDER_IMAGES, $property);

    // Insert into DB and result of insertion
    $writeDB = $property->insert($type);

    // Convert $propertyImages and $imageNamesStr into arrays
    $propertyImagesArray = explode(',', $propertyImages);
    $imageNamesArray = explode(',', $imageNamesStr);

    // Combine arrays and delete duplicate values
    $allImagesArray = array_unique(array_merge($propertyImagesArray, $imageNamesArray));

    // Convert combined array into a string
    $imageNamesStr = implode(',', $allImagesArray);
    $imageNamesStr = trim($imageNamesStr, ',');

    // Get images names for images to delete
    $imagesToDelete = $_POST['imagesToDelete'];

    // Convert string into array
    $imagesToDeleteArray = explode(',', $imagesToDelete);

    // Remove empty strings from the array
    $imagesToDeleteArray = array_filter($imagesToDeleteArray);

    // Iterate over the array and delete each image from the server
    foreach ($imagesToDeleteArray as $imageName) {
      unlink($folderImages . $imageName);
    }

    // Convert images string into an array
    $imagesArray = explode(',', $imageNamesStr);

    // Delete image names of the array
    $imagesArray = array_diff($imagesArray, $imagesToDeleteArray);

    // Convert resulting array into string
    $imageNamesStr = implode(',', $imagesArray);

    // Validate for ad type changes
    $typeChanged = ($originalType != $type);

    // Query into db
    if ($typeChanged) {

      // Delete row registry by correct table
      if ($originalType == '1') {
        $deleteQuery = "DELETE FROM realestates WHERE id = '$id'";
      } elseif ($originalType == '2') {
        $deleteQuery = "DELETE FROM rentals WHERE id = '$id'";
      }

      // Delete from DB
      $deleteDB = $db->prepare($deleteQuery);
      $deleteDB->execute();

      // Insert new row registry by ad type change
      if ($type == '1') {

        $query = "INSERT INTO realestates (title, currency, price, province, canton, images, description, rooms, wc, parking, date, vendors_id)
        VALUES ('$title', '$currency', '$price', '$province', '$canton', '$imageNamesStr', '$description', '$rooms', '$wc', '$parking', '$date', '$vendors_id')";
      } elseif ($type == '2') {

        $query = "INSERT INTO rentals (title, currency, price, province, canton, images, description, rooms, wc, parking, date, vendors_id)
        VALUES ('$title', '$currency', '$price', '$province', '$canton', '$imageNamesStr', '$description', '$rooms', '$wc', '$parking', '$date', '$vendors_id')";
      }

      // Insert into db
      $writeDB = $db->prepare($query);
      $writeDB->execute();

      if ($writeDB) {
        header("Location:/admin?result=2", true, 303);
        exit;
      }
    } else {
      // Update row registry into correct table
      if ($originalType == '1') {

        $updateQuery = "UPDATE realestates SET title='$title', currency='$currency', price='$price',
          province='$province', canton='$canton', images='$imageNamesStr', description='$description',
          rooms='$rooms', wc='$wc', parking='$parking', date='$date', vendors_id='$vendors_id' WHERE id = '$id'";
      } elseif ($originalType == '2') {

        $updateQuery = "UPDATE rentals SET title='$title', currency='$currency', price='$price',
          province='$province', canton='$canton', images='$imageNamesStr', description='$description',
          rooms='$rooms', wc='$wc', parking='$parking', date='$date', vendors_id='$vendors_id' WHERE id = '$id'";
      }

      // Update DB
      $updateDB = $db->prepare($updateQuery);
      $updateDB->execute();

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
