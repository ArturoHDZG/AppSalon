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
    $alerts = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $auth = new User($_POST);

      $alerts = $auth->loginValidate();

      if (empty($alerts)) {
        $user = User::where('email', $auth->email);

        if ($user) {
          if ($user->confirmedAndPassword($auth->password)) {
            session_start();

            $_SESSION['id'] = $user->id;
            $_SESSION['name'] = $user->name . ' ' . $user->lastName;
            $_SESSION['email'] = $user->email;
            $_SESSION['login'] = true;

            //Validate 'Admin' user
            if ($user->admin === '1'){
              $_SESSION['admin'] = $user->admin ?? '';
              header("Location:/admin");
            } else {
              header("Location:/reservations");
            }
          }
        } else {
          User::setAlert('error', 'User not found');
        }
      }
    }

    $alerts = User::getAlerts();

    $router->render('auth/login', [
      'alerts' => $alerts
    ]);
  }

  public static function logout()
  {
    $_SESSION = [];
    header("Location:/");
  }

  // Password Management
  public static function forgot(Router $router)
  {
    $alerts = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $auth = new User($_POST);
      $alerts = $auth->validateEmail();

      if (empty($alerts)) {
        $user = User::where('email', $auth->email);

        if ($user && $user->confirm === '1') {
          $user->tokenGeneration();
          $user->save();

          // Send Email
          $email = new Email($user->email, $user->name, $user->token);
          $email->sendInstructions();

          // Success Message
          User::setAlert('success', 'We sent you an email with the following instructions to restore your account');
        } else {
          User::setAlert('error', 'User not found or not confirmed');
        }
      }
    }

    $alerts = User::getAlerts();

    $router->render('auth/forgot', [
      'alerts' => $alerts
    ]);
  }

  public static function restore(Router $router)
  {
    $alerts = [];
    $error = false;

    // Search for token's account
    $token = s($_GET['token']);
    $user = User::where('token', $token);

    if (empty($user)) {
      User::setAlert('error', 'Invalid token');
      $error = true;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $password = new User($_POST);
      $alerts = $password->validatePassword();

      if (empty($alerts)) {
        $user->password = '';
        $user->password = $password->password;
        $user->protectPassword();
        $user->token = '';
        $result = $user->save();

        if ($result) {
          header("Location:/");
        }
      }
    }

    $alerts = User::getAlerts();

    $router->render('auth/restore', [
      'error' => $error,
      'alerts' => $alerts
    ]);
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
