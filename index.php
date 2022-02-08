<?php

use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;

require 'vendor/autoload.php';// автозагрузчик классов Composer

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

session_start();

$app = AppFactory::create();


$app->group('/registration', function (RouteCollectorProxy $group) 
{
    $group->get('', '\app\controllers\Login:registrationShow');
    $group->post('', '\app\controllers\Login:registrationForm');
});

$app->group('/login', function (RouteCollectorProxy $group) 
{
    $group->get('', '\app\controllers\Login:loginShow');
    $group->post('', '\app\controllers\Login:loginForm');
});

$app->get('/logout', '\app\controllers\Login:logout');


$app->group('', function (RouteCollectorProxy $group) 
{
    $group->get('/', '\app\controllers\Post:allShow');
    $group->get('/my', '\app\controllers\Post:myShow');

    $group->get('/read/{id:[0-9]+}', '\app\controllers\Post:readShow');

    $group->group('/create', function (RouteCollectorProxy $group) 
    {
        $group->get('', '\app\controllers\Post:createShow');
        $group->post('', '\app\controllers\Post:createForm');
    });

    $group->group('/edit/{id:[0-9]+}', function (RouteCollectorProxy $group) 
    {
        $group->get('', '\app\controllers\Post:editShow');
        $group->post('', '\app\controllers\Post:editForm');
    });

    $group->get('/delete/{id:[0-9]+}', '\app\controllers\Post:delete');

})->add('app\middleware\AuthCheck');
// метод ->add() добавляеть промежуточное ПО, который выоплняеться между запросом и ответом
// Создал класс который проверяет авторизованность пользователья 

$app->run();