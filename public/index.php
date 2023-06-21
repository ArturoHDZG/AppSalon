<?php

require_once __DIR__ . '/../includes/autoload.php';

use MVC\Router;

$router = new Router();

// Validate URL's
$router->checkPaths();
