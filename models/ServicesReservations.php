<?php

namespace Model;

class ServicesReservations extends ActiveRecord
{
  protected static $table = 'services_reservations';
  protected static $columnsDB = [
    'id',
    'reservationsId',
    'servicesId'
  ];

  public $id;
  public $reservationsId;
  public $servicesId;

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->reservationsId = $args['reservationsId'] ?? '';
    $this->servicesId = $args['servicesId'] ?? '';
  }
}
