<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="/app/views/post_read/style.css" />
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
          <img src="/app/views/img/user.png" />
        </div>
        <span id="user_name"><?php echo $_SESSION['user']['login'] ?></span>
      </div>
      <a href="/logout" id="logout_btn">Выйти</a>

      <div id="post">
        <a href="/" id="back_btn"><div id="bb">←</div></a>
        <?php 
          if ($data['img']) {
            echo ('<img id="post_img" src="/'.$data['img'].'" />');
          }
        ?>
        
        <span id="post_title"><?php echo $data['title'] ?></span><br /><br />
        <span id="post_content"><?php echo nl2br($data['content']);  ?></span> 
        
        <div class="post_author">
          <span>Автор: <?php echo $data['author'] ?></span>
          <span><?php echo date('d.m.y - H:i', strtotime($data['date'])); ?></span>
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
          document.getElementById("post").style.animation = "outBottom .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
          document.getElementById("bb").style.animation = "outLeft .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
          document.getElementById("user_icon").style.animation = "outScale .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
          document.getElementById("user_name").style.animation = "outLeft .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
        }
      </script>
  </body>
</html>
