<?php

namespace Controllers;

//Instances
use MVC\AdminRouter;
use Model\Auth;

class AuthController
{
  public static function login(AdminRouter $router)
  {
    // Protect Path
    if (isset($_SESSION['login'])) {
      header("Location:/");
      exit;
    }

    // Define error array
    $errors = [];

    // Validate form data
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Instance
      $auth = new Auth($_POST);

      // Error messages
      $errors = $auth->loginValidate();

      // Validate data in DB
      if (empty($errors)) {
        $results = $auth->userExists();
        $errors = array_merge($errors, $results['errors']);

        if (empty($errors)) {
          $user = $results['user'];
          $results = $auth->validatePass($user);
          $errors = array_merge($errors, $results['errors']);
          $authenticated = $results['authenticated'];

          if ($authenticated) {
            $auth->isAuthenticated();
          }
        }
      }
    }

    $router->modelData('\Views\Auth\Login', [
      'errors' => $errors
    ]);
    $content = \Views\Auth\Login::getContent();
    $router->render($content);
  }

  public static function logout()
  {
    session_start();

    $_SESSION = [];

    if (empty($_SESSION)) {
      header("Location:/");
    }
  }
}
