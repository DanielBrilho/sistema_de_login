<?php
namespace App\Middleware;

class GuestMiddleware
{
    
    public function handle()
    {
      session_start();
    
        // Check if the user is logged in by verifying 'id'
        if (isset($_SESSION['id']) || isset($_SESSION['name'])) {
            header("Location: /index.php");
            exit();
        }
    }
}