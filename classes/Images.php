<?php

declare(strict_types=1);
namespace App;

//* Código temporal
// IF Formulario valido
// Upload images
move_uploaded_file($imageTmpName, $folderImages . $nameImage);

// Add image name to array
$imageNames[] = $nameImage;

// Convert image names array to string
$imageNamesStr = implode(',', $imageNames);

// Validate total size of image names string
if (strlen($imageNamesStr) > 500) {
  $errors[] = 'El número total de imágenes no debe superar el máximo permitido';
}
