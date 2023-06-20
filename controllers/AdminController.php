<?php

namespace Controllers;

//Instances
use MVC\AdminRouter;
use Model\RealEstates;
use Model\Sellers;
use Model\Images;
use Model\Validation;

class AdminController
{
  // Show Admin Panel
  public static function admin(AdminRouter $router)
  {
    // Define necessary starting variables
    $table = null;
    $tableName = '';
    $type = '';
    $source = '';

    // Get message code
    $code = $_GET['result'] ?? null;

    if (isset($_GET['type'])) {
      $table = $_GET['type'];
      $realEstates = RealEstates::all($table);
    } else {
      $realEstates = [];
    }

    // Get table name for use in URL
    if (isset($_GET['type'])) {
      $type = $_GET['type'];

      if ($type == '1') {
        $tableName = 'realestates';
      } elseif ($type == '2') {
        $tableName = 'rentals';
      }
    }

    //Assign table for properties
    if ($type == 1
    ) {
      $source = 'realestates';
    } elseif ($type == 2) {
      $source = 'rentals';
    }

    // Get vendors
    $resultVendors = Sellers::all(null);

    $router->modelData('\Views\admin\Admin', [
      'realEstates' => $realEstates,
      'resultVendors' => $resultVendors,
      'type' => $table,
      'tableName' => $tableName,
      'source' => $source,
      'code' => $code
    ]);

    $content = \Views\admin\Admin::getContent();
    $router->render($content);
  }

  // Show Realestate Create Form
  public static function create(AdminRouter $router)
  {
    // Instances
    $validation = new Validation;
    $realEstate = new RealEstates;
    $answerProvince = RealEstates::getProvinces();
    $seller = Sellers::all(null);

    // Define necessary starting variables
    $cantonValue = '';
    $imagesOutput = '';
    $canton = '';

    // Define starting errors array
    $errors = [];

    if (isset($_GET['type'])) {
      $table = $_GET['type'];
    } else {
      $table = '';
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      // Instances
      $property = new RealEstates($_POST);

      // Save canton selection from JS
      if (isset($_POST['canton'])) {
        $canton = $_POST['canton'];
      }

      // Send Canton Value to JS
      cantonValue($canton);

      if (isset($_POST['type'])) {
        $type = $_POST['type'];
      }

      // Processing images
      $imagesUpload = new Images($_FILES);
      $imageInstances = $imagesUpload->processImages();

      // Error messages
      $validation->validateProperty($_POST, $_FILES, $imageInstances);
      $errors = $validation->getErrors();

      // Valid form
      if (empty($errors)) {
        // Upload images to server and insert name fot DB
        $imagesUpload->saveImages($imageInstances, FOLDER_IMAGES, $property);

        // Insert into DB and result of insertion
        $writeDB = $property->insert($type);

        if ($writeDB) {
          header("Location:/admin?result=1", true, 303);
          exit;
        }
      }
    }

    $router->modelData('\Views\admin\realestates\Create', [
      'property' =>
       ($_SERVER['REQUEST_METHOD'] == 'POST') ? $property : $realEstate,
      'type' =>
       ($_SERVER['REQUEST_METHOD'] == 'POST') ? $type : $table,
      'answerProvince' => $answerProvince,
      'imagesOutput' => $imagesOutput,
      'cantonValue' => $cantonValue,
      'includeHiddenField' => false,
      'vendors' => $seller,
      'canton' => $canton,
      'errors' => $errors
    ]);
    $content = \Views\admin\realestates\Create::getContent();
    $router->render($content);
  }

  // Show Realestate Update Form
  public static function update(AdminRouter $router)
  {
    // Header Function Cache
    ob_start();

    // Instances
    $validation = new Validation;
    $answerProvince = RealEstates::getProvinces();
    $seller = Sellers::all(null);

    // Get property ID and Table_name
    $urlParams = validateUrlParams($_GET['id'], $_GET['table_name']);
    $id = $urlParams['id'];
    $tableName = $urlParams['tableName'];

    // Get variables by title
    if ($tableName == 'realestates') {
      $type = '1';
    } elseif ($tableName == 'rentals') {
      $type = '2';
    }

    if ($tableName == 'realestates') {
      $originalType = '1';
    } elseif ($tableName == 'rentals') {
      $originalType = '2';
    }

    // Define starting errors array
    $errors = [];

    // Define necessary starting variables
    $cantonValue = '';
    $table = $type;

    // Get property data from correct table
    $property = RealEstates::find($id, $tableName);
    $imagesOutput = $property->showImages();
    $canton = $property->canton;
    $oldProperty = $property;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Read and change property attributes from POST
      if (isset($_POST['type'])) {
        $type = $_POST['type'];
      }

      $args = $_POST;
      $property->modifyMap($args);

      // Processing loaded images
      $imagesUpload = new Images($_FILES);
      $imageInstances = $imagesUpload->processImages();

      // Validate POST data
      $data = get_object_vars($property);
      $validation->validateProperty($data, $_FILES, $imageInstances);
      $errors = $validation->getErrors();

      if (empty($errors)) {
        // Process old, new and removed images
        processImages($imagesUpload, $imageInstances, $property);

        // Validate for ad type changes
        $typeChanged = ($originalType != $type);

        $dbSuccess = handleDBUpdate($typeChanged, $originalType, $type, $property);
        if ($dbSuccess) {
          header("Location:/admin?result=2", true, 303);
          exit;
        }
      }
    }

    // Send Canton Value to JS
    cantonValue($canton);

    $router->modelData('\Views\admin\realestates\Update', [
      'property' =>
       ($_SERVER['REQUEST_METHOD'] == 'POST') ? $property : $oldProperty,
      'type' =>
       ($_SERVER['REQUEST_METHOD'] == 'POST') ? $type : $table,
      'answerProvince' => $answerProvince,
      'imagesOutput' => $imagesOutput,
      'cantonValue' => $cantonValue,
      'includeHiddenField' => true,
      'property' => $property,
      'vendors' => $seller,
      'canton' => $canton,
      'errors' => $errors
    ]);
    $content = \Views\admin\realestates\Update::getContent();
    $router->render($content);
  }

  // Delete Realestate
  public static function delete()
  {
    // Get table name for use in URL
    if (isset($_GET['type'])) {
      $type = $_GET['type'];

      if ($type == '1') {
        $tableName = 'realestates';
      } elseif ($type == '2') {
        $tableName = 'rentals';
      }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = $_POST['id'];
      $id = filter_var($id, FILTER_VALIDATE_INT);

      if ($id) {
        $typeContent = $_POST['adminIndexType'];

        if (validateContent($typeContent)) {
          $property = RealEstates::find($id, $tableName);
          $deleteDB = $property->delete($type);
        }
      }

      if ($deleteDB) {
        header("Location:/admin?result=3", true, 303);
      }
    }
  }
}
