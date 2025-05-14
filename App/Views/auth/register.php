
<!DOCTYPE html>
<html lang="en"></html>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Login and Registration</title>
</head>

<body>
    <h1>Test Registration</h1>
    <form action="/register" method="POST">
        <label for="username">username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="passwordrepeat">Repeat Password:</label>
        <input type="password" id="passwordrepeat" name="passwordrepeat" required><br><br>

        <button type="submit" name="submit">Register</button>
    </form>
</body>