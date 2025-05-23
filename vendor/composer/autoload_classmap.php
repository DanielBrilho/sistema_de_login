<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(__DIR__);
$baseDir = dirname($vendorDir);

return array(
    'App\\Controllers\\ViewController' => $baseDir . '/App/Controllers/ViewController.php',
    'App\\Core\\Database' => $baseDir . '/App/Core/Database.php',
    'App\\Core\\Router' => $baseDir . '/App/Core/Router.php',
    'App\\Core\\SessionManager' => $baseDir . '/App/Core/SessionManager.php',
    'App\\Helpers\\Helpers' => $baseDir . '/App/Helpers/Helpers.php',
    'App\\Middleware\\AdminMiddleware' => $baseDir . '/App/Middleware/AdminMiddleware.php',
    'App\\Middleware\\AuthMiddleware' => $baseDir . '/App/Middleware/AuthMiddleware.php',
    'App\\Middleware\\GuestMiddleware' => $baseDir . '/App/Middleware/GuestMiddleware.php',
    'App\\Models\\UserModel' => $baseDir . '/App/Models/UserModel.php',
    'Bramus\\Router\\Router' => $vendorDir . '/bramus/router/src/Bramus/Router/Router.php',
    'Composer\\InstalledVersions' => $vendorDir . '/composer/InstalledVersions.php',
);
