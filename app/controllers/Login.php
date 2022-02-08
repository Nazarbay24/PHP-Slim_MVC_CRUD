<?php

namespace app\controllers;// пространство имен

use app\models\LoginModel;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;

class Login
{   
  protected LoginModel $model;
  protected PhpRenderer $view;

  public function __construct() 
  {
    $this->view = new PhpRenderer('app/views/login');// шаблонизатор slim PHP-view
    $this->model = new \app\models\LoginModel();
  }


  public function loginShow(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface 
  {
    return $this->view->render($response, "login.template.php", $args);
  }
// обработка формы
  public function loginForm(ServerRequestInterface $request, ResponseInterface $response) : ResponseInterface 
  {
    $res = $this->model->login($request->getParsedBody());// логиним и получаем данные пользователья
    // если Model вернул данные пользователья значить авторизация прошла успешно и направльяем к списку новостей
    if (array_key_exists('login', $res)) {
      $_SESSION['user'] = $res;
      return $response->withHeader('Location', '/');
    } else {// иначе вернул ошибку и показываем
      return $this->loginShow($request,$response, $res);
    }
  }


  public function registrationShow(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface 
  {
    return $this->view->render($response, "registration.template.php", $args);
  }

  public function registrationForm(ServerRequestInterface $request, ResponseInterface $response) : ResponseInterface 
  {
    $res = $this->model->userCreate($request->getParsedBody());
    
    if ($res == true) {
      return $response->withHeader('Location', '/login?reg_success=true');
    } else {
      return $this->registrationShow($request,$response, []);
    }
  }


  public function logout(ServerRequestInterface $request, ResponseInterface $response) : ResponseInterface 
  {
    session_destroy();
    return $response->withHeader('Location', '/login');
  }
}