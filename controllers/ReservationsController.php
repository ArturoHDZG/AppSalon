<?php

namespace Controllers;

use MVC\Router;

class ReservationsController
{
  public static function index(Router $router)
  {
    $router->render('reservations/index', [
      'id' => $_SESSION['id'],
      'name' => $_SESSION['name']
    ]);
  }
}
