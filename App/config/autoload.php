<?php

use App\Core\SessionManager;
spl_autoload_register(function ($class) {
    // Only autoload classes in the App\ namespace
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/../'; // Base path to the App folder

    // Does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    // Get the relative class name
    $relativeClass = substr($class, $len);

    // Replace namespace separators with directory separators
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    // Load the file if it exists
    if (file_exists($file)) {
        require_once $file;
    }
});

SessionManager::Sessioninit();