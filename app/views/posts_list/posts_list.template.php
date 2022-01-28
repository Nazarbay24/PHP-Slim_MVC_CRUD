<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="app/views/posts_list/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <div id="user_info">
      <div id="user_icon">
        <img src="app/views/img/user.png" />
      </div>
      <span id="user_name"><?php echo $_SESSION['user']['login'] ?></span>
    </div>
    <a href="/logout" id="logout_btn">Выйти</a>

    <h1 id="headline">Список новостей</h2>
    <div id="content">
      <nav>
        <div id="filter">
          <a id="all" href="/" class="<?php if($data['filter'] == 'all') {echo 'active';}?>">Все</a>
          <a id="my" href="/my" class="<?php if($data['filter'] == 'my') {echo 'active';}?>">Мои новости</a>
        </div>
        <a href="/create" id="add_post">+</a>
      </nav>

      <div id="posts_list">
        <?php foreach ($data['posts'] as $post): ?>
        <a href="/read/<?php echo $post['id'] ?>" class="post">
          <div class="post_img" style="background-image: url('/<?php echo $post['img'] ?>');">
            <?php
              if(!$post['img']) {echo "Изображение<br>отсутствует";}
            ?>
          </div>
          <div class="post_info">
            <div class="post_title"><?php echo mb_strimwidth($post['title'] , 0, 90, "..."); ?></div>
            <span class="post_content"><?php echo mb_strimwidth($post['content'] , 0, 185, "..."); ?></span>
            <div class="post_author">
              <span>Автор: <?php echo $post['author'] ?></span>
              <span><?php echo date('d.m.y - H:i', strtotime($post['date'])); ?></span>
            </div>
          </div>

          <?php if ($post['author'] == $_SESSION['user']['login']): ?>
          <object class="post_action" type="owo/uwu">
            <a href="/edit/<?php echo $post['id'] ?>" class="post_edit"><img src="app/views/img/edit.png" /></a>
            <a href="/delete/<?php echo $post['id'] ?>"  onclick="return confirm('Вы действительно хотите удалить ?');" class="post_delete"><img src="app/views/img/delete.png" /></a>
          </object>
          <?php endif; ?>
        </a>
        <?php endforeach; ?>
      </div>
      
      <div id="pagination">
        <?php for ($pageNum = 1; $pageNum <= $data['total_pages']; $pageNum++): ?>
          <a href="/?page=<?= $pageNum ?>" class="<?= $pageNum == $data['current_page'] ? 'active' : ''?>"><?= $pageNum ?></a>
        <?php endfor; ?>
      </div>
    </div>

    <script>
      // анимация исчезновения элементов при переходе на другую страницу
      let links = document.getElementsByTagName('a');
      var linksArray = Array.prototype.slice.call(links);
     
      linksArray.forEach(element => {
        element.onclick = submit;
      });

      function submit() {
        document.getElementById("posts_list").style.animation = "outBottom .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
        document.getElementById("headline").style.animation = "outIn .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
        document.getElementById("all").style.animation = "outTop .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
        document.getElementById("my").style.animation = "outTop .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
        document.getElementById("add_post").style.animation = "outTop .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
        document.getElementById("pagination").style.animation = "outTop .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
        document.getElementById("user_icon").style.animation = "outScale .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
        document.getElementById("user_name").style.animation = "outLeft .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
      }
    </script>
  </body>
</html>
