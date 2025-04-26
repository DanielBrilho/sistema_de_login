<?php
class registarModel extends Database{
    protected function checarUsuario($uid, $email){
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


    protected function setUsuario($uid,$pwd, $email){
        $stmt = $this->getConnection()->prepare('INSERT INTO utilizadores (username,hashPass,email) VALUES (?, ?, ?);');

        $pwdHash = password_hash($pwd, PASSWORD_DEFAULT);

        if(!$stmt->execute([$uid,$pwdHash, $email])){
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }


}