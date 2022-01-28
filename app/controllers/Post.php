<?php

namespace app\controllers;


use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\PhpRenderer;


class Post
{
  protected $model;
  protected $view;

  public function __construct() 
  {
    $this->view = new PhpRenderer('app/views/');
    $this->model = new \app\models\Post_model();
  }

// все новости
  public function all_show(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface 
  {
    $res = $this->pagination('all');// получаем посты текущей страницы и общее количество страцниц, 
    return $this->view->render($response, "posts_list/posts_list.template.php", ['posts' => $res['posts'], 'filter' => 'all', 'total_pages'=>$res['total_pages'], 'current_page'=>$res['current_page']]);
  }
// мои новости
  public function my_show(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface 
  {
    $res = $this->pagination('my');
    return $this->view->render($response, "posts_list/posts_list.template.php", ['posts' => $res['posts'], 'filter' => 'my', 'total_pages'=>$res['total_pages'], 'current_page'=>$res['current_page']]);
  }


  protected function pagination($filter) 
  {
    $page = 1;// если страница не указана, по умолчанию 1
        
    if (isset($_GET['page'])) {// Поверка, есть ли GET запрос
      $page = $_GET['page'];// Если да то переменной $page присваиваем его
    }
    
    $size_page = 5;// Назначаем количество данных на одной странице
    $offset = ($page-1) * $size_page;// Вычисляем с какого объекта начать выводить
    $all_posts_count = $this->model->get_posts_count($filter);//количество всех постов
    $total_pages = ceil($all_posts_count / $size_page);// вычисляем количество страниц
    $posts = $this->model->get_page_posts($offset, $size_page, $filter);// получаем посты одной страницы
    
    return ['posts'=>$posts, 'total_pages'=>$total_pages, 'current_page'=>$page];
  }


  public function create_show(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface 
  {// отображение страницы создания поста
    return $this->view->render($response, "post_create/post_create.template.php", $args);
  }
  public function create_form(ServerRequestInterface $request, ResponseInterface $response) 
  {// создание поста
    $img = $request->getUploadedFiles()['img'];// получем загруженное изображение
    $insert_id = $this->model->create($request->getParsedBody(), $img);

    if ($insert_id) {// если пост успешно создано получим id поста, если нет получим false
      return $response->withHeader('Location', '/read/'.$insert_id);// направляем на страницу чтение созданного поста
    }
  }


  public function read_show(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface 
  {// страница чтение поста
    $res = $this->model->get_post($args['id']);//получаем пост по id из URL

    if ($res) {// если пост найден отображаем страницу
      return $this->view->render($response, "post_read/post_read.template.php", $res);
    }
    else {return print 'Пост не найден';}
  }


  public function edit_show(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface 
  {// страница редактирования
    $post = $this->model->get_post($args['id']);// получаем данные поста для встаки в input
    
    if ($post['author'] != $_SESSION['user']['login']) {// если пользователь попытается изменить чужой пост перенапраляем на глвану страницу
      return $response->withHeader('Location', '/');
    }

    if ($post) {
      return $this->view->render($response, "post_edit/post_edit.template.php", $post);
    }
    else {return print 'Пост не найден';}
  }
  public function edit_form(ServerRequestInterface $request, ResponseInterface $response, array $args) 
  {
    $img = $request->getUploadedFiles()['img'];
    $res = $this->model->update($request->getParsedBody(), $img, $args['id']);

    if ($res) {
      return $response->withHeader('Location', '/read/'.$args['id']);
    }
    else {return print 'Не удалось обновить пост';}
  }


  public function delete(ServerRequestInterface $request, ResponseInterface $response, array $args) 
  {// удаление поста
    $post = $this->model->get_post($args['id']);

    if ($post['author'] != $_SESSION['user']['login']) {// если попытается удалить чужой пост
      return $response->withHeader('Location', $_SERVER['HTTP_REFERER']);
    }
    else {
      $this->model->delete($args['id']);
      return $response->withHeader('Location', $_SERVER['HTTP_REFERER']);
    }
  }
}