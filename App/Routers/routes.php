<?php
use App\Routers\Router as Router;
use App\Middlewares\AuthMiddleware;

// use Controllers
use App\Controllers\AuthController;
use App\Controllers\UsersController;
use App\Controllers\GalleryController;
use App\Controllers\PostsController;
use App\Controllers\CommentsController;

// ایجاد یک نمونه از میدلور
$authMiddleware = new AuthMiddleware();
$request = getTokenFromRequest();
$response = $authMiddleware->handle($request);

$router = new Router();

// Define routes
$router->post('v1','/login', AuthController::class, 'login');
$router->post('v1','/register', AuthController::class, 'register');

// Users

$router->get('v1','/users', UsersController::class, 'index', 'admin');
$router->get('v1','/users/{id}', UsersController::class, 'get', 'admin');
$router->post('v1','/users', UsersController::class, 'store', 'admin');
$router->put('v1','/users/{id}', UsersController::class, 'update', 'admin');
$router->delete('v1','/users/{id}', UsersController::class, 'destroy', 'admin');
// make admin
$router->put('v1','/users/makeadmin/{id}', UsersController::class, 'makeadmin', 'admin');

// Gallery


$router->get('v1','/gallery', GalleryController::class, 'index', 'admin');
$router->get('v1','/gallery/{id}', GalleryController::class, 'get', 'admin');
$router->post('v1','/gallery', GalleryController::class, 'store', 'admin');
$router->put('v1','/gallery/{id}', GalleryController::class, 'update', 'admin');
$router->delete('v1','/gallery/{id}', GalleryController::class, 'destroy', 'admin');

// Posts

$router->get('v1','/posts', PostsController::class, 'index', 'admin');
$router->get('v1','/posts/{id}', PostsController::class, 'get', 'admin');
$router->post('v1','/posts', PostsController::class, 'store', 'admin');
$router->put('v1','/posts/{id}', PostsController::class, 'update', 'admin');
$router->delete('v1','/posts/{id}', PostsController::class, 'destroy', 'admin');

// Comments

$router->get('v1','/comments', CommentsController::class, 'index', 'admin');
$router->get('v1','/comments/{id}', CommentsController::class, 'get', 'admin');
$router->post('v1','/comments', CommentsController::class, 'store', 'admin');
$router->put('v1','/comments/{id}', CommentsController::class, 'update', 'admin');
$router->delete('v1','/comments/{id}', CommentsController::class, 'destroy', 'admin');