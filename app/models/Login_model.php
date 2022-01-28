<?php

namespace app\models;

use app\core\DB;
use PDOException;

class Login_model
{
    public function login($form_data) 
    {
        $user = $this->login_validate($form_data);
        
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

    protected function login_validate($form_data) 
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


    public function user_create($form_data) 
    {// регистрация пользователья
        $error = $this->registration_validate($form_data);

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
                return 'ok';// регистрация прошла успешно 
            }
            catch(PDOException $e) {// если база данных вернул ошибку
                echo 'Не удалось зарегистрироваться';
                echo 'Error: ' . $e->getMessage();
                return false;
            }
        }
    }

    protected function registration_validate($form_data) 
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
