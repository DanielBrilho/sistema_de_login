<?php
namespace App\Core;
use App\Config\EnvLoader;
EnvLoader::load(__DIR__ . '/.env');
class Database
{
    private static ?\PDO $pdo = null;

    private static function connect(): \PDO
    {
        if (self::$pdo === null) {
            $host = $_ENV['DB_HOST'];
            $dbname = $_ENV['DB_NAME'];
            $port = $_ENV['DB_PORT'];
            $username = $_ENV['DB_USER'];
            $password = $_ENV['DB_PASS'];
            $charset = $_ENV['DB_CHARSET'];
            //echo "$host, $dbname , $username, $password, $charset<br>";
            $dns = "mysql:host=$host;dbname=$dbname;port=$port;charset=$charset";

            $options = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES => false
            ];

            try {
                self::$pdo = new \PDO($dns, $username, $password, $options);
            } catch (\PDOException $e) {
                die('connection failed' . $e->getMessage());
            }
        }
        return self::$pdo;
    }

    

    public static function getConnection()
    {
        return self::connect();
    }
}