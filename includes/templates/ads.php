<?php
// Imports
require_once 'includes/app.php';

use App\Property;

// Instance
if ($_SERVER['SCRIPT_NAME'] === '/realestates.php') {
  $result = Property::allTables();
} else {
  $result = Property::limitResults(6);
}

?>

<div class="cards-container">

  <?php foreach ($result as $property) : ?>

    <?php $images = explode(',', $property->images); ?>

    <?php if (!isset($source) || $property->source === $source) : ?>

      <div class="card">

        <img src="/images/<?php echo $images[0] ?>" alt="Imagen Anuncio" loading="lazy">

        <div class="card-content">

          <?php $date = date_create_from_format('Y-m-d', $property->date); ?>
          <p class="text-date">Publicado el <?php echo $date->format('d-m-Y') ?></p>

          <h3><?php echo $property->title ?></h3>

          <p>Ubicado en <?php echo $property->province . ', ' . $property->canton; ?></p>

          <p class="price"><?php echo $property->currency . number_format($property->price, 2) ?></p>

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

          <a href="classifiedad.php?id=<?php echo $property->id ?>&source=<?php echo $property->source ?>"
           rel="noopener noreferrer" class="btn-orangeBlock">Ver Anuncio</a>

        </div>

      </div>

    <?php endif; ?>

  <?php endforeach; ?>

</div>
