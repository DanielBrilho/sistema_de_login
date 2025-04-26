<?php
#TODO: implement nsamspaces on every file
// namespace App\Controller
final class registarController extends registarModel
{
    private string $uid;
    private string $pwd;
    private string $pwdrepeat;
    private string $email;

    public function __construct(string $uid, string $pwd, string $pwdrepeat, string $email)
    {
        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdrepeat = $pwdrepeat;
        $this->email = $email;
    }
    #TODO: implement better validations proper
    // public function validate() 
    // {
    //     $validate = {
    //         'name' = required|min10|,
    //         'email' = email|rquired|min10|
    // }
    public function registarUtilizador()
    {
        if ($this->validarCamposVazios() == false) {
            header("location: ../index.php?error=campos_vazios");
            exit();
        }

        if ($this->uidInvalido() == false) {
            header("location: ../index.php?error=uid_invalido");
            exit();
        }
        if ($this->validarEmail() == false) {
            header("location: ../index.php?error=email_invalido");
            exit();
        }
        if ($this->validarPwd() == false) {
            header("location: ../index.php?error=senhas_diferentes");
            exit();
        }

        if ($this->validarUid() == false) {
            header("location: ../index.php?error=utilizador_existente");
            exit();
        }


        $this->setUsuario($this->uid, $this->pwd, $this->email);
    }



    private function validarCamposVazios()
    {
        $resultado = null;
        if (empty($this->uid) || empty($this->pwd) || empty($this->pwdrepeat) || empty($this->email)) {
            $resultado = false;
        } else {
            $resultado = true;
        }
        return $resultado;
    }

    private function uidInvalido()
    {
        $resultado = null;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->uid)) {
            $resultado = false;
        } else {
            $resultado = true;
        }
        return $resultado;
    }

    private function validarEmail()
    {
        $resultado = null;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $resultado = false;
        } else {
            $resultado = true;
        }
        return $resultado;
    }
    private function validarPwd()
    {
        $resultado = null;
        if ($this->pwd !== $this->pwdrepeat) {
            $resultado = false;
        } else {
            $resultado = true;
        }
        return $resultado;
    }

    private function validarUid()
    {
        $resultado = null;
        if (!$this->checarUsuario($this->uid, $this->email)) {
            $resultado = false;
        } else {
            $resultado = true;
        }
        return $resultado;
    }

}