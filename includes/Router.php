<?php

namespace MVC;

class Router
{
  public array $getPaths = [];
  public array $postPaths = [];

  public function get($url, $fn)
  {
    $this->getPaths[$url] = $fn;
  }

  public function post($url, $fn)
  {
    $this->postPaths[$url] = $fn;
  }

  // Paths Management
  public function checkPaths()
  {
    session_start();

    $currentUrl = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
    $method = $_SERVER['REQUEST_METHOD'];

    if ($method === 'GET') {
      $fn = $this->getPaths[$currentUrl] ?? null;
    } else {
      $fn = $this->postPaths[$currentUrl] ?? null;
    }

    // Call Path Function
    if ( $fn ) {
      call_user_func($fn, $this); // This es para pasar argumentos
    } else {
      echo "Page Not Found";
    }
  }

  // Build Views
  public function render($view, $data = [])
  {
    foreach ($data as $key => $value) {
      $$key = $value;
    }

    ob_start();

    include_once __DIR__ . "/../views/$view.php";
    $content = ob_get_clean();
    include_once __DIR__ . '/../views/layout.php';
  }
}
