<?php
require_once __DIR__ . '/App/Middleware/AuthMiddleware.php';
require_once __DIR__ . '/App/Middleware/AdminMiddleware.php';
require_once __DIR__ . '/App/config/autoload.php';

use App\Core\Router;
use App\Middleware\GuestMiddleware;



 $router = new Router();
 

// return function (Router $router) {
 
  
    
    // Public POST routes
    $router->addPost('/register', 'AuthController@registarUtilizador');
    $router->addPost('/login', 'AuthController@logarUtilizador');
    $router->addPost('/logout', 'AuthController@logout');
   
    // $router->addGet('/feed', 'ViewController@index', ['AuthMiddleware@handle']);
   

$router->dispatch();