<?php

declare(strict_types=1);
namespace App;

class Validation
{
  private $errors = [];

  public function validateTitle($title)
  {
    if (!$title) {
      $this->errors[] = 'El titulo del anuncio es obligatorio';
    }
  }

  public function validateCurrency($currency)
  {
    if (!$currency) {
      $this->errors[] = 'El tipo de moneda es obligatorio';
    }
  }

  public function validatePrice($price)
  {
    if (!$price) {
      $this->errors[] = 'El precio del anuncio es obligatorio';
    }
  }

  public function validateProvince($province)
  {
    if (!$province) {
      $this->errors[] = 'Selecciona una provincia';
    }
  }

  public function validateCanton($canton)
  {
    if (!$canton) {
      $this->errors[] = 'Selecciona un cantón';
    }
  }

  public function validateImages($images, $dataImages)
  {
    $noImages = true;
    if (isset($images['name']) && is_array($images['name'])) {
      foreach ($images['name'] as $imageName) {
        if ($imageName) {
          $noImages = false;
        }
      }
    }
    if (isset($dataImages) && !empty($dataImages)) {
      $noImages = false;
    }
    if ($noImages) {
      $this->errors[] = 'Debes agregar al menos una imagen';
    }
  }

  public function validateImageCount($imageInstances)
  {
    $maxImages = 10;
    if ($imageInstances === false) {
      $this->errors[] = 'Demasiadas imágenes. El número máximo permitido es ' . $maxImages;
    }
  }

  public function validateDescription($description)
  {
    if (strlen($description) < 50) {
      $this->errors[] = 'La descripción del anuncio es obligatorio y debe contener al menos 50 caracteres';
    }
  }

  public function validateRooms($rooms)
  {
    if (!$rooms) {
      $this->errors[] = 'El número de habitaciones es obligatorio';
    }
  }

  public function validateWc($wc)
  {
    if (!$wc) {
      $this->errors[] = 'El número de baños es obligatorio';
    }
  }

  public function validateParking($parking)
  {
    if (!$parking) {
      $this->errors[] = 'El número de lugares de estacionamiento es obligatorio';
    }
  }

  public function validateType($type)
  {
    if (!$type) {
      $this->errors[] = 'Debes seleccionar un tipo de anuncio';
    }
  }

  public function validateVendorId($vendorId)
  {
    if (!$vendorId) {
      $this->errors[] = 'Debes seleccionar un vendedor';
    }
  }

  public function validateAll($data, $files, $imageInstances)
  {
    $this->validateTitle($data['title'] ?? null);
    $this->validateCurrency($data['currency'] ?? null);
    $this->validatePrice($data['price'] ?? null);
    $this->validateProvince($data['province'] ?? null);
    $this->validateCanton($data['canton'] ?? null);
    $this->validateImages($files['images'] ?? null, $data['images'] ?? null);
    $this->validateDescription($data['description'] ?? null);
    $this->validateRooms($data['rooms'] ?? null);
    $this->validateWc($data['wc'] ?? null);
    $this->validateParking($data['parking'] ?? null);
    $this->validateType($_POST['type'] ?? null);
    $this->validateVendorId($data['vendorId'] ?? null);
    $this->validateImageCount($imageInstances);
  }

  public function getErrors()
  {
    return $this->errors;
  }
}
