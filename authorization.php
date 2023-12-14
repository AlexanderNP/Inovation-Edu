<?php

  $error = false;

  if(isset($_GET)) {
    if(isset($_GET['error'])) {
      $error = true;
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
  <link rel="stylesheet" href="css/authorization.css">
  <title>Авторизация</title>
</head>

<body>
  <div class="wrapper">
    <div class="auth">
      <div class="authСontainer">
        <div class="authBody">
          <h2 class="authTitle">Войти</h2>
          <form action="auth.php" method='POST' class="authForm">
            
            <?php

              if($error) echo '<p>Неправильные данные</p>';

            ?>
          
            <input class="authInput" type="text" name="login" required placeholder="Логин">
            <input class="authInput" type="password" name="password" required placeholder="Пароль">
            <button class="authBtn button">Войти</button>
          </form>
          <p class="authText">Ещё не зарегистрировались?</p>
          <a class="authLink" href="/registration.php">Зарегистрироваться</a>
        </div>  
      </div>
    </div>
  </div>

</body>

</html>