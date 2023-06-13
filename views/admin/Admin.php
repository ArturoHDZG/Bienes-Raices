<?php

namespace Views\Admin;

class Admin
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

      <h1>Panel de Administración</h1>

      <?php if ($code) : ?>
        <?php $message = message(intval($code));
        if ($message) : ?>
          <p class="alert success"><?php echo s($message); ?></p>
        <?php endif; ?>
      <?php endif; ?>

      <h2>Propiedades</h2>
      <div class="admin-topBtn">
        <a href="/admin/realestates/create" class="btn-greenInline">Nuevo Anuncio</a>
      </div>

      <form class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">

        <label>Tipo de anuncio:</label>
        <select class="type-admin" name="type">
          <option value="0" disabled selected>-- Seleccionar --</option>
          <option value="1">Venta</option>
          <option value="2">Alquiler</option>
        </select>

      </form>

      <table aria-label="Listado de Propiedades" class="table-list">

        <thead>
          <tr>
            <th>Fecha</th>
            <th>Titulo</th>
            <th>Imagen</th>
            <th>Precio</th>
            <th>Acciones</th>
          </tr>
        </thead>

        <tbody>

          <?php if (empty($type)) : ?>
            <tr>
              <td class="alert error" colspan="6">Por favor, selecciona un tipo de anuncio</td>
            </tr>

          <?php elseif (isset($realEstates) && !empty($realEstates)) : ?>

            <?php foreach ($realEstates as $property) : ?>
              <tr>

                <td><?php echo $property->date; ?></td>

                <td>
                  <a
                   href="../classifiedad.php?id=<?php echo $property->id ?>&source=<?php echo $source ?>"
                   target="_blank" rel="noopener noreferrer"><?php echo $property->title; ?>
                  </a>
                </td>

                <td>

                  <?php

                  if (isset($property->images)) {
                    $images = explode(',', $property->images);
                    $firstImage = $images[0];
                  }

                  ?>

                  <img src="/images/<?php echo $firstImage; ?>" alt="Imagen Principal Propiedad" class="table-image">
                </td>

                <td><?php echo $property->currency . number_format($property->price, 2) ?></td>

                <td>

                  <form class="form" method="POST" action="/admin/realestates/delete?type=<?php echo $type; ?>">
                    <input type="hidden" name="id" value="<?php echo $property->id; ?>">
                    <input type="hidden" name="adminIndexType" value="property">
                    <input type="submit" class="btn-redBlock" value="Eliminar">
                  </form>

                  <a class=" btn-orangeBlock"
                   href="/admin/realestates/update?id=<?php echo $property->id; ?>&table_name=<?php echo $tableName; ?>"
                  >Modificar</a>

                </td>

              </tr>

            <?php endforeach; ?>

          <?php else : ?>

            <tr>
              <td class="alert error" colspan="6">No hay registros en este tipo de anuncio.</td>
            </tr>

          <?php endif; ?>

        </tbody>

      </table>

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
