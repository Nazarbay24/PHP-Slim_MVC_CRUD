<?php

namespace app\core;

use \PDO;// так как мы внутри пространство имен надо подключить PDO из глобального пространсттва

define('DB_HOST', 'localhost');
define('DB_NAME', 'crud');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHAR', 'utf8');

// класс обертка над PDO
class DB
{
    protected static $instance = null;
    
    public static function instance()
    { 
        if (self::$instance === null) // проверка на отсутствие подключения к БД
        {
            $opt  = array( // опции подключения
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => TRUE,
            ); 
            $dsn = 'mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHAR;
            self::$instance = new PDO($dsn, DB_USER, DB_PASS, $opt); // Подключение
        } 
        return self::$instance;
    }

// Возможность обращаться к классу PDO если метод отсутствует в этом классе
    public static function __callStatic($method, $args)
    {
        return call_user_func_array(array(self::instance(), $method), $args);
    }
// static дает возможность пользоваться методом без экземпляра класса
    public static function run($sql, $args = [])
    {
            if (!$args)// запрос без переменных
            {
                 return self::instance()->query($sql)->fetchAll(); 
            }
        $stmt = self::instance()->prepare($sql); // подготовленный запрос с вставкой данных от пользователья защищает от SQL инъекции
        $stmt->execute($args);// $args массив данных от пользователья
        return $stmt->fetch();
    }
}
