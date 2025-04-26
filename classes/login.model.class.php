<?php
class loginModel extends Database
{
    protected function getUsuario($uid, $pwd)
    {
        $stmt = $this->getConnection()->prepare('SELECT hashPass FROM utilizadores WHERE username = ? OR email = ?');
        if (!$stmt->execute([$uid, $pwd])) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }
        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../index.php?error=usernotfound");
            exit();
        }

        $pwHashed = $stmt->fetchAll();
        $checkPwd = password_verify($pwd, $pwHashed[0]["hashPass"]);

        if ($checkPwd == false) {
            $stmt = null;
            header("location: ../index.php?error=wrongpassword");
            exit();
        } elseif ($checkPwd == true) {
            $stmt = $this->getConnection()->prepare('SELECT * FROM utilizadores WHERE username = ? OR email = ? AND hashPass = ?;');
            if (!$stmt->execute([$uid, $uid, $pwd])) {
                $stmt = null;
                header("location: ../index.php?error=stmtfailed");
                exit();
            }
            if ($stmt->rowCount() == 0) {
                $stmt = null;
                header("location: ../index.php?error=usernotfound");
                exit();
            }
            $utilizador = $stmt->fetchAll();
            session_start();
            $_SESSION["userid"] = $utilizador["id"];
           ;
            session_set_cookie_params(["userid"]);

            $stmt = null;
        }
    }


}