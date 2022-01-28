<?php

namespace app\controllers;// пространство имен

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;

class Login
{   
  protected $model;
  protected $view;

  public function __construct() 
  {
    $this->view = new PhpRenderer('app/views/login');// шаблонизатор slim PHP-view
    $this->model = new \app\models\Login_model();
  }


  public function login_show(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface 
  {
    return $this->view->render($response, "login.template.php", $args);
  }
// обработка формы
  public function login_form(ServerRequestInterface $request, ResponseInterface $response) 
  {
    $res = $this->model->login($request->getParsedBody());// логиним и получаем данные пользователья
    // если Model вернул данные пользователья значить авторизация прошла успешно и направльяем к списку новостей
    if (array_key_exists('login', $res)) {
      $_SESSION['user'] = $res;
      return $response->withHeader('Location', '/');
    } else {// иначе вернул ошибку и показываем
      return $this->login_show($request,$response, $res);
    }
  }


  public function registration_show(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface 
  {
    return $this->view->render($response, "registration.template.php", $args);
  }

  public function registration_form(ServerRequestInterface $request, ResponseInterface $response) 
  {// логика регистрации точно такая же как у логин
    $res = $this->model->user_create($request->getParsedBody());
    
    if ($res == 'ok') {
      return $response->withHeader('Location', '/login?reg_success=true');
    } else {
      return $this->registration_show($request,$response, $res);
    }
  }


  public function logout(ServerRequestInterface $request, ResponseInterface $response) 
  {
    session_destroy();
    return $response->withHeader('Location', '/login');
  }
}