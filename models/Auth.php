<?php

namespace Model;

class Auth extends ActiveRecord
{
  // Attributes
  protected static $table = 'vendors';
  protected static $errors = [];
  protected static $columnsDB = ['id', 'name', 'email', 'password'];

  public $id;
  public $name;
  public $email;
  public $password;

  // Constructor
  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->name = $args['name'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->password = $args['password'] ?? '';
  }

  // Validate Input Data
  public function loginValidate()
  {
    if (!$this->email) {
      self::$errors[] = 'Dirección de correo inválida';
    }

    if (!$this->password) {
      self::$errors[] = 'Contraseña inválida';
    }

    return self::$errors;
  }

  // Validate if user exists
  public function userExists()
  {
    $errors = [];
    $user = null;

    $query = "SELECT * FROM " . self::$table . " WHERE email = :email LIMIT 1";
    $stmt = self::$db->prepare($query);
    $stmt->bindValue(':email', $this->email);
    $stmt->execute();
    $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    if (empty($results)) {
      $errors[] = 'Dirección de correo incorrecta';
    } else {
      $user = $results[0];
    }

    return [
      'errors' => $errors,
      'user' => $user
    ];
  }

  // Validate User Password
  public function validatePass($user)
  {
    $errors = [];
    $password = $user['password'];
    $userAuth = password_verify($this->password, $password);

    if (!$userAuth) {
      $errors[] = 'Contraseña incorrecta';
    }

    return [
      'errors' => $errors,
      'authenticated' => $userAuth
    ];
  }

  // Login Session
  public function isAuthenticated()
  {
    session_start();

    $_SESSION['user'] = $this->email;
    $_SESSION['login'] = true;

    header("Location:/admin");
  }
}
