<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration</title>
    <link rel="stylesheet" href="app/views/login/registration.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <div id="err_message"><?php echo  $data ? $data['error'] : '' ?></div>

    <form method="POST" class="login_container" id="form">
      <div id="user_icon">
        <img src="app/views/img/add-user.png" />
      </div>
      <div class="input_div" id="dv_1">
        <div id="ic_1"><img src="app/views/img/input-user.png" /></div>
        <input type="text" name="login" placeholder="Логин"
          id="login"
          required="required"
          pattern="[a-zA-Z0-9-]{3,15}"
          oninvalid="this.setCustomValidity('Логин должен состоять от 3 до 15 символов и содержать только a-z, 0-9 и дефис')"
          oninput="this.setCustomValidity('')"  maxlength="15"
          value="<?php echo $data ? $data['form_data']['login'] : '' ?>"
        />
      </div>
      <div class="input_div" id="dv_2">
        <div id="ic_2"><img src="app/views/img/email.png" /></div>
        <input id="email" type="email" name="email" placeholder="Email" required="required" value="<?php echo $data ? $data['form_data']['email'] : '' ?>"/>
      </div>
      <div class="input_div" id="dv_3">
        <div id="ic_3"><img src="app/views/img/padlock.png" /></div>
        <input type="password" name="password" placeholder="Пароль" 
          id="password"
          required="required"
          pattern="(?=^.{6,15}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*"
          oninvalid="this.setCustomValidity('не менее 6 символов и содержать цифру, букву в верхнем регистре и в нижнем')"
          oninput="this.setCustomValidity('')"  maxlength="15"
        />
      </div>
      <div class="input_div" id="dv_4">
        <div id="ic_4"><img src="app/views/img/padlock.png" /></div>
        <input type="password" name="password_2" placeholder="Повторите пароль" 
          id="password_2"
          required="required"
          onchange="validate(this)"
        />
      </div>

      <div id="btn_container"><button type="submit" name="submit" id="btn">Регистрация</button></div>
      <a href="/login"><div id="ss">Войти</div></a>
    </form>

    <script src="app/views/login/registration.js"></script>
  </body>
</html>
