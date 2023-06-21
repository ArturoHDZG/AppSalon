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
$router->get('/forget', [LoginController::class, 'forget']);
$router->post('/forget', [LoginController::class, 'forget']);
$router->get('/restore', [LoginController::class, 'restore']);
$router->post('/restore', [LoginController::class, 'restore']);

// Create Account
$router->get('/create-account', [LoginController::class, 'create']);
$router->post('/create-account', [LoginController::class, 'create']);

// Validate URL's
$router->checkPaths();
