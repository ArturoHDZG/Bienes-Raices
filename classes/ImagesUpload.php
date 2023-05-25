<?php

declare(strict_types=1);

namespace App;

use Intervention\Image\ImageManagerStatic as ImageManager;

class ImagesUpload
{
  public $images;

  public function __construct($images)
  {
    $this->images = $images;
  }

  public function processImages()
  {
    $imageInstances = [];
    if (!empty($this->images['tmp_name'][0])) {
      $imageInstances = [];
      foreach ($this->images['tmp_name'] as $image) {
        $nameImage = substr(md5(uniqid('', true)), 0, 16) . '.jpg';
        $img = ImageManager::make($image);
        $img->fit(800, 600);
        $imageInstances[] = ['instance' => $img, 'name' => $nameImage];
        $imageNames[] = $nameImage;
      }
    }
    return $imageInstances;
  }

  public function saveImages($imageInstances, $folder, $property)
  {
    // Create images folder
    if (!is_dir($folder)) {
      mkdir($folder);
    }

    // Set image names into DB
    $imageNames = array_column($imageInstances, 'name');
    $imageNamesStr = implode(',', $imageNames);
    $property->setImages($imageNamesStr);

    // Save images into server
    foreach ($imageInstances as $imageInstance) {
      $imageInstance['instance']->save($folder . $imageInstance['name']);
    }
  }
}

//* Código temporal

// Limit number of uploaded images to 10
// $maxImages = 10;
