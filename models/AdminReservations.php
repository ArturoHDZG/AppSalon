<?php

namespace Model;

class AdminReservations extends ActiveRecord
{
  protected static $table = 'services_reservations';
  protected static $columnsDB = [
    'id',
    'time',
    'costumer',
    'email',
    'phone',
    'service',
    'price'
  ];

  public $id;
  public $time;
  public $costumer;
  public $email;
  public $phone;
  public $service;
  public $price;

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->time = $args['time'] ?? '';
    $this->costumer = $args['costumer'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->phone = $args['phone'] ?? '';
    $this->service = $args['service'] ?? '';
    $this->price = $args['price'] ?? '';
  }
}
