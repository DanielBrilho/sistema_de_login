<?php
require_once __DIR__ . '/../config/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello</title>
    <br>
    <h1>test Page</h1>
    <br>
    <?php if (!empty($_SESSION)): ?>
        <p>Welcome, <?= htmlspecialchars($_SESSION['nome'] ?? 'Guest') ?>!</p>
    <br>
        <?php else: ?>
        <p>You are not logged in.</p>
    <?php endif; ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f8ff;
        }

        h1 {
            color: #ff69b4;
        }
    </style>
</head>

<body>
    <h1>Hello, have a wonderful day! 😊</h1>
</body>

</html>