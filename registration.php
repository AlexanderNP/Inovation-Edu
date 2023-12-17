<?php

  $error = false;

  if(isset($_GET)) {
    if(isset($_GET['error'])) {
      $error = $_GET['error'];
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/registration.css">
  <title>Регистрация</title>
</head>
<body>
  <div class="wrapper">
    <div class="mainReg">
      <div class="containerReg">
        <div class="regWrap">
          <a class="regLink" href="/authorization.php">
            <img class="regIcon" src="images/icon-back.svg" alt="icon-back">
          </a>
          <h2 class="regTitle">Регистрация</h2>
          <?php
            if($error) {
              if($error == '01') echo '<p>Пользователь с таким логином уже существует!</p>';
              else if($error == '02') echo '<p>Пароли не совпадают!</p>';
            }
          ?>
          <form class="regForm" action="regform.php" method="POST">
            <input class="formRegInput" name="firstName" type="text" required placeholder="Имя">
            <input class="formRegInput" name="secondName" type="text" required placeholder="Фамилия">
            <input class="formRegInput" name="login" type="text" required placeholder="Логин">
            <input class="formRegInput" name="password" type="password" required placeholder="Пароль">
            <input class="formRegInput" name="password2" type="password" required placeholder="Повторите пароль">
            <textarea class="formRegTextarea" name="message" cols="30" rows="10" placeholder="Напиши о себе"></textarea>
            <select class="formRegSelect" name="interests">
              <option value="" disabled selected hidden>Сфера интереса</option>
              <option value="frontend">frontend</option>
              <option value="backend">backend</option>
              <option value="manager">manager</option>
            </select>
            <select class="formRegSelect" name="stack">
              <option value="" disabled selected hidden>Стек</option>
              <option value="JavaScript">JavaScript</option>
              <option value="Python">Python</option>
              <option value="Python">C#</option>
            </select>
            <button class="regBtn button">Зарегистрироваться</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <footer class="footer">
    <div class="containerReg">
      <div class="footerInner">
        <a class="footerLink" href="authCompany.php">Вы работодатель? <span style='color: #004394;'>Свяжитесь с нами!</span></a>
      </div>
    </div>
  </footer>
</body>
</html>