<?php

use Slim\Factory\AppFactory;

require 'vendor/autoload.php';// автозагрузчик классов Composer
session_start();

$app = AppFactory::create();


$app->get('/registration', '\app\controllers\Login:registration_show');
$app->post('/registration', '\app\controllers\Login:registration_form');

$app->get('/login', '\app\controllers\Login:login_show');
$app->post('/login', '\app\controllers\Login:login_form');

$app->get('/logout', '\app\controllers\Login:logout');

// метод ->add() добавляеть промежуточное ПО, который выоплняеться между запросом и ответом
// Создал класс который проверяет авторизованность пользователья 
$app->get('/', '\app\controllers\Post:all_show')->add('app\middleware\Auth_check');
$app->get('/my', '\app\controllers\Post:my_show')->add('app\middleware\Auth_check');

$app->get('/read/{id}', '\app\controllers\Post:read_show')->add('app\middleware\Auth_check');

$app->get('/create', '\app\controllers\Post:create_show')->add('app\middleware\Auth_check');
$app->post('/create', '\app\controllers\Post:create_form')->add('app\middleware\Auth_check');

$app->get('/edit/{id}', '\app\controllers\Post:edit_show')->add('app\middleware\Auth_check');
$app->post('/edit/{id}', '\app\controllers\Post:edit_form')->add('app\middleware\Auth_check');

$app->get('/delete/{id}', '\app\controllers\Post:delete')->add('app\middleware\Auth_check');


$app->run();