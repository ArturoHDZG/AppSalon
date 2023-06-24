<?php

namespace Model;

class ActiveRecord
{
  // DB Attributes
  protected static $db;
  protected static $table = '';
  protected static $columnsDB = [];

  // Alert Messages
  protected static $alerts = [];

  // DB Connection
  public static function setDB($database)
  {
    self::$db = $database;
  }

  public static function setAlert($type, $message)
  {
    static::$alerts[$type][] = $message;
  }

  // Validation
  public static function getAlerts()
  {
    return static::$alerts;
  }

  public function validate()
  {
    static::$alerts = [];
    return static::$alerts;
  }

  // SQL query to build a Object
  public static function querySQL($query)
  {
    $result = self::$db->query($query);

    $array = [];
    while($registry = $result->fetch_assoc()) {
      $array[] = static::createObject($registry);
    }

    $result->free();

    return $array;
  }

  // Build a Mirror DB Object
  protected static function createObject($registry)
  {
    $object = new static;

    foreach($registry as $key => $value ) {
      if(property_exists( $object, $key  )) {
        $object->$key = $value;
      }
    }

    return $object;
  }

  // Mapping DB Attributes to Build Objects
  public function attributes()
  {
    $attributes = [];

    foreach(static::$columnsDB as $column) {
      if ($column === 'id') continue;
      $attributes[$column] = $this->$column;
    }

    return $attributes;
  }

  // Sanitize Data Attributes Before Save Into DB
  public function sanitizeAttributes()
  {
    $attributes = $this->attributes();
    $sanitized = [];
    foreach($attributes as $key => $value ) {
      $sanitized[$key] = self::$db->escape_string($value);
    }

    return $sanitized;
  }

  // Sync Mirror Object With DB
  public function sync($args=[])
  {
    foreach($args as $key => $value) {
      if(property_exists($this, $key) && !is_null($value)) {
        $this->$key = $value;
      }
    }
  }

  // CRUD Register
  public function save() {
    $result = '';

    if(!is_null($this->id)) {
      $result = $this->update();
    } else {
      $result = $this->create();
    }

    return $result;
  }

  // All registries
  public static function all()
  {
      $query = "SELECT * FROM " . static::$table;
      $result = self::querySQL($query);
      return $result;
  }

  // Find Registry by ID
  public static function find($id)
  {
    $query = "SELECT * FROM " . static::$table  ." WHERE id = {$id}";
    $result = self::querySQL($query);
    return array_shift($result) ;
  }

  // Find Registry by Column and Value
  public static function where($column, $value)
  {
    $query = "SELECT * FROM " . static::$table  ." WHERE {$column} = '{$value}'";
    $result = self::querySQL($query);
    return array_shift($result) ;
  }

  // Obtener Registros con cierta cantidad
  public static function get($limit)
  {
    $query = "SELECT * FROM " . static::$table . " LIMIT {$limit}";
    $result = self::querySQL($query);
    return array_shift($result) ;
  }

  // Create new Entry
  public function create()
  {
    $attributes = $this->sanitizeAttributes();

    // Insert
    $query = " INSERT INTO " . static::$table . " ( ";
    $query .= join(', ', array_keys($attributes));
    $query .= " ) VALUES ('";
    $query .= join("', '", array_values($attributes));
    $query .= "') ";

    // Resultado de la consulta
    $result = self::$db->query($query);

    return [
      'resultado' =>  $result,
      'id' => self::$db->insert_id
    ];
  }

  // Update Entry
  public function update()
  {
    $attributes = $this->sanitizeAttributes();

    // Iterar para ir agregando cada campo de la BD
    $values = [];
    foreach($attributes as $key => $value) {
        $values[] = "{$key}='{$value}'";
    }

    // SQL Query
    $query = "UPDATE " . static::$table ." SET ";
    $query .=  join(', ', $values );
    $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
    $query .= " LIMIT 1 ";

    // BD Update
    $result = self::$db->query($query);
    return $result;
  }

  // Delete Entry form DB
  public function delete()
  {
    $query = "DELETE FROM "  . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
    $result = self::$db->query($query);
    return $result;
  }
}
