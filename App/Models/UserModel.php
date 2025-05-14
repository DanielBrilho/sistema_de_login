<?php
namespace App\Models;
use  App\Core\Database;
class UserModel extends Database{
    public function checarUsuario($username, $email){
        $stmt = $this->getConnection()->prepare('SELECT username FROM utilizadores WHERE username = ? OR email =?;');

        if(!$stmt->execute([$username, $email])){
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


  public function setUsuario(
        string $username,
        string $password,
        string $email,
        bool $isAdmin = false
    ): void {
        $stmt = $this->getConnection()
                     ->prepare('INSERT INTO utilizadores (username, hashPass, email, isAdmin) VALUES (?, ?, ?, ?);');

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        if (!$stmt->execute([
            $username,
            $passwordHash,
            $email,
            (int)$isAdmin
        ])) {
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
    }

     public function getUsuario(string $username, string $password): array
    {
        $stmt = $this->getConnection()
                     ->prepare('SELECT * FROM utilizadores WHERE username = ? OR email = ?;');

        if (!$stmt->execute([$username, $username])) {
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() === 0) {
            header("location: ../index.php?error=usernotfound");
            exit();
        }

        $utilizador = $stmt->fetch();

        if (!password_verify($password, $utilizador['hashPass'])) {
            header("location: ../index.php?error=wrongpassword");
            exit();
        }

        return [
            'id'      => $utilizador['id'],
            'nome'    => $utilizador['username'],
            'isAdmin' => (bool)$utilizador['isAdmin'],
        ];
    }
}

    


