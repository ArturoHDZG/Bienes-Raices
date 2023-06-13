<?php

function validateUrlParams($id, $tableName)
{
  $validTableNames = ['realestates', 'rentals'];
  $id = filter_var($id, FILTER_VALIDATE_INT);

  if (!in_array($tableName, $validTableNames) || !$id) {
    header("Location:/admin");
    exit;
  }

  return ['id' => $id, 'tableName' => $tableName];
}

function processImages($imagesUpload, $imageInstances, $property)
{
  $imageNames = array_column($imageInstances, 'name');
  $propertyImages = explode(',', $property->images);

  $imagesUpload->combineArrays($imageNames, $propertyImages);
  $imagesUpload->deleteImagesFromPost($_POST, FOLDER_IMAGES);
  $imagesUpload->processImageNames();
  $imagesUpload->saveImages($imageInstances, FOLDER_IMAGES, $property);
}

function handleDBUpdate($typeChanged, $originalType, $type, $property)
{
  if ($typeChanged) {
    // Delete row registry by correct table
    $property->delete($originalType);

    // Insert new row registry by ad type change
    return $property->insert($type);
  } else {
    // Update row registry into correct table
    return $property->update($originalType);
  }
}
