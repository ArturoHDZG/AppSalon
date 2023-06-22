<?php

require_once __DIR__ . '/../includes/autoload.php';

use MVC\Router;
use Controllers\LoginController;

$router = new Router();

// Session
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Reset Password
$router->get('/forgot', [LoginController::class, 'forgot']);
$router->post('/forgot', [LoginController::class, 'forgot']);
$router->get('/restore', [LoginController::class, 'restore']);
$router->post('/restore', [LoginController::class, 'restore']);

// Create Account
$router->get('/signup', [LoginController::class, 'create']);
$router->post('/signup', [LoginController::class, 'create']);

// Validate URL's
$router->checkPaths();
