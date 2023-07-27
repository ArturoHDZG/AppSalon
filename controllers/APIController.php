<?php

namespace Controllers;

use Model\Reservations;
use Model\Service;
use Model\ServicesReservations;

class APIController
{
  public static function index()
  {
    $services = Service::all();
    echo json_encode($services);
  }

  public static function save()
  {
    // Save Reservations and Return an ID
    $reservation = new Reservations($_POST);
    $result = $reservation->save();
    $id = $result['id'];

    // Save Services and Reservations' ID
    $servicesId = explode(',', $_POST['services']);

    foreach ($servicesId as $serviceId) {
      $args = [
        'reservationsId' => $id,
        'servicesId' => $serviceId
      ];
      $serviceReservation = new ServicesReservations($args);
      $serviceReservation->save();
    }

    echo json_encode(['result' => $result]);
  }

  public static function delete() {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $reservation = Reservations::find($_POST['id']);
      $reservation->delete();
      header("Location:" . $_SERVER['HTTP_REFERER']);
    }
  }
}
