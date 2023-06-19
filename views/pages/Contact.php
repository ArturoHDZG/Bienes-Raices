<?php

namespace Views\Pages;

class Contact
{
  // Save Model Content
  public static $data;

  // Get Model Content
  public static function addContent($data)
  {
    self::$data = $data;
  }

  // Layout
  public static function main()
  {
    extract(self::$data);

    ?>

    <main class="container section content-center">

      <!-- TODO Agregar campo para almacenar el ID de la propiedad y enviar correo al vendedor de la publicación -->
      <h1>Contacto</h1>

      <?php if($message) : ?>
        <p class="alert success"><?php echo s($message); ?></p>
      <?php elseif($messageError1) : ?>
        <p class="alert error"><?php echo s($messageError1); ?></p>
        <p><?php echo s($messageError2); ?></p>
      <?php endif; ?>

      <picture>

        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img src="build/img/destacada3.jpg" alt="Imagen de Contacto" loading="lazy">

      </picture>

      <h2>Llena el formulario de contacto</h2>

      <form class="form" method="POST" action="/contact">

        <fieldset>

          <legend>Información Personal</legend>

          <label for="name">* Nombre:</label>
          <input id="name" name="contact[name]" type="text" placeholder="ej. Juan Rodríguez">

          <label for="message">* Mensaje:</label>
          <textarea id="message" name="contact[message]" placeholder="Escribe tu mensaje"></textarea>

        </fieldset>

        <fieldset>

          <legend>Información sobre la Propiedad</legend>

          <label for="trade">* ¿Desea vender, comprar o alquilar?</label>
          <select id="trade" name="contact[trade]" type="text">
            <option value="" disabled selected>-- Seleccionar --</option>
            <option value="buy">Deseo comprar o alquilar una propiedad</option>
            <option value="sell">Deseo vender o alquilar mi propiedad</option>
          </select>

          <label for="budget">Valor de la propiedad o presupuesto:</label>
          <input id=“budget” name="contact[budget]" type=“number” placeholder="ingresar presupuesto o costo"
          min=“0” max=“10000000” step=“0.01” value=“0.00”>

        </fieldset>

        <fieldset>

          <legend>Contacto</legend>

          <p>* ¿Como desea ser Contactado?</p>

          <div class="form-contact">

            <label for="contact-phone">Teléfono</label>
            <input name="contact[preference]"
            id="contact-phone" type="radio" value="prefer-phone">

            <label for="contact-email">e-Mail</label>
            <input name="contact[preference]"
            id="contact-email" type="radio" value="prefer-email">

          </div>

          <div id="contact-field"></div>

        </fieldset>

        <p>Todos los campos con * son obligatorios</p>

        <input type="submit" value="Enviar" class="btn-greenInline">

      </form>

    </main>

    <?php
  }

  // Send View
  public static function getContent()
  {
    ob_start();
    self::main();
    return ob_get_clean();
  }
}
