<?php

namespace App;

class Vendors extends ActiveRecord
{
  // Database attributes
  protected static $table = 'vendors';

  // Vendors attributes
  public $id;
  public $name;
  public $lastname;
  public $phone;
  public $email;
  public $password;
  public $date;

  // Constructor
  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? '';
    $this->name = $args['name'] ?? '';
    $this->lastname = $args['lastname'] ?? '';
    $this->phone = $args['phone'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->password = $args['password'] ?? '1234';
    $this->date = $args['date'] ?? date('Y-m-d');
  }

  // Convert values to an associative array
  public function attributes()
  {
    return [
      ':name' => $this->name,
      ':lastname' => $this->lastname,
      ':phone' => $this->phone,
      ':email' => $this->email,
      ':password' => $this->password,
      ':date' => $this->date
    ];
  }

  public function update()
  {
    $attributes = $this->attributes();

    $values = [];
    foreach ($attributes as $key => $value) {
      if ($key != ':id') {
        array_push($values, substr($key, 1) . "=$key");
      }
    }
    unset($attributes[':id']);

    return parent::insertUpdate(implode(", ", $values), array_merge([':id' => $this->id], array_filter($attributes)));
  }
}
