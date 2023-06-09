<?php

namespace Model;

use Intervention\Image\ImageManagerStatic as ImageManager;

class Images
{
  public $images;
  public $imageNamesStr;
  public $imagesToDeleteArray;

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

    // Set image names for DB
    $imageNames = array_column($imageInstances, 'name');
    if (!empty($property->images)) {
      $oldImages = explode(',', $property->images);
      if (isset($_POST['imagesToDelete'])) {
        $imagesToDelete = explode(',', $_POST['imagesToDelete']);
        $remainingImages = array_diff($oldImages, $imagesToDelete);
      } else {
        $remainingImages = $oldImages;
      }
    } else {
      $remainingImages = [];
    }
    $combinedImages = array_merge($remainingImages, $imageNames);
    $imageNamesStr = implode(',', $combinedImages);
    $property->setImages($imageNamesStr);

    // Save images into server
    foreach ($imageInstances as $imageInstance) {
      $imageInstance['instance']->save($folder . $imageInstance['name']);
    }
  }

  public function deleteImages(array $imageNames, string $folder)
  {
    foreach ($imageNames as $imageName) {
      unlink($folder . $imageName);
    }
  }

  // Make a single array of images form $_POST and BD loaded images
  public function combineArrays($data1, $data2)
  {
    $combinedArray = array_unique(array_merge($data1, $data2));

    $imageNamesStr = implode(',', $combinedArray);
    $imageNamesStr = trim($imageNamesStr, ',');

    $this->imageNamesStr = $imageNamesStr;
    return $imageNamesStr;
  }

  // Delete images on modifying property
  public function deleteImagesFromPost($files, $folder)
  {
    $imagesToDelete = $files['imagesToDelete'];

    $imagesToDeleteArray = explode(',', $imagesToDelete);

    $imagesToDeleteArray = array_filter($imagesToDeleteArray);

    foreach ($imagesToDeleteArray as $imageName) {
      unlink($folder . $imageName);
    }

    $this->imagesToDeleteArray = $imagesToDeleteArray;
    return $imagesToDeleteArray;
  }

  public function processImageNames()
  {
    // Convert images string into an array
    $imagesArray = explode(',', $this->imageNamesStr);

    // Delete image names of the array
    $imagesArray = array_diff($imagesArray, $this->imagesToDeleteArray);

    // Convert resulting array into string
    return implode(',', $imagesArray);
  }
}
