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
    $maxImages = 10;

    if (!empty($this->images['images']['tmp_name'][0])) {
      $imageCount = count($this->images['images']['tmp_name']);
      if ($imageCount > $maxImages) {
        return false;
      } else {
        foreach ($this->images['images']['tmp_name'] as $image) {
          $nameImage = substr(md5(uniqid('', true)), 0, 16) . '.jpg';
          $img = ImageManager::make($image);
          $img->fit(800, 600);
          $imageInstances[] = ['instance' => $img, 'name' => $nameImage];
          $imageNames[] = $nameImage;
        }
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
