<?php

namespace Controllers;

use Model\Service;
use MVC\Router;

class ServiceController
{
  public static function index(Router $router)
  {
    isAdmin();
    $services = Service::all();

    $router->render('services/index', [
      'name' => $_SESSION['name'],
      'services' => $services
    ]);
  }

  public static function create(Router $router)
  {
    isAdmin();
    $alerts = [];
    $service = new Service();

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $service->sync($_POST);
      $alerts = $service->validate();

      if(empty($alerts)) {
        $service->save();
        header("Location:/services");
      }
    }

    $router->render('services/create', [
      'name' => $_SESSION['name'],
      'service' => $service,
      'alerts' => $alerts
    ]);
  }

  public static function update(Router $router)
  {
    isAdmin();

    if(!is_numeric($_GET['id'])) {
      return;
    }

    $alerts = [];
    $service = Service::find($_GET['id']);

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $service->sync($_POST);
      $alerts = $service->validate();

      if(empty($alerts)) {
        $service->save();
        header("Location:/services");
      }
    }

    $router->render('services/update', [
      'name' => $_SESSION['name'],
      'service' => $service,
      'alerts' => $alerts
    ]);
  }

  public static function delete()
  {
    isAdmin();

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $service = Service::find($_POST['id']);
      $service->delete();
      header("Location:/services");
    }
  }
}
