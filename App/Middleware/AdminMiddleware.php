<?php
namespace App\Middleware;

class AdminMiddleware
{
    public function handle()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Check if the user is logged in by verifying 'id'
        if (!isset($_SESSION['id'])) {
            header("Location: /index.php");
            exit();
        }

        // Check if the user has the 'admin' role
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: /index.php");
            exit();
        }
    }
}