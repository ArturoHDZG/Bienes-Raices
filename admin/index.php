<?php
// Header Function Cache
ob_start();

// Imports
require_once '../includes/app.php';

use App\Property;

// URL protection
login();

// Set initial variables
$type = '';

// Database query for show properties
if (isset($_GET['type'])) {
  $type = ($_GET['type']);
  $result = Property::all($type);
}

// Get table name for use in URL
if (isset($_GET['type'])) {
  $type = $_GET['type'];

  if ($type == '1') {
    $tableName = 'realestates';
  } elseif ($type == '2') {
    $tableName = 'rentals';
  }
}

// Show property messages
$message = $_GET['result'] ?? null;

// Delete properties
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $id = filter_var($id, FILTER_VALIDATE_INT);

  if ($type == '1' && $id) {
    $query = "DELETE FROM realestates WHERE id = {$id}";
    $queryImages = "SELECT images FROM realestates WHERE id = {$id}";
  } elseif ($type == '2' && $id) {
    $query = "DELETE FROM rentals WHERE id = {$id}";
    $queryImages = "SELECT images FROM rentals WHERE id = {$id}";
  }

  $propertyImages = $db->query($queryImages);
  $property = $propertyImages->fetch(PDO::FETCH_ASSOC);
  $images = explode(',', $property['images']);

  foreach ($images as $image) {
    unlink('../images/' . $image);
  }

  $property = $db->query($query);

  if ($property) {
    header("Location:/admin?result=3", true, 303);
  }
}

// Assign table for properties
if ($type == 1) {
  $source = 'realestates';
} elseif ($type == 2) {
  $source = 'rentals';
}

// View Template
includeTemplate('header');

?>

<main class="container section">

  <h1>Administrador de Anuncios</h1>

  <?php if (intval($message) === 1) : ?>
    <p class="alert success">¡Anuncio creado correctamente!</p>
  <?php elseif (intval($message) === 2) : ?>
    <p class="alert success">¡Anuncio actualizado correctamente!</p>
  <?php elseif (intval($message) === 3) : ?>
    <p class="alert success">¡Anuncio eliminado correctamente!</p>
  <?php endif; ?>

  <div class="admin-topBtn">
    <a href="/admin/management/create.php" class="btn-greenInline">Nuevo Anuncio</a>
  </div>

  <form class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">

    <label>Tipo de anuncio:</label>
    <select class="type-admin" name="type">
      <option value="0" disabled selected>-- Seleccionar --</option>
      <option value="1">Venta</option>
      <option value="2">Alquiler</option>
    </select>

  </form>

  <table aria-label="Listado de Propiedades" class="table-list">

    <thead>
      <tr>
        <th>Fecha</th>
        <th>Titulo</th>
        <th>Imagen</th>
        <th>Precio</th>
        <th>Acciones</th>
      </tr>
    </thead>

    <tbody>

      <?php if (empty($type)) : ?>
        <tr>
          <td class="alert error" colspan="6">Por favor, selecciona un tipo de anuncio.</td>
        </tr>

      <?php elseif (isset($result) && !empty($result)) : ?>

        <?php foreach ($result as $property) : ?>
          <tr>

            <td><?php echo $property->date; ?></td>

            <td>
              <a href="../classifiedad.php?id=<?php echo $property->id ?>&source=<?php echo $source ?>"
              target="_blank" rel="noopener noreferrer"><?php echo $property->title; ?></a>
            </td>

            <td>

              <?php

              if (isset($property->images)) {
                $images = explode(',', $property->images);
                $firstImage = $images[0];
              }

              ?>

              <img src="/images/<?php echo $firstImage; ?>" alt="Imagen Principal Propiedad" class="table-image">
            </td>

            <td><?php echo $property->currency . number_format($property->price, 2) ?></td>

            <td>

              <form class="form" method="POST">
                <input type="hidden" name="id" value="<?php echo $property->id; ?>">
                <input type="submit" class="btn-redBlock" value="Eliminar">
              </form>

              <a class=" btn-orangeBlock" href="management/modify.php?id=<?php echo $property->id; ?>
              &table_name=<?php echo $tableName; ?>">Modificar</a>

            </td>

          </tr>

        <?php endforeach; ?>

      <?php else : ?>

        <tr>
          <td class="alert error" colspan="6">No hay registros en este tipo de anuncio.</td>
        </tr>

      <?php endif; ?>

    </tbody>

  </table>

</main>

<?php

// Close DB connection
$db = null;

// View Template
includeTemplate('footer');

?>
