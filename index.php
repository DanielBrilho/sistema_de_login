<?php


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Login and Registration</title>
</head>

<body>
    <h1>Test Registration</h1>
    <form action="pages/registar.inc.php" method="POST">
        <label for="uid">Username:</label>
        <input type="text" id="uid" name="uid" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="pwd">Password:</label>
        <input type="password" id="pwd" name="pwd" required><br><br>

        <label for="pwdrepeat">Repeat Password:</label>
        <input type="password" id="pwdrepeat" name="pwdrepeat" required><br><br>

        <button type="submit" name="submit">Register</button>
    </form>

    <h1>Test Login</h1>
    <form action="pages/login.inc.php" method="POST">
        <label for="uid">Username or Email:</label>
        <input type="text" id="uid" name="uid" required><br><br>

        <label for="pwd">Password:</label>
        <input type="password" id="pwd" name="pwd" required><br><br>

        <button type="submit" name="submit">Login</button>
    </form>
</body>

<a href="test.php">test</a>

</html>