<?php

namespace Controllers;

class LoginController
{
  // Session Management
  public static function login()
  {
    echo 'Login Page';
  }

  public static function logout()
  {
    echo 'Logout Page';
  }

  // Password Management
  public static function forget()
  {
    echo 'Forget Page';
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
