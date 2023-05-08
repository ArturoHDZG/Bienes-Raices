<?php
// Database connection
require_once '../includes/config/database.php';
$db = connectionBD();

// Database query
$type = '';
$query = '';

if (isset($_GET['type'])) {
  $type = ($_GET['type']);
}

if ($type == 1) {
  $query = "SELECT * FROM realestates";
} elseif ($type == 2) {
  $query = "SELECT * FROM rentals";
}

// Database answer
if (!empty($query)) {
  $answer = mysqli_query($db, $query);
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

// Show property creation message
$message = $_GET['result'] ?? null;

// Templates
require_once '../includes/functions.php';

includeTemplate('head');
includeTemplate('header');
?>

<main class="container section">
  <h1>Administrador de Anuncios</h1>
  <?php if (intval($message) === 1): ?>
    <p class="alert success">¡Anuncio creado correctamente!</p>
    <?php elseif (intval($message) === 2): ?>
      <p class="alert success">¡Anuncio actualizado correctamente!</p>
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
        <th>Moneda</th>
        <th>Precio</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($type)) : ?>
        <tr>
          <td class="alert error" colspan="6">Por favor, selecciona un tipo de anuncio.</td>
        </tr>
      <?php elseif (isset($answer) && mysqli_num_rows($answer) > 0) : ?>
        <?php while ($property = mysqli_fetch_assoc($answer)) : ?>
          <tr>
            <td><?php echo $property['date']; ?></td>
            <td><?php echo $property['title']; ?></td>
            <td>
              <?php
              if (isset($property['images'])) {
                $images = explode(',', $property['images']);
                $firstImage = $images[0];
              }
              ?>
              <img src="/images/<?php echo $firstImage; ?>" alt="Imagen Principal Propiedad" class="table-image">
            </td>
            <td><?php echo $property['currency']; ?></td>
            <td><?php echo number_format($property['price'], 2, '.', ','); ?></td>
            <td>
              <a class="btn-redBlock" href="management/delete.php?id=<?php echo $property['id']; ?>
                  &table_name=<?php echo $tableName; ?>" ">Eliminar</a>
              <a class=" btn-orangeBlock" href="management/modify.php?id=<?php echo $property['id']; ?>
                  &table_name=<?php echo $tableName; ?>">Modificar</a>
            </td>
          </tr>
        <?php endwhile; ?>
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
mysqli_close($db);

// Templates
includeTemplate('footer');
?>
