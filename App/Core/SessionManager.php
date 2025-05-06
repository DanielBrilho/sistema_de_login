<?php
namespace App\Core;

class SessionManager {
    public static function Sessioninit() {
        if (session_status() === PHP_SESSION_NONE) {
            // Configurar parâmetros de segurança para os cookies de sessão
            session_set_cookie_params([
                'lifetime' => 60 * 60 * 24 * 30, // 30 dias
                'path' => '/',
                'secure' => isset($_SERVER['HTTPS']), // Somente HTTPS se disponível
                'httponly' => true, // Previne acesso via JavaScript
                'samesite' => 'Lax' // Protege contra CSRF
            ]);
            
            session_start();
            
            // Regenera o ID de sessão a cada 30 minutos para aumentar a segurança
            if (!isset($_SESSION['last_regeneration']) || 
                time() - $_SESSION['last_regeneration'] > 1800) {
                session_regenerate_id(true);
                $_SESSION['last_regeneration'] = time();
            }
        }
    }
    
    public static function set($key, $value) {
        self::Sessioninit();
        $_SESSION[$key] = $value;
    }
    
    public static function get($key, $default = null) {
        self::Sessioninit();
        return $_SESSION[$key] ?? $default;
    }
    
    public static function has($key) {
        self::Sessioninit();
        return isset($_SESSION[$key]);
    }
    
    public static function remove($key) {
        self::Sessioninit();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
            return true;
        }
        return false;
    }
    
    public static function destroy() {
        if (session_status() === PHP_SESSION_ACTIVE) {
            // Limpa todas as variáveis de sessão
            $_SESSION = [];
            
            // Apaga o cookie de sessão
            if (isset($_COOKIE[session_name()])) {
                setcookie(session_name(), '', time() - 42000, '/');
            }
            
            // Destrói a sessão
            session_destroy();
        }
    }
}