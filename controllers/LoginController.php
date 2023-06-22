<?php

namespace Controllers;

use MVC\Router;

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
    $router->render('auth/create', []);
  }
}
