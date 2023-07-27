<?php

require_once __DIR__ . '/../includes/autoload.php';

use MVC\Router;
use Controllers\APIController;
use Controllers\AdminController;
use Controllers\LoginController;
use Controllers\ServiceController;
use Controllers\ReservationsController;

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

// Validate Account
$router->get('/validate', [LoginController::class, 'validate']);
$router->get('/message', [LoginController::class, 'message']);

// Reservations
$router->get('/reservations', [ReservationsController::class, 'index']);

// Admin
$router->get('/admin', [AdminController::class, 'index']);

// Reservations API
$router->get('/api/services', [APIController::class, 'index']);
$router->post('/api/reservations', [APIController::class, 'save']);
$router->post('/api/delete', [APIController::class, 'delete']);

// Services CRUD
$router->get('/services', [ServiceController::class, 'index']);
$router->get('/services/create', [ServiceController::class, 'create']);
$router->get('/services/update', [ServiceController::class, 'update']);
$router->post('/services/create', [ServiceController::class, 'create']);
$router->post('/services/update', [ServiceController::class, 'update']);
$router->post('/services/delete', [ServiceController::class, 'delete']);

// Validate URL's
$router->checkPaths();
