<?php
ob_start();

//* Variables
// define variables for save input data
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
$vendors_id = '';

// define other variables
$optionsProvince = '';

// Form unfilled fields
$errors = [];

//* Database
// Database connection
require_once '../../includes/config/database.php';
$db = connectionBD();

// Query for vendors_id
$query = "SELECT * FROM vendors";
$answer = mysqli_query($db, $query);

// Query for provinces
$queryProvince = "SELECT * FROM province";
$answerProvince = mysqli_query($db, $queryProvince);

// Query for cantons
$queryCanton = "SELECT * FROM canton";
$answerCanton = mysqli_query($db, $queryCanton);

//* Misc
// Generate options for province select
while ($rowProvince = mysqli_fetch_assoc($answerProvince)) {
  $optionsProvince .= "<option value=\"{$rowProvince['id']}\">{$rowProvince['province']}</option>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //* Assign values to variable by input data
  $title = mysqli_real_escape_string($db, $_POST['title']);
  $price = mysqli_real_escape_string($db, $_POST['price']);
  $description = mysqli_real_escape_string($db, $_POST['description']);
  $rooms = mysqli_real_escape_string($db, $_POST['rooms']);
  $wc = mysqli_real_escape_string($db, $_POST['wc']);
  $parking = mysqli_real_escape_string($db, $_POST['parking']);
  $date = date('Y-m-d');

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

  if (isset($_POST['vendors_id'])) {
    $vendors_id = $_POST['vendors_id'];
  }

  // Format currency input
  $price = str_replace(',', '', $price);

  // Error messages
  if (!$title) {
    $errors[] = 'El titulo del anuncio es obligatorio';
  }

  if (!$currency) {
    $errors[] = 'La moneda es obligatoria';
  }

  if (!$price) {
    $errors[] = 'El precio del anuncio es obligatorio';
  }

  if (!$province) {
    $errors[] = 'Selecciona una provincia';
  }

  if (!$canton) {
    $errors[] = 'Selecciona un cantón';
  }

  if (strlen($description) < 50) {
    $errors[] = 'La descripción del anuncio es obligatorio y debe contener al menos 50 caracteres';
  }

  if (!$rooms) {
    $errors[] = 'El número de habitaciones es obligatorio';
  }

  if (!$wc) {
    $errors[] = 'El número de baños es obligatorio';
  }

  if (!$parking) {
    $errors[] = 'El número de lugares de estacionamiento es obligatorio';
  }

  if (!$type) {
    $errors[] = 'Debes seleccionar un tipo de anuncio';
  }

  if (!$vendors_id) {
    $errors[] = 'Debes seleccionar un vendedor';
  }

  $noImages = true;
  if (isset($images['name']) && is_array($images['name'])) {
    foreach ($images['name'] as $imageName) {
      if ($imageName) {
        $noImages = false;
        break;
      }
    }
  }

  if ($noImages) {
    $errors[] = 'Debes agregar al menos una imagen';
  }

  //* Images management
  // Array to store image names
  $imageNames = [];

  // Limit number of uploaded images to 10
  $maxImages = 10;
  if (isset($images['name']) && is_array($images['name'])) {
    $numImages = min(count($images['name']), $maxImages);
  } else {
    $numImages = 0;
  }

  // define images variable
  if (isset($_FILES['images']) && is_array($_FILES['images'])) {
    $images = $_FILES['images'];
  } else {
    var_dump($_FILES['images']);
    exit;
  }

  // Check if image variables are defined
  if (!isset($imageError)) {
    $imageError = 0;
  }
  if (!isset($imageName)) {
    $imageName = '';
  }
  if (!isset($imageSize)) {
    $imageSize = 0;
  }

  // Valid form
  if (empty($errors)) {
    // Iterate over each uploaded image
    for ($i = 0; $i < $numImages; $i++) {
      // Access individual image properties
      $imageName = $images['name'][$i];
      $imageSize = $images['size'][$i];
      $imageTmpName = $images['tmp_name'][$i];
      $imageError = $images['error'][$i];

      // Check for upload errors
      if ($imageError !== 0) {
        // Handle upload error
        $errors[] = 'Hubo un error al cargar la imagen ' . $imageName;
      } else {
        // Validate image size
        $maxSize = 1000 * 1000;

        // Validate image size
        if ($imageSize > $maxSize) {
          $errors[] = 'La imagen ' . $imageName . ' debe tener un tamaño máximo de 1MB';
        } else {
          // Create images folder
          $folderImages = '../../images/';
          if (!is_dir($folderImages)) {
            mkdir($folderImages);
          }

          // Generate unique filename
          do {
            $nameImage = substr(md5(uniqid(rand(), true)), 0, 16) . '.jpg';

            // Check if file name already exists in DB
            if ($type == 1) {
              $query = "SELECT COUNT(*) FROM realestates WHERE images = '$nameImage'";
              $result = mysqli_query($db, $query);
              $count = mysqli_fetch_row($result)[0];
            } elseif ($type == 2) {
              $query = "SELECT COUNT(*) FROM rentals WHERE images = '$nameImage'";
              $result = mysqli_query($db, $query);
              $count = mysqli_fetch_row($result)[0];
            }
          } while ($count > 0);

          // Upload images
          move_uploaded_file($imageTmpName, $folderImages . $nameImage);

          // Add image name to array
          $imageNames[] = $nameImage;
        }
      }
    }

    // Convert image names array to string
    $imageNamesStr = implode(',', $imageNames);

    // Validate total size of image names string
    if (strlen($imageNamesStr) > 500) {
      $errors[] = 'El número total de imágenes no debe superar el máximo permitido';
    }

    // Query into db
    if ($type == 1) {
      $query = "INSERT INTO realestates
               (title, currency, price, province, canton, images, description, rooms, wc, parking, date, vendors_id)
      VALUES ('$title', '$currency', '$price', '$province', '$canton', '$imageNamesStr',
              '$description', '$rooms', '$wc', '$parking', '$date', '$vendors_id')";
    } elseif ($type == 2) {
      $query = "INSERT INTO rentals
               (title, currency, price, province, canton, images, description, rooms, wc, parking, date, vendors_id)
      VALUES ('$title', '$currency', '$price', '$province', '$canton', '$imageNamesStr',
              '$description', '$rooms', '$wc', '$parking', '$date', '$vendors_id')";
    }

    // Insert into db
    $writeDB = mysqli_query($db, $query);

    if ($writeDB) {
      header("Location:/admin?result=1", true, 303);
      exit;
    }
  }
}

//* Visual templates
require_once '../../includes/functions.php';

includeTemplate('head');
includeTemplate('header');
?>

<main class="container section">
  <h1>Crear Anuncio</h1>
  <a href="/admin" class="btn-greenInline btnCreate-up">Cancelar</a>

  <!-- Error alert -->
  <?php foreach ($errors as $error) : ?>
    <div class="alert error">
      <?php echo $error; ?>
    </div>
  <?php endforeach; ?>

  <form class="form" method="POST" action="/admin/management/create.php" enctype="multipart/form-data">
    <fieldset> <!-- Property Info -->
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
            <?php echo $optionsProvince; ?>
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
    <fieldset> <!-- Property Features -->
      <legend>Características de la Propiedad</legend>
      <label for="rooms">Habitaciones:</label>
      <input id="rooms" name="rooms" type="number" placeholder="Ej: 3" min="1" max="9" value="<?php echo $rooms; ?>">
      <label for="wc">Baños:</label>
      <input id="wc" name="wc" type="number" placeholder="Ej: 3" min="1" max="9" value="<?php echo $wc; ?>">
      <label for="parking">Lugares de Estacionamiento:</label>
      <input id="parking" name="parking" type="number" placeholder="Ej: 3" min="1" max="9" value="<?php echo $parking; ?>">
    </fieldset>
    <fieldset> <!-- Extra Info -->
      <legend>Información Extra</legend>
      <label>Tipo de anuncio:</label>
      <select name="type">
        <option value="0" disabled selected>-- Seleccionar --</option>
        <option value="1" <?php echo ($type == '1') ? 'selected' : ''; ?>>Venta</option>
        <option value="2" <?php echo ($type == '2') ? 'selected' : ''; ?>>Alquiler</option>
      </select>
      <label>Vendedor:</label>
      <select name="vendors_id">
        <option value="0" disabled selected>-- Seleccionar --</option>
        <?php while ($row = mysqli_fetch_assoc($answer)) : ?>
          <option <?php echo $vendors_id === $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id']; ?>">
            <?php echo $row['id'] . " " . $row['name'] . " " . $row['lastname']; ?></option>
        <?php endwhile; ?>
      </select>
    </fieldset>
    <div class="btnCreate-down">
      <input class="btn-greenInline" type="submit" value="Enviar">
    </div>
  </form>
</main>

<?php
includeTemplate('footer');
?>
