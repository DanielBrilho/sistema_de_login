<?php
namespace App\Helpers;
use InvalidArgumentException; 
class Helpers
{
    // Redirects to a given URL with an optional error parameter
    public static function redirect($url, $error = null)
    {
        if (strpos($url, '/') !== 0) {
            $url = '/' . $url;
        }

        $baseUrl = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
        $baseUrl .= $_SERVER['HTTP_HOST'];

        $fullUrl = $baseUrl . $url;

        if ($error) {
            $fullUrl .= (strpos($fullUrl, '?') !== false) ? '&' : '?';
            $fullUrl .= "error={$error}";
        }

        header("Location: {$fullUrl}");
        exit();
    }

    // Returns an error message based on the error code
    public static function getErrorMessage($errorCode)
    {
        $errorMessages = [
            'campos_vazios' => 'Preencha todos os campos!',
            'login_invalido' => 'Usuário ou senha inválidos!',
            'usernotfound' => 'Usuário não encontrado!',
            'wrongpassword' => 'Senha incorreta!',
            'stmtfailed' => 'Ocorreu um erro na consulta ao banco de dados!',
            'email_existe' => 'Este email já está em uso!',
            'usuario_existe' => 'Este nome de usuário já está em uso!'
        ];

        return $errorMessages[$errorCode] ?? 'Ocorreu um erro. Tente novamente.';
    }

    // Displays an error message if the 'error' parameter exists in the URL
    public static function displayError()
    {
        if (isset($_GET['error'])) {
            $errorMessage = self::getErrorMessage($_GET['error']);
            return '<div class="error-message">' . htmlspecialchars($errorMessage) . '</div>';
        }
        return '';
    }

    // Sanitizes user input to prevent XSS and other attacks
    public static function sanitizeInput($input)
{
    $input = trim($input);
    $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    return $input;
}


    // Validates if the given string is a valid email address
    public static function validateEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    // Generates a full URL based on the given path
    public static function url($path = '')
    {
        $baseUrl = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
        $baseUrl .= $_SERVER['HTTP_HOST'];

        if (strlen($path) > 0 && $path[0] === '/') {
            $path = substr($path, 1);
        }

        return $baseUrl . '/' . $path;
    }

    // Checks if a user is logged in by verifying the session
    public static function isLoggedIn()
    {
        return isset($_SESSION['id']);
    }

    // Redirects to the login page if the user is not logged in
    public static function requireLogin($loginPage = '/index.php')
    {
        if (!self::isLoggedIn()) {
            self::redirect($loginPage, 'acesso_negado');
        }
    }

    // Dumps variables and stops script execution
    public static function dd($vars)
    {
        foreach ($vars as $var) {
            var_dump($var);
        }
        die;
    }

    public static function TagSanitizer(array $tags){
             $clean = [];

        // trim & filter out any empty entries
        foreach ($tags as $tag) {
            $tag = trim((string)$tag);
            if ($tag === '') {
                continue;
            }

            // validate: only letters, numbers, underscores, hyphens
            if (!preg_match('/^[A-Za-z0-9_-]+$/', $tag)) {
                throw new InvalidArgumentException(
                    sprintf('Invalid tag "%s": only letters, numbers, underscores and hyphens are allowed.', $tag)
                );
            }

            $clean[] = $tag;
        }

        // re-index and join with commas
        return implode(',', array_values($clean));
    }
    }

