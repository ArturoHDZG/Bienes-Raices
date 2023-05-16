<?php

// DB connection
require_once __DIR__ . '/../config/database.php';
$db = connectionBD();

// Check if limit is set
if (isset($limit) && is_numeric($limit)) {

  $query = "(SELECT realestates.*, province.province as province_name, canton.canton as canton_name, 'realestates' as source FROM realestates JOIN province ON realestates.province = province.id JOIN canton ON realestates.canton = canton.id ORDER BY date DESC LIMIT $limit) UNION ALL (SELECT rentals.*, province.province as province_name, canton.canton as canton_name, 'rentals' as source FROM rentals JOIN province ON rentals.province = province.id JOIN canton ON rentals.canton = canton.id ORDER BY date DESC LIMIT $limit)";

} else {

  $query = "(SELECT realestates.*, province.province as province_name, canton.canton as canton_name, 'realestates' as source FROM realestates JOIN province ON realestates.province = province.id JOIN canton ON realestates.canton = canton.id ORDER BY date DESC) UNION ALL (SELECT rentals.*, province.province as province_name, canton.canton as canton_name, 'rentals' as source FROM rentals JOIN province ON rentals.province = province.id JOIN canton ON rentals.canton = canton.id ORDER BY date DESC)";

}

// DB results
$result = mysqli_query($db, $query);

?>

<div class="cards-container">
  <?php while ($row = mysqli_fetch_assoc($result)) : ?>

    <?php $images = explode(',', $row['images']); ?>

    <?php if (!isset($source) || $row['source'] === $source) : ?>

      <div class="card">

        <img src="/images/<?php echo $images[0] ?>" alt="Imagen Anuncio" loading="lazy">

        <div class="card-content">

          <?php $date = date_create_from_format('Y-m-d', $row['date']); ?>
          <p class="text-date">Publicado el <?php echo $date->format('d-m-Y') ?></p>

          <h3><?php echo $row['title'] ?></h3>

          <p>Ubicado en <?php echo $row['province_name'] . ', ' . $row['canton_name']; ?></p>

          <p class="price"><?php echo $row['currency'] . number_format($row['price'], 2) ?></p>

          <ul class="icons-amenities">

            <li>
              <img src="build/img/icono_wc.svg" alt="Icono WC" loading="lazy">
              <p><?php echo $row['wc'] ?></p>
            </li>

            <li>
              <img src="build/img/icono_estacionamiento.svg" alt="Icono Parking" loading="lazy">
              <p><?php echo $row['parking'] ?></p>
            </li>

            <li>
              <img src="build/img/icono_dormitorio.svg" alt="Icono Habitación" loading="lazy">
              <p><?php echo $row['rooms'] ?></p>
            </li>

          </ul>

          <a href="classifiedad.php?id=<?php echo $row['id'] ?>&source=<?php echo $row['source'] ?>" rel="noopener noreferrer" class="btn-orangeBlock">Ver Anuncio</a>

        </div>

      </div>

    <?php endif; ?>

  <?php endwhile; ?>

</div>

<?php

// Close DB connection
mysqli_close($db);

?>
