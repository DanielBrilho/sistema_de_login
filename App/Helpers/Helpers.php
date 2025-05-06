<?php
namespace App\Helpers;

class Helpers {
    
    /**
     * Redireciona para a URL especificada com mensagem de erro
     * 
     * @param string $url URL base para redirecionamento
     * @param string $error Código de erro para incluir como parâmetro de URL
     * @return void
     */
    public static function redirect($url, $error = null) {
        $baseUrl = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
        $baseUrl .= $_SERVER['HTTP_HOST'] . $url;
        
        if ($error) {
            $baseUrl .= (strpos($baseUrl, '?') !== false) ? '&' : '?';
            $baseUrl .= "error={$error}";
        }
        
        header("Location: {$baseUrl}");
        exit();
    }
    
    /**
     * Retorna mensagem de erro formatada com base no código de erro
     * 
     * @param string $errorCode Código de erro
     * @return string Mensagem de erro formatada
     */
    public static function getErrorMessage($errorCode) {
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
    
    /**
     * Exibe componente de mensagem de erro caso exista na URL
     * 
     * @return string HTML formatado com a mensagem de erro
     */
    public static function displayError() {
        if (isset($_GET['error'])) {
            $errorMessage = self::getErrorMessage($_GET['error']);
            return '<div class="error-message">' . htmlspecialchars($errorMessage) . '</div>';
        }
        return '';
    }
    
    /**
     * Limpa e valida input do usuário
     * 
     * @param string $input Dados de entrada
     * @return string Dados limpos
     */
    public static function sanitizeInput($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
    
    /**
     * Valida email
     * 
     * @param string $email Email para validar
     * @return bool True se válido, False caso contrário
     */
    public static function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    /**
     * Gera URL completa para o site
     * 
     * @param string $path Caminho relativo
     * @return string URL completa
     */
    public static function url($path = '') {
        $baseUrl = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
        $baseUrl .= $_SERVER['HTTP_HOST'];
        
        // Remover a barra inicial do path se existir
        if (strlen($path) > 0 && $path[0] === '/') {
            $path = substr($path, 1);
        }
        
        return $baseUrl . '/' . $path;
    }
    
    /**
     * Verifica se o usuário está logado
     * 
     * @return bool True se logado, False caso contrário
     */
    public static function isLoggedIn() {
        return isset($_SESSION['id']);
    }
    
    /**
     * Protege página para apenas usuários logados
     * Redireciona para página de login se não estiver logado
     * 
     * @param string $loginPage Caminho para página de login
     * @return void
     */
    public static function requireLogin($loginPage = '/index.php') {
        if (!self::isLoggedIn()) {
            self::redirect($loginPage, 'acesso_negado');
        }
    }
    public static function dd($vars){
        foreach ($vars as $var) {
            var_dump($var);
        }
        die;
    }
}