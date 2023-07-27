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
    $this->admin = $args['admin'] ?? '0';
    $this->confirm = $args['confirm'] ?? '0';
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

  // Login Validation
  public function loginValidate()
  {
    if (!$this->email) {
      self::$alerts['error'][] = 'Please enter a Email';
    }

    if (!$this->password) {
      self::$alerts['error'][] = 'Please enter a Password';
    }

    return self::$alerts;
  }

  // Email Validation for "Forgot Password" Path
  public function validateEmail()
  {
    if (!$this->email) {
      self::$alerts['error'][] = 'Please enter a Email';
    }

    return self::$alerts;
  }

  public function validatePassword()
  {
    if (!$this->password) {
      self::$alerts['error'][] = 'Please enter a Password';
    } elseif (strlen($this->password) < 6) {
      self::$alerts['error'][] = 'The Password must contain at least 6 characters';
    }

    return self::$alerts;
  }

  // Check if Sign Up Email Already Exists in DB
  public function userExists()
  {
    $query = "SELECT * FROM " . self::$table . " WHERE email = '" . $this->email . "' LIMIT 1";

    $result = self::$db->query($query);

    if ($result->num_rows) {
      self::$alerts['error'][] = 'An Account Already Exists with this Email';
    }

    return $result;
  }

  // Protect Password
  public function protectPassword()
  {
    $this->password = password_hash($this->password, PASSWORD_BCRYPT);
  }

  // Token Generation
  public function tokenGeneration()
  {
    $this->token = uniqid();
  }

  // Log In Password and Confirmed Validation
  public function confirmedAndPassword($password)
  {
    $result = password_verify($password, $this->password);

    if (!$result || !$this->confirm) {
      self::$alerts['error'][] = 'Invalid password or unconfirmed account';
    } else {
      return true;
    }
  }
}
