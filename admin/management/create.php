<?php
// Header function cache
ob_start();

// Imports
require_once '../../includes/app.php';

use App\Property;
use App\Validation;
use Intervention\Image\ImageManagerStatic as ImageManager;

// Instances
$property = new Property($_POST);
$validation = new Validation();

// Database connection
$db = connectionBD();

// URL protection
login();

// Define starting errors array
$errors = [];

// Define starting variables
$title = '';
$currency = '';
$price = '';
$province = '';
$canton = '';
$images = '';
$description = '';
$rooms = '';
$wc = '';
$parking = '';
$type = '';
$vendorId = '';
$optionsProvince = '';
$cantonValue = '';

// Get POST data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // Filled input fields if user make a mistake
  $title = $_POST['title'];
  $price = formatPrice($_POST['price']);
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

  // Set an array to save all image instances
  $imageInstances = [];

  // Resize and set images names to DB and Server
  if (!empty($images['tmp_name'][0])) {
    $imageInstances = [];

    foreach ($images['tmp_name'] as $key => $image) {
      $nameImage = substr(md5(uniqid(rand(), true)), 0, 16) . '.jpg';

      $img = ImageManager::make($image);

      $img->fit(800, 600);

      $imageInstances[] = ['instance' => $img, 'name' => $nameImage];

      $imageNames[] = $nameImage;
    }
  }

  // Error messages
  $validation->validateAll($_POST, $_FILES);
  $errors = $validation->getErrors();

  // Valid form
  if (empty($errors)) {

    // Create images folder
    if (!is_dir(FOLDER_IMAGES)) {
      mkdir(FOLDER_IMAGES);
    }

    // Set image names into DB
    $imageNamesStr = implode(',', $imageNames);
    $property->setImages($imageNamesStr);

    // Save images into server
    foreach ($imageInstances as $imageInstance) {
      $imageInstance['instance']->save(FOLDER_IMAGES . $imageInstance['name']);
    }

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

    <fieldset>

      <legend>Información de la Propiedad</legend>

      <label for="title">Título del Anuncio:</label>
      <input id="title" name="title" type="text" placeholder="Título del Anuncio" value="<?php echo $title; ?>">

      <div class="currency-price">

        <div class="currency-section">
          <label for="currency">Moneda:</label>
          <select name="currency" id="currency">
            <option value="0" disabled selected>-- Seleccionar --</option>
            <option value="CRC ₡" <?php echo ($currency == 'CRC ₡') ? 'selected' : ''; ?>>Colones-CRC₡</option>
            <option value="USD $" <?php echo ($currency == 'USD $') ? 'selected' : ''; ?>>Dólares-USD$</option>
          </select>
        </div>

        <div class="price-section">
          <label for="price">Precio:</label>
          <input id="price" name="price" type="text" value="<?php echo $price; ?>">
        </div>

      </div>

      <div class="location-section">

        <div class="location-province">
          <label for="province">Provincia:</label>
          <select name="province" id="province">
            <option value="0" disabled selected>-- Seleccionar --</option>
            <?php while ($rowProvince = $answerProvince->fetch(PDO::FETCH_ASSOC)) : ?>
              <option value="<?= $rowProvince['id'] ?>" <?= (!isset($province) && $rowProvince['id'] == 0) || (isset($province) && $province == $rowProvince['id']) ? 'selected' : '' ?>><?= $rowProvince['province'] ?></option>
            <?php endwhile; ?>
          </select>
        </div>

        <div class="location-canton">
          <label for="canton">Cantón:</label>
          <select name="canton" id="canton">
            <option value="0" disabled selected>-- Seleccionar --</option>
          </select>
          <input type="hidden" id="cantonValue" value="<?php echo $cantonValue; ?>">
        </div>

      </div>

      <label for="images">Imágenes:</label>
      <input id="images" type="file" accept="image/jpeg, image/png" name="images[]" multiple>
      <p id="image-counter"></p>
      <div class="thumbnails-container"></div>

      <label for="description">Descripción del Anuncio</label>
      <textarea id="description" name="description"><?php echo $description; ?></textarea>

    </fieldset>

    <fieldset>

      <legend>Características de la Propiedad</legend>

      <label for="rooms">Habitaciones:</label>
      <input id="rooms" name="rooms" type="number" placeholder="Ej: 3" min="1" max="9" value="<?php echo $rooms; ?>">

      <label for="wc">Baños:</label>
      <input id="wc" name="wc" type="number" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">

      <label for="parking">Lugares de Estacionamiento:</label>
      <input id="parking" name="parking" type="number" placeholder="Ej: 3" min="1" max="9" value="<?php echo $parking; ?>">

    </fieldset>

    <fieldset>

      <legend>Información Extra</legend>

      <label>Tipo de anuncio:</label>
      <select name="type">
        <option value="0" disabled selected>-- Seleccionar --</option>
        <option value="1" <?php echo ($type == '1') ? 'selected' : ''; ?>>Venta</option>
        <option value="2" <?php echo ($type == '2') ? 'selected' : ''; ?>>Alquiler</option>
      </select>

      <label>Vendedor:</label>
      <select name="vendorId">
        <option value="0" disabled selected>-- Seleccionar --</option>
        <?php while ($row = $answerVendors->fetch(PDO::FETCH_ASSOC)) : ?>
          <option value="<?php echo $row['id']; ?>" <?php echo ($vendorId == $row['id']) ? 'selected' : ''; ?>>
            <?php echo $row['id'] . " - " . $row['name'] . " " . $row['lastname']; ?>
          </option>
        <?php endwhile; ?>
      </select>

    </fieldset>

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
