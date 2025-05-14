<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Helpers\Helpers;
use App\Core\SessionManager;

class AuthController
{
    private string $username;
    private string $password;
    private ?string $passwordrepeat;
    private ?string $email;
    private bool $isAdmin;
    private UserModel $userModel;

    public function __construct(string $username = '', string $password = '', ?string $passwordrepeat = null, ?string $email = null, bool $isAdmin = false)
    {
        // Initialize session
        SessionManager::Sessioninit();

        $this->username = Helpers::sanitizeInput($username);
        $this->password = $password; // Do not sanitize password to preserve special characters
        $this->passwordrepeat = $passwordrepeat;
        $this->email = $email;
        $this->isAdmin = $isAdmin;
        $this->userModel = new UserModel();
    }

    // Login functionality
    public function logarUtilizador()
    {
        if (!$this->validarCamposVaziosLogin()) {
            return;
        }

        $dados = $this->userModel->getUsuario($this->username, $this->password);

        if ($dados) {
            $this->fazerLogin($dados);
            Helpers::redirect('/home');
        }
    }

    private function validarCamposVaziosLogin(): bool
    {
        return !empty($this->username) && !empty($this->password);

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
        setcookie("isAdmin", $dados['isAdmin'], time() + $thirty_days, "/", "", isset($_SERVER['HTTPS']), true);
     
    }

    public function logout()
    {
        // Destroy session completely
        SessionManager::destroy();

        // Clear system cookies
        setcookie('id', '', time() - 3600, "/");
        setcookie('nome', '', time() - 3600, "/");
        setcookie('nome', '', time() - 3600, "/");
    }

    // Registration functionality
    public function registarUtilizador()
    {
        $validations = [
            'campos_vazios' => !$this->validarCamposVaziosRegistro(),
            'username_invalido' => !$this->usernameInvalido(),
            'email_invalido' => !$this->validarEmail(),
            'senhas_diferentes' => !$this->validarpassword(),
            'utilizador_existente' => !$this->validarusername()
        ];

        foreach ($validations as $errorKey => $isValid) {
            if ($isValid) {
                // Store error in session to show in the view
                SessionManager::set('error', $errorKey);
            }
        }

        // Register the user (but don't log in)
         $this->userModel->setUsuario(
            $this->username,
            $this->password,
            $this->email,
            $this->isAdmin
        );
        // Optional: store a success message
        // SessionManager::set('message', 'Usuário registrado com sucesso.');

        return true;
    }


    private function validarCamposVaziosRegistro(): bool
    {
        return !empty($this->username) && !empty($this->password) && !empty($this->passwordrepeat) && !empty($this->email);
    }

    private function usernameInvalido(): bool
    {
        return preg_match("/^[a-zA-Z0-9]+$/", $this->username);
    }

    private function validarEmail(): bool
    {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false;
    }

    private function validarpassword(): bool
    {
        return $this->password === $this->passwordrepeat;
    }

    private function validarusername(): bool
    {
        return $this->userModel->checarUsuario($this->username, $this->email);
    }
}