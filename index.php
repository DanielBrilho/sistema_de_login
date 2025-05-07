<?php

use App\Core\SessionManager;
require_once __DIR__ . "/App/config/autoload.php"; // Make sure to load classes automatically
require_once __DIR__ . "/App/config/loadenv.php";
require_once "Web.php";
loadEnv(".env");
SessionManager::Sessioninit();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<body style="background-color: #212726;"></body>
    
    
        <?php
        //var_dump($_COOKIE);
    // var_dump($_SESSION);
        ?>
        <a href="/App/Views/RegistarView.php">Register</a>
        <br>
        <a href="/App/Views/LoginView.php">Login</a>
        <br>
        <a href="/test.php">teste de _SESSION</a>
        <br>
        <a href="/App/Views/test2.php">test2</a>
        <br>
        <form action="/logout" method="POST">
        <button type="submit">Logout</button>
        </form>
        <!-- <form action="/feed" method="GET"> -->
        <!-- <button type="submit">teste</button> -->
        <!-- </form> -->
</body>
</html>