<?php 
use App\Core\SessionManager;
SessionManager::Sessioninit();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body style="background-color: #212726;">

    <a href="/register">Register</a><br>
    <a href="/login">Login</a><br>
    <a href="/test">Test Session</a><br>
    <a href="/tester">test Middleware</a><br>
    <a href="/dashboard">admin</a>
    <form action="/logout" method="POST">
        <button type="submit">Logout</button>
    </form>

</body>
</html>
