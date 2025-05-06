<!DOCTYPE html>
<html lang="en"></html>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Login and Registration</title>
</head>

<body>
<h1>Test Login</h1>
    <form action="/login" method="POST">
        <label for="uid">Username or Email:</label>
        <input type="text" id="uid" name="uid" required><br><br>

        <label for="pwd">Password:</label>
        <input type="password" id="pwd" name="pwd" required><br><br>

        <button type="submit" name="submit">Login</button>
    </form>
</body>