<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create</title>
    <link rel="stylesheet" href="app/views/postCreate/style.css" />
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

    <h1 id="headline"><div>Создание</div></h1>

    <form method="POST" id="post" enctype="multipart/form-data">
      <a href="<?= $_SERVER['HTTP_REFERER'] ?>" id="back_btn"><div id="b_b">←</div></a>
      <div>
        <input accept="image/*" type="file" id="imgInp" name="img"/>
        <img id="post_img" src="#" />
      </div>

      <input type="text" name="title" id="post_title" placeholder="Заголовок" required="required"/><br /><br />
      <textarea form="post" name="content" id="post_content" placeholder="Содержимое" required="required"></textarea>
      <button type="submit" name="submit" id="create_btn">Создать</button>
    </form>

    <script>
      let imgInp = document.getElementById("imgInp");
      let post_img = document.getElementById("post_img");
      
      // Превью загруженного изображения
      imgInp.onchange = evt => {
        const [file] = imgInp.files;
        if (file) {
          post_img.src = URL.createObjectURL(file);
        }
      };

      // анимация исчезновения элементов при переходе на другую страницу
      let links = document.getElementsByTagName('a');
      var linksArray = Array.prototype.slice.call(links);
    
      linksArray.forEach(element => {
        element.onclick = submit;
      });

      const form = document.getElementById("form");
      form.addEventListener("submit", submit);

      function submit() {
        document.getElementById("headline").style.animation = "outIn .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
        document.getElementById("post").style.animation = "outBottom .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
        document.getElementById("b_b").style.animation = "outLeft .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
        document.getElementById("user_icon").style.animation = "outScale .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
        document.getElementById("user_name").style.animation = "outLeft .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
      }
    </script>
  </body>
</html>
