<?php
// Header Function Cache
ob_start();

// Imports
require_once '../includes/app.php';

use App\Property;
use App\Vendors;

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

// Assign table for properties
if ($type == 1) {
  $source = 'realestates';
} elseif ($type == 2) {
  $source = 'rentals';
}

// Get vendors
$resultVendors = Vendors::all($type);

// Get message code
$code = $_GET['result'] ?? null;

// Delete properties
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $id = filter_var($id, FILTER_VALIDATE_INT);

  if ($id) {
    $typeContent = $_POST['adminIndexType'];

    if (validateContent($typeContent)) {
      if ($typeContent === 'property') {
        $property = Property::find($id, $tableName);
        $deleteDB = $property->delete($type);
      } elseif ($typeContent === 'vendor') {
        $tableName = 'vendors';
        $vendor = Vendors::find($id, $tableName);
        $deleteDBVendor = $vendor->insertDelete();
      }
    }
  }

  if ($deleteDB) {
    header("Location:/admin?result=3", true, 303);
  } elseif ($deleteDBVendor) {
    header("Location:/admin?result=6", true, 303);
  }
}

// View Template
includeTemplate('header');

?>

<main class="container section">

  <h1>Panel de Administración</h1>

  <?php $message = message(intval($code));
  if ($message) : ?>
  <p class="alert success"><?php echo s($message); ?></p>
  <?php endif; ?>

  <h2>Propiedades</h2>
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
          <td class="alert error" colspan="6">Por favor, selecciona un tipo de anuncio</td>
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
                <input type="hidden" name="adminIndexType" value="property">
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

  <h2>Vendedores</h2>
  <div class="admin-topBtn">
    <a href="/admin/vendors/create.php" class="btn-greenInline">Nuevo Vendedor</a>
  </div>

  <table aria-label="Listado de Propiedades" class="table-list">

    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Teléfono</th>
        <th>Email</th>
        <th>Acciones</th>
      </tr>
    </thead>

    <tbody>

      <?php if (empty($resultVendors)) : ?>
        <tr>
          <td class="alert error" colspan="6">No se encontraron vendedores</td>
        </tr>
      <?php endif; ?>

      <?php foreach ($resultVendors as $vendor) : ?>
        <tr>

          <td><?php echo $vendor->id; ?></td>

          <td><?php echo $vendor->name . " " . $vendor->lastname; ?></td>

          <td><?php echo $vendor->phone; ?></td>

          <td><?php echo $vendor->email; ?></td>

          <td>

            <form class="form" method="POST">
              <input type="hidden" name="id" value="<?php echo $vendor->id; ?>">
              <input type="hidden" name="adminIndexType" value="vendor">
              <input type="submit" class="btn-redBlock" value="Eliminar">
            </form>

            <a class="btn-orangeBlock" href="/admin/vendors/modify.php?id=<?php echo $vendor->id; ?>">Modificar</a>

          </td>

        </tr>

      <?php endforeach; ?>

    </tbody>

  </table>

</main>

<?php

// View Template
includeTemplate('footer');

?>
