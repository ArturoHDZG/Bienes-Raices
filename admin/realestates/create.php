<?php
// Database connection
require_once '../../includes/config/database.php';
$db = connectionBD();

// Query for vendors_id
$query = "SELECT * FROM vendors";
$answer = mysqli_query($db, $query);

// Form unfilled fields
$errors = [];

// define variables for save input data
$title = '';
$price = '';
$images = '';
$description = '';
$rooms = '';
$wc = '';
$parking = '';
$type = '';
$vendors_id = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $title = mysqli_real_escape_string($db, $_POST['title']);
  $price = mysqli_real_escape_string($db, $_POST['price']);
  if (isset($_POST['images'])) {
    $images = mysqli_real_escape_string($db, $_POST['images']);
  }
  $description = mysqli_real_escape_string($db, $_POST['description']);
  $rooms = mysqli_real_escape_string($db, $_POST['rooms']);
  $wc = mysqli_real_escape_string($db, $_POST['wc']);
  $parking = mysqli_real_escape_string($db, $_POST['parking']);
  $date = date('Y-m-d');
  if (isset($_POST['type'])) {
    $type = mysqli_real_escape_string($db, $_POST['type']);
  }
  if (isset($_POST['vendors_id'])) {
    $vendors_id = mysqli_real_escape_string($db, $_POST['vendors_id']);
  }

  // Error warning messages
  if (!$title) {
    $errors[] = 'El titulo del anuncio es obligatorio';
  }
  if (!$price) {
    $errors[] = 'El precio del anuncio es obligatorio';
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

  // Valid form
  if (empty($errors)) {
    // Query into db
    if ($type == 1) {
      $query = "INSERT INTO realestates (title, price, images, description, rooms, wc, parking, date, vendors_id)
      VALUES ('$title', '$price', '$images', '$description', '$rooms', '$wc', '$parking', '$date', '$vendors_id')";
    } elseif ($type == 2) {
      $query = "INSERT INTO rentals (title, price, images, description, rooms, wc, parking, date, vendors_id)
      VALUES ('$title', '$price', '$images', '$description', '$rooms', '$wc', '$parking', '$date', '$vendors_id')";
    }

    // Insert into db
    $writeDB = mysqli_query($db, $query);

    if ($writeDB) {
      // Send success creation message
      echo 'Creado con éxito';
      // Reroute to previous page
      header('Location: /admin');
    }
  }
}

require_once '../../includes/functions.php';

includeTemplate('head');
includeTemplate('header');
?>

<main class="container section">
  <h1>Nueva Propiedad</h1>
  <a href="/admin" class="btn-greenInline">Cancelar</a>

  <!-- Error alert -->
  <?php foreach ($errors as $error) : ?>
    <div class="alert error">
      <?php echo $error; ?>
    </div>
  <?php endforeach; ?>

  <form class="form" method="POST" action="/admin/realestates/create.php">
    <fieldset> <!-- Property Info -->
      <legend>Información de la Propiedad</legend>
      <label for="title">Título del Anuncio:</label>
      <input id="title" name="title" type="text" placeholder="Título del Anuncio" value="<?php echo $title; ?>">
      <label for="price">Precio:</label>
      <input id="price" name="price" type="number" min="1" max="9999999999.99" value="<?php echo $price; ?>">
      <label for="images">Imágenes:</label>
      <input id="images" type="file" accept="image/jpeg, image/png">
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
      <input id="parking" name="parking" type="number"
      placeholder="Ej: 3" min="1" max="9" value="<?php echo $parking; ?>">
    </fieldset>
    <fieldset> <!-- Extra Info -->
      <legend>Información Extra</legend>
      <label>Tipo de anuncio:</label>
      <select name="type">
        <option value="0" disabled selected>-- Seleccionar --</option>
        <option value="1">Venta</option>
        <option value="2">Alquiler</option>
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
    <input class="btn-greenInline" type="submit" value="Enviar">
  </form>
</main>

<?php
includeTemplate('footer');
?>
