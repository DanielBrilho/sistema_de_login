<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Helpers\Helpers;
use App\Core\SessionManager;

class AuthController
{
    private string $uid;
    private string $pwd;
    private ?string $pwdrepeat;
    private ?string $email;
    private UserModel $userModel;

    public function __construct(string $uid = '', string $pwd = '', ?string $pwdrepeat = null, ?string $email = null)
    {
        // Initialize session
        SessionManager::Sessioninit();

        $this->uid = Helpers::sanitizeInput($uid);
        $this->pwd = $pwd; // Do not sanitize password to preserve special characters
        $this->pwdrepeat = $pwdrepeat;
        $this->email = $email;
        $this->userModel = new UserModel();
    }

    // Login functionality
    public function logarUtilizador()
    {
        if (!$this->validarCamposVaziosLogin()) {
            return;
        }

        $dados = $this->userModel->getUsuario($this->uid, $this->pwd);

        if ($dados) {
            $this->fazerLogin($dados);
        }
    }

    private function validarCamposVaziosLogin(): bool
    {
        return !empty($this->uid) && !empty($this->pwd);
    }

    private function fazerLogin(array $dados)
    {
        // Set session variables
        SessionManager::set('id', $dados['id']);
        SessionManager::set('nome', $dados['nome']);

        // Regenerate session ID to prevent session fixation
        session_regenerate_id(true);

        // Set cookies for 30 days
        $thirty_days = 60 * 60 * 24 * 30;
        setcookie("id", $dados['id'], time() + $thirty_days, "/", "", isset($_SERVER['HTTPS']), true);
        setcookie("nome", $dados['nome'], time() + $thirty_days, "/", "", isset($_SERVER['HTTPS']), true);

        // Redirect to the home page
        Helpers::redirect('/sistema_de_login/index.php');
    }

    public function logout()
    {
        // Destroy session completely
        SessionManager::destroy();

        // Clear system cookies
        setcookie('id', '', time() - 3600, "/");
        setcookie('nome', '', time() - 3600, "/");
    }

    // Registration functionality
    public function registarUtilizador()
    {
        $validations = [
            'campos_vazios' => !$this->validarCamposVaziosRegistro(),
            'uid_invalido' => !$this->uidInvalido(),
            'email_invalido' => !$this->validarEmail(),
            'senhas_diferentes' => !$this->validarPwd(),
            'utilizador_existente' => !$this->validarUid()
        ];

        foreach ($validations as $errorKey => $isValid) {
            if ($isValid) {
                header("location: ../index.php?error=$errorKey");
                exit();
            }
        }

        $this->userModel->setUsuario($this->uid, $this->pwd, $this->email);
    }

    private function validarCamposVaziosRegistro(): bool
    {
        return !empty($this->uid) && !empty($this->pwd) && !empty($this->pwdrepeat) && !empty($this->email);
    }

    private function uidInvalido(): bool
    {
        return preg_match("/^[a-zA-Z0-9]+$/", $this->uid);
    }

    private function validarEmail(): bool
    {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false;
    }

    private function validarPwd(): bool
    {
        return $this->pwd === $this->pwdrepeat;
    }

    private function validarUid(): bool
    {
        return $this->userModel->checarUsuario($this->uid, $this->email);
    }
}