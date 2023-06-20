<?php

namespace Controllers;

//Instances
use MVC\AdminRouter;
use Model\Sellers;
use Model\Validation;
use Random\Engine\Secure;

class SellersController
{
  public static function create(AdminRouter $router)
  {
    // Instances
    $seller = new Sellers;
    $validation = new Validation;

    // Define starting errors array
    $errors = [];

    // Get POST data
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Instances
      $vendor = new Sellers($_POST);

      // Error messages
      $validation->validateVendors($_POST);
      $errors = $validation->getErrors();

      // Valid form
      if (empty($errors)) {
        $attributes = $vendor->attributes();
        $writeDB = $vendor->insert($attributes);

        if ($writeDB) {
          header("Location:/admin?result=4", true, 303);
          exit;
        }
      }
    }

    $router->modelData('\Views\admin\sellers\Create', [
      'vendor' =>
       ($_SERVER['REQUEST_METHOD'] == 'POST') ? $vendor : $seller,
      'errors' => $errors
    ]);
    $content = \Views\admin\sellers\Create::getContent();
    $router->render($content);
  }

  public static function update(AdminRouter $router)
  {
    // Instances
    $validation = new Validation;

    // Get vendor ID
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if (!$id) {
      header('Location:/admin');
    }

    // Get seller to update
    $tableName = 'vendors';
    $seller = Sellers::find($id, $tableName);

    // Define starting errors array
    $errors = [];

    // Get POST data
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Updated vendor
      $args = $_POST;
      $seller->modifyMap($args);
      $vendor = $seller;

      // Error messages
      $validation->validateVendors($_POST);
      $errors = $validation->getErrors();

      // Valid form
      if (empty($errors)) {
        $writeDB = $vendor->update();

        if ($writeDB) {
          header("Location:/admin?result=5", true, 303);
          exit;
        }
      }
    }

    $router->modelData('\Views\admin\sellers\Update', [
      'vendor' =>
       ($_SERVER['REQUEST_METHOD'] == 'POST') ? $vendor : $seller,
      'errors' => $errors
    ]);
    $content = \Views\admin\sellers\Update::getContent();
    $router->render($content);
  }

  public static function delete()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $id = $_POST['id'];
      $id = filter_var($id, FILTER_VALIDATE_INT);

      if ($id) {
        $typeContent = $_POST['adminIndexType'];

        if (validateContent($typeContent)) {
          $tableName = 'vendors';
          $vendor = Sellers::find($id, $tableName);
          $deleteDB = $vendor->insertDelete();
        }
      }

      if ($deleteDB) {
        header("Location:/admin?result=6", true, 303);
      }
    }
  }
}
