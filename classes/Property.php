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
    $this->price = $args['price'] ?? '';
    $this->province = $args['province'] ?? '';
    $this->canton = $args['canton'] ?? '';
    $this->images = $args['images'] ?? '';
    $this->description = $args['description'] ?? '';
    $this->rooms = $args['rooms'] ?? '';
    $this->wc = $args['wc'] ?? '';
    $this->parking = $args['parking'] ?? '';
    $this->date = $args['date'] ?? '';
    $this->vendorId = $args['vendorId'] ?? '';
  }

  // Format input price
  private function formatPrice($price)
  {
    return str_replace(',', '', $price);
  }

  // Create property into DB
  public function insert($type)
  {
    if ($type == '1') {
      $table = 'realestates';
    } elseif ($type == '2') {
      $table = 'rentals';
    }

    $attributes = $this->attributes();
    foreach ($attributes as $key => $value) {
      if ($key == ':price') {
        $attributes[$key] = $this->formatPrice($value);
      }
    }

    $columns = implode(', ', array_map(function ($key) { return ltrim($key, ':'); }, array_keys($attributes)));
    $values = implode(', ', array_keys($attributes));

    $query = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";
    $stmt = self::$db->prepare($query);
    return $stmt->execute($attributes);
  }

  // Modify property from DB
  public function update($type)
  {
    if ($type == '1') {
      $table = 'realestates';
    } elseif ($type == '2') {
      $table = 'rentals';
    }

    $attributes = $this->attributes();
    foreach ($attributes as $key => $value) {
      if ($key == ':price') {
        $attributes[$key] = $this->formatPrice($value);
      }
    }

    $values = [];
    $bindValues = [];
    foreach ($attributes as $key => $value) {
      $key = substr($key, 1);
      $values[] = "{$key}=:{$key}";
      $bindValues[":{$key}"] = $value;
    }
    $setValues = implode(", ", $values);

    $query = "UPDATE {$table} SET {$setValues} WHERE id = :id LIMIT 1";
    $stmt = self::$db->prepare($query);
    foreach ($bindValues as $key => $value) {
      $stmt->bindValue($key, $value);
    }
    $stmt->bindValue(':id', $this->id);
    return $stmt->execute();
  }

  // Delete property from DB
  public function delete($type)
  {
    if ($type == '1') {
      $table = 'realestates';
    } elseif ($type == '2') {
      $table = 'rentals';
    }

    $query = "DELETE FROM {$table} WHERE id = :id LIMIT 1";
    $queryImages = "SELECT images FROM {$table} WHERE id = :id LIMIT 1";

    $stmt = self::$db->prepare($queryImages);
    $stmt->bindValue(':id', $this->id);
    $stmt->execute();
    $property = $stmt->fetch(\PDO::FETCH_ASSOC);
    $images = explode(',', $property['images']);

    foreach ($images as $image) {
      unlink('../images/' . $image);
    }

    $stmt = self::$db->prepare($query);
    $stmt->bindValue(':id', $this->id);
    return $stmt->execute();
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
    $imagesOutput = '';

    foreach ($imagesArray as $image) {
      $imagesOutput .= '<div class="thumbnail">';
      $imagesOutput .= '<img class="thumb" src="/images/' . $image . '" alt="Miniatura de la propiedad">';
      $imagesOutput .= '<span class="delete">x</span>';
      $imagesOutput .= '</div>';
    }

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
