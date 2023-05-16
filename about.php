<?php

// Functions
require_once 'includes/functions.php';

// View Template
includeTemplate('header');

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
            y encima eres de aquellas personas que no tiene facilidad de palabra y no sabes cómo hacer atractiva las fotos
            de tu propiedad a potenciales compradores. ¡No hay problema!
          </p>

          <p>
            O tal vez estas buscando aquella casa de tus sueños, o necesitas alquilar un cómodo departamento donde tengas
            accesible el trabajo o el colegio de tus hijos, pero en redes sociales no encuentras lo que buscas, o tal vez
            estas cansado de no obtener la información apropiada, ese vendedor no especificó la ubicación de esa casa que
            te interesa, o las fotos están oscuras o no son claras y simplemente los vendedores tardan mucho en contestar,
            ¡Tampoco hay problema!
          </p>

          <p>
            ¡En TICO CASAS somos la solución! Para que tu proceso de venta o de compra sea el más amigable, profesional,
            conciso y ágil para que tengas todos los elementos para tomar la mejor decisión, déjanos a nosotros el trabajo,
            tu solo preocúpate de lo realmente importante.
          </p>

        </div>

      </div>

    </main>

    <section class="container section">

      <h1>¿Qué nos hace especiales?</h1>

      <div class="home-icons">

        <div class="home-icon">

          <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">

          <h3>Seguridad</h3>

          <p>
            Precios reales y finales, sin cobros sorpresas ni comisiones ocultas. Ten la seguridad de que nuestros bienes
            raíces y
            alquileres son tal cual en la publicación ¡Sin engaños!
          </p>

        </div>

        <div class="home-icon">

          <img src="build/img/icono2.svg" alt="Icono beneficios" loading="lazy">

          <h3>Mejores precios</h3>

          <p>
            Encuentra casas o alquileres de acuerdo a tu presupuesto y necesidades, puedes comparar entre las opciones para
            encontrar esa casa o alquiler ideal por tu dinero.
          </p>

        </div>

        <div class="home-icon">

          <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">

          <h3>Rápido</h3>

          <p>
            ¡Atención garantizada antes de 24hrs! Al momento de contactarte nuestro agente se pondrá en contacto contigo
            para
            resolver dudas o solicitar una cita.
          </p>

        </div>

      </div>

    </section>

<?php

// View Template
includeTemplate('footer');

?>
