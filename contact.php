<?php
require_once 'includes/functions.php';

includeTemplate('head');
includeTemplate('header');
?>
<main class="container section content-center">
  <h1>Contacto</h1>
  <picture>
    <source srcset="build/img/destacada3.webp" type="image/webp">
    <source srcset="build/img/destacada3.jpg" type="image/jpeg">
    <img src="build/img/destacada3.jpg" alt="Imagen de Contacto" loading="lazy">
  </picture>
  <h2>Llena el formulario de contacto</h2>
  <form class="form">
    <fieldset> <!-- Personal data -->
      <legend>Información Personal</legend>
      <label for="name">Nombre:</label>
      <input id="name" type="text" placeholder="ej. Juan Rodríguez">
      <label for="email">e-Mail:</label>
      <input id="email" type="email" placeholder="ej. correo@dominio.com">
      <label for="phone">Teléfono:</label>
      <input id="phone" type="tel" placeholder="ej. 5555-5555">
      <label for="message">Mensaje:</label>
      <textarea placeholder="Escribe tu mensaje" id="message"></textarea>
    </fieldset>
    <fieldset> <!-- Real Estate data -->
      <legend>Información sobre la Propiedad</legend>
      <label for="trade">¿Desea vender, comprar o alquilar?</label>
      <select id="trade" type="text">
        <option value="" disabled selected>-- Seleccionar --</option>
        <option value="buy">Deseo comprar o alquilar una propiedad</option>
        <option value="sell">Deseo vender o alquilar mi propiedad</option>
      </select>
      <label for="budget">Valor de la propiedad o presupuesto:</label>
      <input id=“budget” type=“number” placeholder="ingresar presupuesto o costo" min=“0” max=“10000000” step=“0.01” value=“0.00”>
    </fieldset>
    <fieldset> <!-- Contact data -->
      <legend>Contacto</legend>
      <p>¿Como desea ser Contactado?</p>
      <div class="form-contact">
        <label for="contact-phone">Teléfono</label>
        <input name="preference" id="contact-phone" type="radio" value="prefer-phone">
        <label for="contact-email">e-Mail</label>
        <input name="preference" id="contact-email" type="radio" value="prefer-email">
      </div>
      <p>Si eligió ser contactado por Teléfono, proporcione lo siguiente:</p>
      <label for="date">Fecha:</label>
      <input id="date" type="date">
      <label for="time">Hora:</label>
      <input id="time" type="time" min="9:00" max="18:00" step="1800">
    </fieldset>
    <input type="submit" value="Enviar" class="btn-showrealestates">
  </form>
</main>
<?php
  includeTemplate('footer');
?>