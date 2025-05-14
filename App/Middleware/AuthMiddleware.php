<?php
namespace App\Middleware;

class AuthMiddleware
{
    public static function handle()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Check if the user is logged in by verifying 'id'
        if (!isset($_SESSION['id'])) {
            header("Location: /index.php");
            exit();
        }
    }
}