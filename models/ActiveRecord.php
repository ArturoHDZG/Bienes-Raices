<?php

namespace Model;

class ActiveRecord
{
  // Database attributes
  protected static $db;
  protected static $table = '';
  public $id;

  public $source;
  public $province;
  public $canton;

  public static function setDB($database)
  {
    self::$db = $database;
  }

  // DB insert
  public function insert($attributes)
  {
    $columns = implode(', ', array_map(function ($key) { return ltrim($key, ':'); }, array_keys($attributes)));
    $values = implode(', ', array_keys($attributes));

    $query = "INSERT INTO " . static::$table . " ({$columns}) VALUES ({$values})";
    $stmt = self::$db->prepare($query);
    return $stmt->execute($attributes);
  }

  // DB Update
  public function insertUpdate($setValues, $bindValues)
  {
    $query = "UPDATE " . static::$table . " SET {$setValues} WHERE id = :id LIMIT 1";
    $stmt = self::$db->prepare($query);
    foreach ($bindValues as $key => $value) {
      $stmt->bindValue($key, $value);
    }
    $stmt->bindValue(':id', $this->id);
    return $stmt->execute();
  }

  // DB delete
  public function insertDelete()
  {
    $query = "DELETE FROM " . static::$table . " WHERE id = :id LIMIT 1";
    $stmt = self::$db->prepare($query);
    $stmt->bindValue(':id', $this->id);
    return $stmt->execute();
  }

  // List all items for use in view
  public static function allTables()
  {
    $query =
    "SELECT realestates.*, province.province
     AS province_name, canton.canton
     AS canton_name, 'realestates' as source
     FROM realestates JOIN province
     ON realestates.province = province.id
     JOIN canton ON realestates.canton = canton.id
     UNION ALL SELECT rentals.*, province.province
     AS province_name, canton.canton
     AS canton_name, 'rentals' as source
     FROM rentals JOIN province ON rentals.province = province.id JOIN canton ON rentals.canton = canton.id";

    $stmt = self::$db->query($query);
    return self::mapData($stmt);
  }

  // List all items for use in view
  public static function limitResults($limit)
  {
    $query = "SELECT * FROM (
      SELECT realestates.*, province.province AS province_name, canton.canton AS canton_name, 'realestates' as source
      FROM realestates
      JOIN province ON realestates.province = province.id
      JOIN canton ON realestates.canton = canton.id
      ORDER BY date DESC LIMIT $limit
    ) AS realestates
    UNION ALL
    SELECT * FROM (
      SELECT rentals.*, province.province AS province_name, canton.canton AS canton_name, 'rentals' as source
      FROM rentals
      JOIN province ON rentals.province = province.id
      JOIN canton ON rentals.canton = canton.id
      ORDER BY date DESC LIMIT $limit
    ) AS rentals";

    $stmt = self::$db->query($query);
    return self::mapData($stmt);
  }

  // List items by Table and ID for use in View
  public static function findAd($id, $tableName)
  {
    $query = "SELECT {$tableName}.*, province.province
     AS province_name, canton.canton AS canton_name
     FROM {$tableName} JOIN province
     ON {$tableName}.province = province.id
     JOIN canton ON {$tableName}.canton = canton.id WHERE {$tableName}.id = :id";

    $stmt = self::$db->prepare($query);
    $stmt->execute([':id' => $id]);

    $results = self::mapData($stmt);
    return array_shift($results);
  }

  // List all items by table
  public static function all($table)
  {
    $stmt = self::$db->query("SELECT * FROM " . static::$table);
    return self::mapData($stmt);
  }

  // List items by Table and ID
  public static function find($id, $tableName)
  {
    $stmt = self::$db->prepare("SELECT * FROM {$tableName} WHERE id = :id");
    $stmt->execute([':id' => $id]);

    $results = self::mapData($stmt);
    return array_shift($results);
  }

  // Create objects
  protected static function mapData($stmt)
  {
    $results = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
      foreach ($row as $key => $value) {
        if ($key != 'date') {
          $row[$key] = strval($value);
        }
      }

      $object = new static($row);
      if (isset($row['source'])) {
        $object->source = $row['source'];
      } else {
        unset($object->source);
      }

      if (isset($row['province_name'])) {
        $object->province = $row['province_name'];
      }

      if (isset($row['canton_name'])) {
        $object->canton = $row['canton_name'];
      }

      if (!isset($row['province'])) {
        unset($object->province, $object->canton);
      }

      $results[] = $object;
    }

    return $results;
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

  public static function getProvinces()
  {
    $db = self::$db;
    $queryProvince = "SELECT * FROM province";

    return $db->query($queryProvince);
  }
}
