<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Home</title>
    <link rel="stylesheet" href="/public/css/Public/PublicHome.css" />
</head>
<body>

<div class="container">
    <h1>Welcome</h1>
    <nav class="nav-links">
        <a href="/register">Register</a>
        <a href="/login">Login</a>
        <a href="/test">Test Session</a>
        <a href="/tester">Test Middleware</a>
        <a href="/dashboard">Admin Panel</a>
        <a href="/blog">Blog Form</a>
    </nav>

    <form action="/logout" method="POST" class="logout-form">
        <button type="submit">Logout</button>
    </form>
</div>

</body>
</html>
