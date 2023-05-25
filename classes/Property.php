<?php

declare(strict_types=1);

namespace App;

class Property
{
  // Database data
  protected static $db;

  // Property attributes
  public $id;
  public $title;
  public $currency;
  public $price;
  public $province;
  public $canton;
  public $images;
  public $description;
  public $rooms;
  public $wc;
  public $parking;
  public $date;
  public $vendorId;

  public static function setDB($database)
  {
    self::$db = $database;
  }

  // Constructor
  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? '';
    $this->title = $args['title'] ?? '';
    $this->currency = $args['currency'] ?? '';
    // Formatting price value
    if (isset($args['price'])) {
      $this->price = $this->formatPrice($args['price']);
    } else {
      $this->price = '';
    }
    $this->province = $args['province'] ?? '';
    $this->canton = $args['canton'] ?? '';
    $this->images = $args['images'] ?? '';
    $this->description = $args['description'] ?? '';
    $this->rooms = $args['rooms'] ?? '';
    $this->wc = $args['wc'] ?? '';
    $this->parking = $args['parking'] ?? '';
    $this->date = date('Y-m-d');
    $this->vendorId = $args['vendorId'] ?? '';
  }

  // Agrega la función formatPrice dentro de la clase Property
  private function formatPrice($price)
  {
    return str_replace(',', '', $price);
  }

  public function insert($type)
  {
    // Get property values
    $attributes = $this->attributes();

    // Build column and value lists
    $columns = implode(', ', array_map(function ($key) { return ltrim($key, ':'); }, array_keys($attributes)));
    $values = implode(', ', array_keys($attributes));

    // Query into db
    if ($type == 1) {
      $query = "INSERT INTO realestates ($columns) VALUES ($values)";
    } elseif ($type == 2) {
      $query = "INSERT INTO rentals ($columns) VALUES ($values)";
    }

    $stmt = self::$db->prepare($query);
    return $stmt->execute($attributes);
  }

  // Assign image names to attribute
  public function setImages($imageNamesStr)
  {
    if ($imageNamesStr) {
      $this->images = $imageNamesStr;
    }
  }

  // Convert values to an associative array
  public function attributes()
  {
    return [
      ':title' => $this->title,
      ':currency' => $this->currency,
      ':price' => $this->price,
      ':province' => $this->province,
      ':canton' => $this->canton,
      ':images' => $this->images,
      ':description' => $this->description,
      ':rooms' => $this->rooms,
      ':wc' => $this->wc,
      ':parking' => $this->parking,
      ':date' => $this->date,
      ':vendorId' => $this->vendorId
    ];
  }
}
