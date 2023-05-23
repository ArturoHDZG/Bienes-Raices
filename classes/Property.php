<?php

declare(strict_types=1);
namespace App;

class Property
{
  // Property attributes
  public int $id;
  public string $title;
  public string $currency;
  public string $price;
  public int $province;
  public int $canton;
  public string $images;
  public string $description;
  public int $rooms;
  public int $wc;
  public int $parking;
  public string $date;
  public int $vendorId;

  // Constructor
  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? 0;
    $this->title = $args['title'] ?? '';
    $this->currency = $args['currency'] ?? '';
    $this->price = $args['price'] ?? '';
    $this->province = $args['province'] ?? 0;
    $this->canton = $args['canton'] ?? 0;
    $this->images = $args['images'] ?? '';
    $this->description = $args['description'] ?? '';
    $this->rooms = $args['rooms'] ?? 0;
    $this->wc = $args['wc'] ?? 0;
    $this->parking = $args['parking'] ?? 0;
    $this->date = $args['date'] ?? '';
    $this->vendorId = $args['vendorId'] ?? 0;
  }
}
