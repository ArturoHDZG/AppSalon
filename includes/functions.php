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
