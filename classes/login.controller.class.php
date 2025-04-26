<?php
class loginController extends loginModel
{
    private string $uid;
    private string $pwd;



    public function __construct(string $uid, string $pwd)
    {
        $this->uid = $uid;
        $this->pwd = $pwd;
    }

    public function logarUtilizador()
    {
        if ($this->validarCamposVazios() == false) {
            header("location: ../index.php?error=campos_vazios");
            exit();
        }

        $this->getUsuario($this->uid, $this->pwd);
    }



    private function validarCamposVazios()
    {
        $resultado = null;
        if (empty($this->uid) || empty($this->pwd)) {
            $resultado = false;
        } else {
            $resultado = true;
        }
        return $resultado;
    }

}