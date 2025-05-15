<?php

use Bramus\Router\Router;
use App\Controllers\AuthController;
use App\Controllers\AdminController;
use App\Middleware\AuthMiddleware;

// Instantiate router
$router = new Router();

// === Index Redirect ===
// Redirect '/' or '/index.php' to '/home'
$router->get('/', function () {
    header('Location: /home');
    exit();
});
$router->get('/index.php', function () {
    header('Location: /home');
    exit();
});

// === Public Pages ===
$router->get('/home', function () {
    // Render the home view
    require __DIR__ . '/../App/Views/public/home.php';
    exit();
});


// Render register form
$router->get('/register', function () {
    require __DIR__ . '/../App/Views/auth/register.php';
    exit();
});
// Render admin register
$router->get('/registerAdm', function () {
    require __DIR__ . '/../App/Views/admin/RegisterAdmin.php';
    exit();
});
// Render admin Dashboard
$router->get('/dashboard', function(){
    require __DIR__ . '/../App/Views/admin/Dashboard.php';
    exit;
});

// Render login form
$router->get('/login', function () {
    require __DIR__ . '/../App/Views/auth/login.php';
    exit();
});

// === Auth Actions ===
$router->post('/register', function () {
    $controller = new AuthController(
        $_POST['username'] ?? '',
        $_POST['password'] ?? '',
        $_POST['password_confirm'] ?? null,
        $_POST['email'] ?? null
    );
    $controller->registarUtilizador();
    header('Location: /home');
    exit();
});

$router->post('/registerAdm', function () {
    $controller = new AuthController(
        $_POST['username'] ?? '',
        $_POST['password'] ?? '',
        $_POST['password_confirm'] ?? null,
        $_POST['email'] ?? null,
        isset($_POST['isAdmin']) // true if checked
    );
    $controller->registarUtilizador();
    header('Location: /dashboard');
    exit();
});

$router->post('/login', function () {
    $controller = new AuthController(
        $_POST['username'] ?? '',
        $_POST['password'] ?? ''
    );
    $controller->logarUtilizador();
    // AuthController redirects on success
    exit();
});

$router->post('/logout', function () {
    $controller = new AuthController();
    $controller->logout();
    header('Location: /home');
    exit();
});

$router->post('/deleteUserById', function() {
    if (!isset($_POST['id'])) {
        // Redirect to the PUBLIC dashboard route with an error
        header('Location: /dashboard?error=missing_id');
        exit();
    }

    // Hand off to your controller
    $controller = new AdminController((int) $_POST['id']);
    $controller->deleteUser();
    // deleteUser() already does its own redirect
});

// === Protected Pages ===
$router->get('/tester', function () {
    (new AuthMiddleware())->handle();
    require __DIR__ . '/../App/Views/public/tester.php';
    exit();
});


// === Test Routes ===
$router->get('/test', function () {
    require __DIR__ . '/../App/Views/public/test.php';
    exit();
});

$router->get('blog',function(){
    require __DIR__ . '/../App/Views/admin/BlogFrom.php';
    exit;
});

// Run the router
$router->run();