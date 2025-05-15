<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Registration</title>
    <!-- point to your updated stylesheet -->
    <link rel="stylesheet" href="/public/css/Admin/AdminRegister.css" />
</head>
<body>
    <div class="main-content">
        <h1>Admin Registration</h1>
        <form action="/registerAdm" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required />
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required />
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required />
            </div>
            <div class="form-group">
                <label for="passwordrepeat">Repeat Password:</label>
                <!-- name must match the router’s $_POST key -->
                <input type="password" id="passwordrepeat" name="password_confirm" required />
            </div>
            <div class="form-group">
                <label for="isAdmin">
                    <input type="checkbox" id="isAdmin" name="isAdmin" value="1" />
                    Grant admin privileges
                </label>
            </div>
            <button type="submit" name="submit" class="btn">Register</button>
        </form>

        <a href="/dashboard" class="link-btn">Voltar</a>
    </div>
</body>
</html>
