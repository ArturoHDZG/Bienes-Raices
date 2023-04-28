<?php
// Database connection
require_once '../../includes/config/database.php';
$db = connectionBD();

// Form unfilled fields
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $title = $_POST['title'];
  $price = $_POST['price'];
  $description = $_POST['description'];
  $rooms = $_POST['rooms'];
  $wc = $_POST['wc'];
  $parking = $_POST['parking'];
  $type = '';
  if (isset($_POST['type'])) {
    $type = $_POST['type'];
  }
  $vendors_id = '';
  if (isset($_POST['vendors_id'])) {
    $vendors_id = $_POST['vendors_id'];
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
      $query = "INSERT INTO realestates (title, price, description, rooms, wc, parking, vendors_id)
      VALUES ('$title', '$price', '$description', '$rooms', '$wc', '$parking', '$vendors_id')";
    } elseif ($type == 2) {
      $query = "INSERT INTO rentals (title, price, description, rooms, wc, parking, vendors_id)
      VALUES ('$title', '$price', '$description', '$rooms', '$wc', '$parking', '$vendors_id')";
    }

    // Insert into db
    $writeDB = mysqli_query($db, $query);
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
      <input id="title" name="title" type="text" placeholder="Título del Anuncio">
      <label for="price">Precio:</label>
      <input id="price" name="price" type="number" min="1" max="9999999999.99">
      <label for="images">Imágenes:</label>
      <input id="images" type="file" accept="image/jpeg, image/png">
      <label for="description">Descripción del Anuncio</label>
      <textarea id="description" name="description"></textarea>
    </fieldset>
    <fieldset> <!-- Property Features -->
      <legend>Características de la Propiedad</legend>
      <label for="rooms">Habitaciones:</label>
      <input id="rooms" name="rooms" type="number" placeholder="Ej: 3" min="1" max="9">
      <label for="wc">Baños:</label>
      <input id="wc" name="wc" type="number" placeholder="Ej: 3" min="1" max="9">
      <label for="parking">Lugares de Estacionamiento:</label>
      <input id="parking" name="parking" type="number" placeholder="Ej: 3" min="1" max="9">
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
        <option value="1">Arturo Hernandez Garza</option>
      </select>
    </fieldset>
    <input class="btn-greenInline" type="submit" value="Enviar">
  </form>
</main>

<?php
includeTemplate('footer');
?>
