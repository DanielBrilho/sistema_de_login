<?php
namespace App\Models;
use  App\Core\Database;


class AdminModel extends Database{
    public function createAdminUserIfNotExists() {
    // Define the hardcoded admin credentials
    $username = 'WanzellerAdm';
    $email = 'WanzellerAdm@gmail.com';
    $password = 'W@NzElLe4!';
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Check if the admin user already exists
    $stmt = $this->getConnection()->prepare('SELECT * FROM utilizadores WHERE username = ? OR email = ? LIMIT 1');
    if (!$stmt->execute([$username, $email])) {
        $stmt = null;
        throw new \Exception("Database error while checking admin user.");
    }

    if ($stmt->rowCount() > 0) {
        // Admin already exists, do nothing
        return false;
    }

    // Insert the admin user
    $stmt = $this->getConnection()->prepare('INSERT INTO utilizadores (username, hashPass, email, isAdmin) VALUES (?, ?, ?, ?)');
    if (!$stmt->execute([$username, $passwordHash, $email, 1])) {
        $stmt = null;
        throw new \Exception("Database error while creating admin user.");
    }

    return true; // Admin was created
}

}