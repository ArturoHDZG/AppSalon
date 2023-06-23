<?php

namespace Controllers;

use MVC\Router;
use Model\User;

class LoginController
{
  // Session Management
  public static function login(Router $router)
  {
    $router->render('auth/login', []);
  }

  public static function logout()
  {
    echo 'Logout Page';
  }

  // Password Management
  public static function forgot(Router $router)
  {
    $router->render('auth/forgot', []);
  }

  public static function restore()
  {
    echo 'Restore Page';
  }

  // Account Management
  public static function create(Router $router)
  {
    // Instances
    $user = new User;

    // Set Empty Alerts Array
    $alerts = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Get User Input Data
      $user->sync($_POST);

      // Set Alerts Array
      $alerts = $user->validateSignUp();

      // Check if alert messages are empty
      if (empty($alerts)) {
        echo 'Validation Success';
      }
    }

    $router->render('auth/create', [
      'alerts' => $alerts,
      'user' => $user
    ]);
  }
}
