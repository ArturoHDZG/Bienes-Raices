<?php
// Header Function Cache
ob_start();

// Functions
require_once 'includes/functions.php';

// DB connection
require_once 'includes/config/database.php';
$db = connectionBD();

// Global Variables
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

$source = $_GET['source'];

$validTableNames = ['realestates', 'rentals'];

// Security GET URL
if (!in_array($source, $validTableNames) || !$id) {

  header("Location:/");
  exit;

}

// DB query
if ($source === 'realestates') {

  $queryId = "SELECT realestates.*, province.province as province_name, canton.canton as canton_name FROM realestates JOIN province ON realestates.province = province.id JOIN canton ON realestates.canton = canton.id WHERE   realestates.id = {$id}";

} elseif ($source === 'rentals') {

  $queryId = "SELECT rentals.*, province.province as province_name, canton.canton as canton_name FROM rentals JOIN province ON rentals.province = province.id JOIN canton ON rentals.canton = canton.id WHERE rentals.id = {$id}";

}

$answerId = mysqli_query($db, $queryId);
$property = mysqli_fetch_assoc($answerId);

// Security DB query
if (!$answerId->num_rows) {

  header("Location:/");
  exit;

}

// View Template
includeTemplate('header');

?>

<main class="container section content-center">

      <div class="ad-btnUpper">
        <a href="realestates.php" rel="noopener noreferrer" class="btn-orangeInline">Regresar</a>
      </div>

      <h1><?php echo $property['title'] ?></h1>

      <?php $images = explode(',', $property['images']); ?>
      <img id="main-image" src="/images/<?php echo $images[0] ?>" alt="Imagen Anuncio" loading="lazy">

      <div id="thumbnails">

        <?php foreach ($images as $image) : ?>
          <img class="thumbnail" src="/images/<?php echo $image ?>" alt="Imagen Anuncio" loading="lazy">
        <?php endforeach; ?>

        <div class="ad-resume">

          <?php $date = date_create_from_format('Y-m-d', $property['date']); ?>
          <p class="text-date">Publicado el <?php echo $date->format('d-m-Y') ?></p>

          <p class="price"><?php echo $property['currency'] . number_format($property['price'], 2) ?></p>
          <p>Ubicado en <?php echo $property['province_name'] . ', ' . $property['canton_name']; ?></p>

          <ul class="icons-amenities">

            <li>
              <img src="build/img/icono_wc.svg" alt="Icono WC" loading="lazy">
              <p><?php echo $property['wc'] ?></p>
            </li>

            <li>
              <img src="build/img/icono_estacionamiento.svg" alt="Icono Parking" loading="lazy">
              <p><?php echo $property['parking'] ?></p>
            </li>

            <li>
              <img src="build/img/icono_dormitorio.svg" alt="Icono Habitación" loading="lazy">
              <p><?php echo $property['rooms'] ?></p>
            </li>

          </ul>

          <p><?php echo nl2br($property['description']) ?></p>

          <div class="ad-btnLower">
            <a href="contact.php" rel="noopener noreferrer" class="btn-greenInline">Contactar</a>
          </div>

        </div>

    </main>

<?php
// Close DB connection
mysqli_close($db);

// View Template
includeTemplate('footer');

?>
