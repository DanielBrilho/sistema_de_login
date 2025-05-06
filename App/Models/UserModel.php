<?php
namespace App\Models;
use  App\Core\Database;
class UserModel extends Database{
    public function checarUsuario($uid, $email){
        $stmt = $this->getConnection()->prepare('SELECT username FROM utilizadores WHERE username = ? OR email =?;');

        if(!$stmt->execute([$uid, $email])){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $checkResultado = null;
        if($stmt->rowCount() > 0){
            $checkResultado = false;
        }
        else
        {
        $checkResultado = true;    
        }
        return $checkResultado;
    }


    public function setUsuario($uid,$pwd, $email){
        $stmt = $this->getConnection()->prepare('INSERT INTO utilizadores (username,hashPass,email) VALUES (?, ?, ?);');

        $pwdHash = password_hash($pwd, PASSWORD_DEFAULT);

        if(!$stmt->execute([$uid,$pwdHash, $email])){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    public function getUsuario($uid, $pwd)
{
    // Prepare the statement to fetch the hashed password
    $stmt = $this->getConnection()->prepare('SELECT * FROM utilizadores WHERE username = ? OR email = ?');
    if (!$stmt->execute([$uid, $uid])) {
        $stmt = null;
        header("location: ../index.php?error=stmtfailed");
        exit();
    }

    // Check if the user exists
    if ($stmt->rowCount() == 0) {
        $stmt = null;
        header("location: ../index.php?error=usernotfound");
        exit();
    }

    // Fetch user data
    $utilizador = $stmt->fetch();

    // Verify the password
    if (!password_verify($pwd, $utilizador["hashPass"])) {
        $stmt = null;
        header("location: ../index.php?error=wrongpassword");
        exit();
    }

    // Return the user data as an associative array
    return [
        'id' => $utilizador['id'],
        'nome' => $utilizador['username']
    ];
}

    
}

