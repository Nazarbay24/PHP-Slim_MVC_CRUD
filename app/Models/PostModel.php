<?php

namespace app\models;

use app\core\DB;
use PDOException;

class PostModel
{
    public function getPost(int $id)
    {
        return DB::run("SELECT * FROM `posts` WHERE `id` = ?", [$id]);
    }

    public function getPostsCount(string $filter) 
    {
        if ($filter == 'all') {// количество всех постов
            return DB::query("SELECT COUNT(*) FROM `posts`")->fetchColumn();
        }
        elseif ($filter == 'my') {// количество поста пользователья
            $user = $_SESSION['user']['login'];
            return DB::query("SELECT COUNT(*) FROM `posts` WHERE `author` = '$user'")->fetchColumn();
        }
    }

// получение постов теущей страницы
    public function getPagePosts(int $offset, int $size_page, string $filter) {
        if ($filter == 'all') {
            return DB::run("SELECT * FROM `posts` ORDER BY `date` DESC LIMIT $offset, $size_page");
        }
        elseif ($filter == 'my') {
            $user = $_SESSION['user']['login'];
            return DB::run("SELECT * FROM `posts` WHERE `author` = '$user' ORDER BY `date` DESC LIMIT $offset, $size_page");
        }
    }



    public function create(array $form_data, $img) 
    {
        $img_path = $this->saveImg($img);
        
        try {
            DB::run(
                "INSERT INTO `posts` (`title`,`content`,`author`,`img`) VALUES(?,?,?,?)", 
                [$form_data['title'], $form_data['content'], $_SESSION['user']['login'], $img_path]
            );
            return DB::lastInsertId();
        } 
        catch(PDOException $e) {
            echo 'Не удалось создать пост';
            echo 'Error: ' . $e->getMessage();
            return false;
        }
        
    }

    public function update(array $form_data, $img, int $id) :bool
    {
        $img_path = $this->saveImg($img);
        
        try {
            if ($img_path != null) {
                DB::run(
                    "UPDATE `posts` SET `title`=?, `content`=?, `img`=? WHERE `id`=?",
                    [$form_data['title'], $form_data['content'], $img_path, $id]
                );
            }
            else {
                DB::run(
                    "UPDATE `posts` SET `title`=?, `content`=? WHERE `id`=?" , 
                    [$form_data['title'], $form_data['content'], $id]
                );
            }
            return true;
        } 
        catch(PDOException $e) {
            echo 'Не удалось обновить пост';
            echo 'Error: ' . $e->getMessage();
            return false;
        }
        
    }

    protected function saveImg($img) 
    {// проверяем загружно ли изображение
        if ($img->getClientFilename()) {
            $name = mt_rand(0, 10000) . $img->getClientFilename();// изменяем имя изображения что бы не перезаписывалось
            $img->moveTo('app/uploaded_post_images/' . $name);// сохраняем на сервер
            return 'app/uploaded_post_images/' . $name;// возвращаем путь до изображения
        } 
        return null;// если изображение не загружено
    }


    public function delete($id) {
        return DB::run("DELETE FROM `posts` WHERE `id`=?", [$id]);
    }
}