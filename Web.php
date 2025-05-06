<?php
require_once __DIR__ . '/App/Core/Router.php';
require_once __DIR__ . '/App/Middleware/AuthMiddleware.php';
require_once __DIR__ . '/App/Middleware/AdminMiddleware.php';
require_once __DIR__ . '/App/config/autoload.php';

use App\Core\Router;
use App\Middleware\AuthMiddleware;
use App\Middleware\AdminAuthMiddleware;
// require_once __DIR__ . "/App/Core/Router.php";
// Instantiate the router (if not passed in externally)
 $router = new Router();
 

// return function (Router $router) {
    // Public GET routes
  
    
    // Public POST routes
    $router->addPost('/register', 'AuthController@registarUtilizador');
    $router->addPost('/login', 'AuthController@logarUtilizador');
    $router->addPost('/logout', 'AuthController@logout');
    // Protected routes (middleware applied)
            // $router->addGet('/admin', 'AdminController@dashboard', [AuthMiddleware::class, AdminAuthMiddleware::class]);

    // Dynamic route example
        //$router->addGet('/user/{id}', 'UserController@profile', [AuthMiddleware::class]);
// };

$router->dispatch();