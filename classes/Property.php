<?php

declare(strict_types=1);
namespace App;

class Property
{
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
    $this->date = date('Y-m-d');
    $this->vendorId = $args['vendorId'] ?? '';
  }

  public function insert($type)
  {
    // Query into db
    if ($type == 1) {
      $query = "INSERT INTO realestates (title, currency, price, province, canton, images, description, rooms, wc, parking, date, vendorId)
      VALUES ('$this->title', '$this->currency', '$this->price', '$this->province', '$this->canton', '$this->images', '$this->description', '$this->rooms', '$this->wc', '$this->parking', '$this->date', '$this->vendorId')";
      exit;
    } elseif ($type == 2) {
      $query = "INSERT INTO rentals (title, currency, price, province, canton, images, description, rooms, wc, parking, date, vendorId)
      VALUES ('$this->title', '$this->currency', '$this->price', '$this->province', '$this->canton', '$this->images', '$this->description', '$this->rooms', '$this->wc', '$this->parking', '$this->date', '$this->vendorId')";
    }
  }
}
