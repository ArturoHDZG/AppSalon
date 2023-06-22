<?php

namespace Controllers;

use MVC\Router;

class LoginController
{
  // Session Management
  public static function login(Router $router,)
  {
    $router->render('auth/login');
  }

  public static function logout()
  {
    echo 'Logout Page';
  }

  // Password Management
  public static function forgot()
  {
    echo 'Forgot Page';
  }

  public static function restore()
  {
    echo 'Restore Page';
  }

  // Account Management
  public static function create()
  {
    echo 'Create Account Page';
  }
}
