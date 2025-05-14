<?php
require __DIR__ . '/vendor/autoload.php';

use App\Core\SessionManager;
use App\Config\EnvLoader;
use Bramus\Router\Router;

EnvLoader::load(__DIR__ . '/.env');
SessionManager::Sessioninit();

$router = new Router();
require __DIR__ . '/routes/web.php';

// If the URI is exactly /index.php or /
if ($_SERVER['REQUEST_URI'] === '/index.php' || $_SERVER['REQUEST_URI'] === '/') {
    header('Location: /home');
    exit();
}

$router->run();