<?php

namespace App;

class ActiveRecord
{
  // Database attributes
  protected static $db;
  protected static $table = '';
  public $id = '';

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

  // List all items
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
      $results[] = new static($row);
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
}
