<?php

namespace Views\Admin\Sellers;

class Form
{
  public static function form($data)
  {
    extract($data);

    ?>
    <fieldset>

      <legend>Datos Personales</legend>

      <label for="name">Nombre:</label>
      <input id="name" name="name" type="text" placeholder="Ej: Juan" value="<?php echo s($vendor->name); ?>">

      <label for="lastname">Apellido(s):</label>
      <input id="lastname" name="lastname"
      type="text" placeholder="Ej: Hernández Sosa"
      value="<?php echo s($vendor->lastname); ?>">

    </fieldset>

    <fieldset>

      <legend>Información de Contacto</legend>

      <label for="phone">Teléfono:</label>
      <input id="phone" name="phone" type="phone"
       placeholder="Ej: 55-555-5555" value="<?php echo s($vendor->phone); ?>">

      <label for="email">Email:</label>
      <input id="email" name="email" type="email"
      placeholder="Ej: mi_correo@correo.com" value="<?php echo s($vendor->email); ?>">

    </fieldset>

    <?php
  }
}
