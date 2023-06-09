<?php
// Header Function Cache
ob_start();

// Imports
require_once 'includes/app.php';

use App\Property;

// GET data
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
$source = $_GET['source'];
$validTableNames = ['realestates', 'rentals'];

// Secure URL
if (!in_array($source, $validTableNames) || !$id) {
  header("Location:/");
  exit;
}

$property = Property::findAd($id, $source);

// View Template
includeTemplate('header');

?>

<main class="container section content-center">

  <div class="ad-btnUpper">
    <a href="realestates.php" rel="noopener noreferrer" class="btn-orangeInline">Regresar</a>
  </div>

  <h1><?php echo $property->title ?></h1>

  <?php $images = explode(',', $property->images); ?>
  <img id="main-image" src="/images/<?php echo $images[0] ?>" alt="Imagen Anuncio" loading="lazy">

  <div id="thumbnails">

    <?php foreach ($images as $image) : ?>
      <img class="thumbnail" src="/images/<?php echo $image ?>" alt="Imagen Anuncio" loading="lazy">
    <?php endforeach; ?>

    <div class="ad-resume">

      <?php $date = date_create_from_format('Y-m-d', $property->date); ?>
      <p class="text-date">Publicado el <?php echo $date->format('d-m-Y') ?></p>

      <p class="price"><?php echo $property->currency . number_format($property->price, 2) ?></p>

      <p>Ubicado en <?php echo $property->province . ', ' . $property->canton; ?></p>

      <ul class="icons-amenities">

        <li>
          <img src="build/img/icono_wc.svg" alt="Icono WC" loading="lazy">
          <p><?php echo $property->wc ?></p>
        </li>

        <li>
          <img src="build/img/icono_estacionamiento.svg" alt="Icono Parking" loading="lazy">
          <p><?php echo $property->parking ?></p>
        </li>

        <li>
          <img src="build/img/icono_dormitorio.svg" alt="Icono Habitación" loading="lazy">
          <p><?php echo $property->rooms ?></p>
        </li>

      </ul>

      <p><?php echo nl2br($property->description) ?></p>

      <div class="ad-btnLower">
        <a href="contact.php" rel="noopener noreferrer" class="btn-greenInline">Contactar</a>
      </div>

    </div>

</main>

<?php

// View Template
includeTemplate('footer');

?>
