<?php

namespace app\models;

use app\core\DB;
use PDOException;

class LoginModel
{
    public function login(array $form_data): array
    {
        $user = $this->loginValidate($form_data);
        
        if (!$user) {// если пользователь не найден возвращаем ошибку
            return [
                'error' => 'Неверный логин или пароль',
                'form_data' => $form_data
            ];
        } 
        else {// если найден возвращаем данные пользователья
            return $user;
        }
    }

    protected function loginValidate(array $form_data)
    {
        $stmt = DB::run(
            "SELECT * FROM `users` WHERE `login` = ?", 
            [$form_data['login']]
        );

        if (!$stmt) {
            return false;// если пользователь с таким логином не найден возвращаем ошибку
        }

        if (password_verify($form_data['password'], $stmt['password'])) {
            return $stmt;// если пароль правильный возвращаем данные пользователья
        } 
        else {return false;}// не правильный пароль
    }


    public function userCreate(array $form_data) :bool
    {// регистрация пользователья
        $error = $this->registrationValidate($form_data);

        if ($error) {// если валидация вернул ошибку
            return [
                'error' => $error,
                'form_data' => $form_data
            ];
        } 
        else {// нету ошибок, регистрируем пользователья
            try {
                DB::run(
                    "INSERT INTO `users` (`login`,`email`,`password`) VALUES(?,?,?)", 
                    [$form_data['login'], $form_data['email'], password_hash($form_data['password'], PASSWORD_BCRYPT)]
                );
                return true;// регистрация прошла успешно 
            }
            catch(PDOException $e) {// если база данных вернул ошибку
                echo 'Не удалось зарегистрироваться';
                echo 'Error: ' . $e->getMessage();
                return false;
            }
        }
    }

    protected function registrationValidate(array $form_data) 
    {
        $stmt = DB::run("SELECT `login` FROM `users` WHERE `login` = ?", [$form_data['login']]);
        if ($stmt) {
            return 'Пользователь с таким логином уже зарегистрирован';
        }

        $stmt = DB::run("SELECT `email` FROM `users` WHERE `email` = ?", [$form_data['email']]);
        if ($stmt) {
            return 'Пользователь с таким email уже зарегистрирован';
        }

        return false;
    }
}
