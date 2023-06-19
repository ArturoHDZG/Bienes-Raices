<?php

namespace Views\Admin\RealEstates;

class Form
{
  public static function form($data)
  {
    extract($data);

    ?>

    <fieldset>

      <legend>Información de la Propiedad</legend>

      <label for="title">Título del Anuncio:</label>
      <input id="title" name="title"
      type="text" placeholder="Ej: Casa Centrica"
      value="<?php echo s($property->title); ?>">

      <div class="currency-price">

        <div class="currency-section">
          <label for="currency">Moneda:</label>
          <select name="currency" id="currency">
            <option value="0" disabled selected>-- Seleccionar --</option>
            <option value="CRC ₡" <?php echo ($property->currency == 'CRC ₡') ? 'selected' : ''; ?>>
              Colones-CRC₡
            </option>
            <option value="USD $" <?php echo ($property->currency == 'USD $') ? 'selected' : ''; ?>>
              Dólares-USD$
            </option>
          </select>
        </div>

        <div class="price-section">
          <label for="price">Precio:</label>
          <input
           id="price" name="price" type="text"
           value="<?php echo s($property->price); ?>" placeholder="Ej: 2,000.00">
        </div>

      </div>

      <div class="location-section">

        <div class="location-province">
          <label for="province">Provincia:</label>
          <select name="province" id="province">
            <option value="0" disabled selected>-- Seleccionar --</option>
            <?php while ($rowProvince = $answerProvince->fetch(\PDO::FETCH_ASSOC)) : ?>
              <option
              value="<?= $rowProvince['id'] ?>"
              <?= (!isset($property->province)
              && $rowProvince['id'] == 0) ||
              (isset($property->province) && $property->province == $rowProvince['id']) ? 'selected' : '' ?>>
              <?= $rowProvince['province'] ?>
              </option>
            <?php endwhile; ?>
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
      <div class="thumbnails-container">
        <?php echo $imagesOutput; ?>
      </div>
      <?php if ($includeHiddenField) : ?>
        <input type="hidden" name="imagesToDelete" id="imagesToDelete" value="">
      <?php endif; ?>

      <label for="description">Descripción del Anuncio</label>
      <textarea id="description" name="description"><?php echo s($property->description); ?></textarea>

    </fieldset>

    <fieldset>

      <legend>Características de la Propiedad</legend>

      <label for="rooms">Habitaciones:</label>
      <input id="rooms" name="rooms"
      type="number" placeholder="Ej: 3"
      min="1" max="9" value="<?php echo s($property->rooms); ?>">

      <label for="wc">Baños:</label>
      <input id="wc" name="wc"
      type="number" placeholder="Ej: 3"
      min="1" max="9" value="<?php echo s($property->wc); ?>">

      <label for="parking">Lugares de Estacionamiento:</label>
      <input
      id="parking" name="parking"
      type="number" placeholder="Ej: 3"
      min="1" max="9" value="<?php echo s($property->parking); ?>">

    </fieldset>

    <fieldset>

      <legend>Información Extra</legend>

      <label>Tipo de anuncio:</label>
      <select name="type">
        <option value="0" disabled selected>-- Seleccionar --</option>
        <option value="1" <?php echo ($type == '1') ? 'selected' : ''; ?>>Venta</option>
        <option value="2" <?php echo ($type == '2') ? 'selected' : ''; ?>>Alquiler</option>
      </select>

      <label for="vendor">Vendedor:</label>
      <select id="vendor" name="vendorId">
        <option value="0" disabled selected>-- Seleccionar --</option>
        <?php foreach ($vendors as $vendor) : ?>
          <option
          <?php echo $property->vendorId === $vendor->id ? 'selected' : ''; ?>
          value="<?php echo s($vendor->id); ?>"
          ><?php echo s($vendor->name) . " " . s($vendor->lastname); ?>
          </option>
        <?php endforeach; ?>
      </select>

    </fieldset>

    <?php
  }
}
