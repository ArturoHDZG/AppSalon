<?php

function debug($variable) : string {
  echo "<pre>";
  var_dump($variable);
  echo "</pre>";
  exit;
}

// Escapes HTML
function s($html) : string {
  $s = htmlspecialchars($html);
  return $s;
}

// Iterate Services
function isLast(string $current, string $next) : bool {
  if ($current !== $next) {
    return true;
  }

  return false;
}

// Login checker
function isAuth() : void {
  if (!isset($_SESSION['login'])) {
    header("Location:/");
  }
}

// Admin checker
function isAdmin() : void {
  if (!isset($_SESSION['admin'])) {
    header("Location:/");
  }
}
