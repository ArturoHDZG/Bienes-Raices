<?php

namespace App;

class Property extends ActiveRecord
{
  // Misc attributes
  protected static $table = '';
  const PRICE = ':price';

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
    $this->date = $args['date'] ?? date('Y-m-d');
    $this->vendorId = $args['vendorId'] ?? '';
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

  // Get table name
  public static function setTable($table)
  {
    if ($table == '1') {
      static::$table = 'realestates';
    } elseif ($table == '2') {
      static::$table = 'rentals';
    }
  }

  // Get table for properties
  public static function all($table)
  {
    static::setTable($table);
    return parent::all($table);
  }

  // Assign image names to $images attribute
  public function setImages($imageNamesStr)
  {
    if ($imageNamesStr) {
      $this->images = $imageNamesStr;
    }
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

  // Prepare data for insert
  public function insert($table)
  {
    self::setTable($table);

    $attributes = $this->attributes();
    foreach ($attributes as $key => &$value) {
      if ($key == self::PRICE) {
        $value = str_replace(',', '', $value);
      }
    }

    return parent::insert($attributes);
  }

  // Prepare data for update
  public function update($table)
  {
    self::setTable($table);
    $attributes = $this->attributes();

    foreach ($attributes as $key => &$value) {
      if ($key == self::PRICE) {
        $value = str_replace(',', '', $value);
      }
    }
    unset($value);

    $values = [];
    foreach ($attributes as $key => $value) {
      if ($key != ':id') {
        array_push($values, substr($key, 1) . "=$key");
      }
    }
    unset($attributes[':id']);

    return parent::insertUpdate(implode(", ", $values), array_merge([':id' => $this->id], array_filter($attributes)));
  }

  // Prepare data for delete
  public function delete($table)
  {
    self::setTable($table);

    // Delete images from server
    $queryImages = "SELECT images FROM " . static::$table . " WHERE id = :id LIMIT 1";
    $stmt = self::$db->prepare($queryImages);
    $stmt->bindValue(':id', $this->id);
    $stmt->execute();
    $property = $stmt->fetch(\PDO::FETCH_ASSOC);
    $images = explode(',', $property['images']);

    foreach ($images as $image) {
      unlink('../images/' . $image);
    }

    return parent::insertDelete();
  }
}
