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
}