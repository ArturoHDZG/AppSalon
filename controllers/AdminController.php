<?php

namespace Controllers;

use Model\AdminReservations;
use MVC\Router;

class AdminController
{
  public static function index(Router $router)
  {
    $query  = "SELECT reservations.id, reservations.time, ";
    $query .= "CONCAT (users.name, ' ', users.lastName) ";
    $query .= "AS costumer, users.email, users.phone, services.name ";
    $query .= "AS service, services.price ";
    $query .= "FROM reservations ";
    $query .= "LEFT OUTER JOIN users ";
    $query .= "ON reservations.usersId = users.id ";
    $query .= "LEFT OUTER JOIN services_reservations ";
    $query .= "ON services_reservations.reservationsId = reservations.id ";
    $query .= "LEFT OUTER JOIN services ";
    $query .= "ON services.id = services_reservations.servicesId ";
    // $query .= "WHERE date = '{$date}'";

    $reservations = AdminReservations::customSQL($query);

    $router->render('admin/index', [
      'name' => $_SESSION['name'],
      'reservations' => $reservations
    ]);
  }
}
