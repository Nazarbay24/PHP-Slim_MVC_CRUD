// Валидация повторного паролья
let pass_1 = document.getElementById("password");

function validate(input) {
  if (input.value == pass_1.value) {
    input.setCustomValidity("");
  } else {
    input.setCustomValidity("Пароль не совпадает");
  }
}

// анимация исчезновения элементов при переходе на другую страницу
const form = document.getElementById("form");
form.addEventListener("submit", submit);

document.getElementById("ss").onclick = submit;

function submit() {
  document.getElementById("login").style.animation = "outTop .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
  document.getElementById("email").style.animation = "outTop .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
  document.getElementById("password").style.animation = "outTop .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
  document.getElementById("password_2").style.animation = "outTop .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";

  document.getElementById("ic_1").style.animation = "outTop .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
  document.getElementById("ic_2").style.animation = "outTop .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
  document.getElementById("ic_3").style.animation = "outTop .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
  document.getElementById("ic_4").style.animation = "outTop .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";

  document.getElementById("btn").style.animation = "outTop .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
  document.getElementById("ss").style.animation = "outTop .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";

  document.getElementById("user_icon").style.animation = "outScale .5s cubic-bezier(0.8, 0, 0.2, 1) 1 forwards";
}
