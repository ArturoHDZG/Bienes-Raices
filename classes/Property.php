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

  // List all properties
  public static function all($type)
  {
    if ($type == 1) {
      $stmt = self::$db->query("SELECT * FROM realestates");
    } elseif ($type == 2) {
      $stmt = self::$db->query("SELECT * FROM rentals");
    }

    return self::mapData($stmt);
  }

  // List property by Table and ID
  public static function find($id, $tableName)
  {
    if ($tableName == 'realestates') {
      $stmt = self::$db->prepare("SELECT * FROM realestates WHERE id = :id");
    } elseif ($tableName == 'rentals') {
      $stmt = self::$db->prepare("SELECT * FROM rentals WHERE id = :id");
    }
    $stmt->execute([':id' => $id]);

    $results = self::mapData($stmt);
    return array_shift($results);
  }

  // Mapping queries
  protected static function mapData($stmt)
  {
    $results = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      foreach ($row as $key => $value) {
        if ($key != 'date') {
          $row[$key] = strval($value);
        }
      }
      $results[] = new self($row);
    }

    return $results;
  }

  // Show images from selected property
  public function showImages()
  {
    $propertyImages = $this->images;
    $imagesArray = explode(",", $propertyImages);

    foreach ($imagesArray as $image) {
      echo '<div class="thumbnail">';
      echo '<img class="thumb" src="/images/' . $image . '" data-image="' . $image . '" alt="Miniatura de la propiedad">';
      echo '<span class="delete">x</span>';
      echo '</div>';
    }

    $imagesOutput = ob_get_contents();
    ob_clean();

    return $imagesOutput;
  }

  // Modify map in properties
  public function modifyMap($args = [])
  {
    foreach ($args as $key => $value) {
      if (property_exists($this, $key) && !is_null($value)) {
        $this->$key = $value;
      }
    }
  }
}
