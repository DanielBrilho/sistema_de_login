<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/auth/AuthLogin.css" />
    <title>Test Login and Registration</title>
</head>

<body>
    <h1>Test Login</h1>
    <form action="/login" method="POST">
        <label for="username">username or Email:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit" name="submit">Login</button>
    </form>
</body>

</html>