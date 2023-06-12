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

    // Get message code
    $code = $_GET['result'] ?? null;

    if (isset($_GET['type'])) {
      $table = $_GET['type'];
      $realEstates = RealEstates::all($table);
    } else {
      $realEstates = [];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // code
    }

    $router->modelData('\Views\Admin\Admin', [
      'realEstates' => $realEstates,
      'type' => $table,
      'code' => $code
    ]);

    $content = \Views\Admin\Admin::getContent();
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
    $imagesOutput = '';

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

    $router->modelData('\Views\Admin\RealEstates\Create', [
      'property' =>
       ($_SERVER['REQUEST_METHOD'] == 'POST') ? $property : $realEstate,
      'type' =>
       ($_SERVER['REQUEST_METHOD'] == 'POST') ? $type : $table,
      'answerProvince' => $answerProvince,
      'imagesOutput' => $imagesOutput,
      'includeHiddenField' => false,
      'vendors' => $seller,
      'canton' => $canton,
      'errors' => $errors
    ]);
    $content = \Views\Admin\RealEstates\Create::getContent();
    $router->render($content);
  }

  // Show Realestate Update Form
  public static function update()
  {
    echo 'PRUEBA - Modificar Anuncio';
  }
}
