<?php

namespace Model;

class User extends ActiveRecord
{
  // DB Attributes
  protected static $table = 'users';
  protected static $columnsDB = [
    'id',
    'name',
    'lastName',
    'email',
    'password',
    'phone',
    'admin',
    'confirm',
    'token'
  ];

  // ColumnsDB Empty Attributes
  public $id;
  public $name;
  public $lastName;
  public $email;
  public $password;
  public $phone;
  public $admin;
  public $confirm;
  public $token;

  // Constructor
  public function __construct($args = [])
  {
    $this->id = $args['id'] ?? null;
    $this->name = $args['name'] ?? '';
    $this->lastName = $args['lastName'] ?? '';
    $this->email = $args['email'] ?? '';
    $this->password = $args['password'] ?? '';
    $this->phone = $args['phone'] ?? '';
    $this->admin = $args['admin'] ?? null;
    $this->confirm = $args['confirm'] ?? null;
    $this->token = $args['token'] ?? '';
  }

  // Sign Up Validation Messages
  public function validateSignUp()
  {
    if (!$this->name) {
      self::$alerts['error'][] = 'Please enter a Name';
    }

    if (!$this->lastName) {
      self::$alerts['error'][] = 'Please enter a Last Name';
    }

    if (!$this->phone) {
      self::$alerts['error'][] = 'Please enter a Phone Number';
    }

    if (!$this->email) {
      self::$alerts['error'][] = 'Please enter a Email';
    }

    if (!$this->password) {
      self::$alerts['error'][] = 'Please enter a Password';
    } elseif (strlen($this->password) < 6) {
      self::$alerts['error'][] = 'The Password must contain at least 6 characters';
    }

    return self::$alerts;
  }
}
