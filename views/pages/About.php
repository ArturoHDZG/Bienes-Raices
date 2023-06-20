<?php

namespace Views\Pages;

// Imports
use Views\pages\Icons;

class About
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

    <main class="container section">

      <h1>Conoce sobre nosotros</h1>

      <div class="about-content">

        <div class="about-image">

          <picture>

            <source srcset="build/img/nosotros.webp" type="image/webp">
            <source srcset="build/img/nosotros.jpg" type="image/jpeg">
            <img src="build/img/nosotros.jpg" alt="Imagen Sobre Nosotros" loading="lazy">

          </picture>

        </div>

        <div class="about-text">

          <blockquote>
            El mejor servicio de Costa Rica
          </blockquote>

          <p>
            Piensas vender o alquilar tu propiedad, pero ya estas cansado de subir las fotos en redes sociales,
            no tienes mucho tiempo para contestar mensajes de potenciales compradores y no se diga de organizar citas,
            y encima eres de aquellas personas que no tiene facilidad de palabra y no sabes cómo hacer atractivas
            las fotos de tu propiedad a potenciales compradores. ¡No hay problema!
          </p>

          <p>
            O tal vez estas buscando aquella casa de tus sueños, o necesitas alquilar un cómodo departamento
            donde tengas accesible el trabajo o el colegio de tus hijos, pero en redes sociales no encuentras
            lo que buscas, o tal vez estas cansado de no obtener la información apropiada, ese vendedor
            no especificó la ubicación de esa casa que te interesa, o las fotos están oscuras o no son
            claras y simplemente los vendedores tardan mucho en contestar, ¡Tampoco hay problema!
          </p>

          <p>
            ¡En TICO CASAS somos la solución! Para que tu proceso de venta o de compra sea el más amigable, profesional,
            conciso y ágil para que tengas todos los elementos para tomar la mejor decisión,
            déjanos a nosotros el trabajo, tu solo preocúpate de lo realmente importante.
          </p>

        </div>

      </div>

    </main>

    <section class="container section">

      <?php Icons::icons(); ?>

    </section>

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
