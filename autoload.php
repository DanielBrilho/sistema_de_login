<?php

spl_autoload_register(function (string $class) {
    $directories = [
        'classes/' => '.class.php'
    ];

    foreach ($directories as $dir => $extension) {
        $file = __DIR__ . '/' . $dir . strtolower($class) . $extension;
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});