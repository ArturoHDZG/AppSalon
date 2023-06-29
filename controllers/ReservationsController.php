<?php

namespace Controllers;

use MVC\Router;

class ReservationsController
{
  public static function index(Router $router)
  {
    $router->render('reservations/index', [
      'name' => $_SESSION['name']
    ]);
  }
}
