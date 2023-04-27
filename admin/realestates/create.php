<?php
require_once '../../includes/functions.php';

includeTemplate('head');
includeTemplate('header');
?>

<main class="container section">
  <h1>Nueva Propiedad</h1>
  <a href="/admin" class="btn-showrealestates">Cancelar</a>
  <form class="form">
    <fieldset> <!-- Property Info -->
      <legend>Información de la Propiedad</legend>
      <label for="title">Título del Anuncio:</label>
      <input id="title" type="text" placeholder="Título del Anuncio">
      <label for="price">Precio:</label>
      <input id="price" type="number" min="1" max="9999999999.99">
      <label for="images">Imágenes:</label>
      <input id="images" type="file" accept="image/jpeg, image/png">
      <label for="desc">Descripción del Anuncio</label>
      <textarea id="desc"></textarea>
    </fieldset>
    <fieldset> <!-- Property Features -->
      <legend>Características de la Propiedad</legend>
      <label for="rooms">Habitaciones:</label>
      <input id="rooms" type="number" placeholder="Ej: 3" min="1" max="9">
      <label for="wc">Baños:</label>
      <input id="wc" type="number" placeholder="Ej: 3" min="1" max="9">
      <label for="parking">Lugares de Estacionamiento:</label>
      <input id="parking" type="number" placeholder="Ej: 3" min="1" max="9">
    </fieldset>
    <fieldset> <!-- Extra Info -->
      <legend>Información Extra</legend>
      <label>Tipo:</label>
      <select>
        <option value="" disabled selected>-- Seleccionar --</option>
        <option value="1">Venta</option>
        <option value="2">Alquiler</option>
      </select>
      <label>Vendedor:</label>
      <select>
        <option value="" disabled selected>-- Seleccionar --</option>
        <option value="1">Arturo Hernandez Garza</option>
      </select>
    </fieldset>
    <input class="btn-showrealestates" type="submit" value="Enviar">
  </form>
</main>

<?php
includeTemplate('footer');
?>
