<?php

namespace Model;

class Service extends ActiveRecord
{
  // DB Attributes
  protected static $table = 'services';
  protected static $columnsDB = ['id', 'name', 'price'];

  public $id;
  public $name;
  public $price;

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->name = $args['name'] ?? '';
    $this->price = $args['price'] ?? '';
  }

  public function validate()
  {
    if(!$this->name) {
      self::$alerts['error'][] = 'Please provide a Name';
    }

    if(!$this->price) {
      self::$alerts['error'][] = 'Please provide a Price';
    } elseif(!is_numeric($this->price)) {
      self::$alerts['error'][] = 'Only Numeric Values are Allowed';
    }

    return self::$alerts;
  }
}
