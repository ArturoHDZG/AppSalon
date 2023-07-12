<?php

namespace Model;

class Reservations extends ActiveRecord
{
  // DB Attributes
  protected static $table = 'reservations';
  protected static $columnsDB = [
    'id',
    'date',
    'time',
    'usersId'
  ];

  public $id;
  public $date;
  public $time;
  public $usersId;

  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->date = $args['date'] ?? '';
    $this->time = $args['time'] ?? '';
    $this->usersId = $args['usersId'] ?? '';
  }
}
