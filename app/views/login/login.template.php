<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="app/views/login/login.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <?php
      if (array_key_exists('reg_success', $_GET)) {
        echo '<div id="reg_message">Регистрация прошла успешно</div>';
      }
      if (array_key_exists('error', $data)) {
        echo '<div id="err_message">'.$data['error'].'</div>';
      }
    ?>
  
    

    <form method="POST" class="login_container" id="form">
      <div id="user_icon">
        <img src="app/views/img/user.png" />
      </div>
      <div class="input_div" id="dv">
        <div id="ic_1"><img src="app/views/img/input-user.png" /></div>
        <input id="login" type="text" name="login" placeholder="Логин" required="required" value="<?php echo array_key_exists('form_data', $data) ? $data['form_data']['login'] : '' ?>"/>
      </div>
      <div class="input_div" id="dv_2">
        <div id="ic_2"><img src="app/views/img/padlock.png" /></div>
        <input id="password" type="password" name="password" placeholder="Пароль" required="required"/>
      </div>

      <div id="btn_container"><button type="submit" id="btn" name="submit">Войти</button></div>
      <a href="/registration"><div id="ss">Регистрация</div></a>
    </form>

    <script>
      // анимация исчезновения элементов при переходе на другую страницу
      const form = document.getElementById("form");
      form.addEventListener("submit", submit);

      document.getElementById("ss").onclick = submit;

      function submit() {
        document.getElementById("login").style.animation = "outTop .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
        document.getElementById("password").style.animation = "outTop .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";

        document.getElementById("ic_1").style.animation = "outTop .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
        document.getElementById("ic_2").style.animation = "outTop .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";

        document.getElementById("btn").style.animation = "outTop .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
        document.getElementById("ss").style.animation = "outTop .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";

        document.getElementById("user_icon").style.animation = "outScale .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
      }
    </script>
  </body>
</html>
