<?php

namespace Controllers;

use MVC\Router;
use Model\User;
use Classes\Email;

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
        $result = $user->userExists();

        // Check if User exists
        if ($result->num_rows) {
          $alerts = User::getAlerts();
        } else {
          $user->protectPassword();
          $user->tokenGeneration();
          $email = new Email($user->email, $user->name, $user->token);
          $email-> sendEmail();
          $result = $user->save();

          if ($result) {
            header("Location:/message");
          }
        }
      }
    }

    $router->render('auth/create', [
      'alerts' => $alerts,
      'user' => $user
    ]);
  }

  // Account Validation
  public static function validate(Router $router)
  {
    $alerts = [];
    $token = s($_GET['token']);
    $user = User::where('token', $token);

    if (empty($user)) {
      User::setAlert('error', 'Invalid token or already validated account');
    } else {
      $user->confirm = '1';
      $user->token = '';
      $user->save();
      User::setAlert('success', 'Account successfully confirmed');
    }

    $alerts = User::getAlerts();

    $router->render('auth/validate', [
      'alerts' => $alerts
    ]);
  }

  // Instructions View
  public static function message(Router $router)
  {
    $router->render('auth/message');
  }
}
