<?php

namespace Sam\PhpPdo;

use PDO;
use PDOException;
use Sam\Config\Config;

final class Database {

    private string $password;
    private static $name;

    private static ?PDO $pdo = null;
    private static string $dsn = "mysql:host=%s;dbname=%s;charset=%s";

    public function __construct(string $name, string $password) {
        $this->password = $password;
        $this->name= $name;
    }

    public static function DataConnect():?PDO {
        if (self::$pdo === null) {
            try {
                $dsn = sprintf(self::$dsn,Config::BD_SERVER,Config::BD_DB,Config::BD_CHARSET);
                self::$pdo = new PDO($dsn,Config::BD_USER,Config::BD_PASSWORD);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
            }
            catch (PDOException $e) {
                die();
            }
        }
        return self::$pdo;
    }

}