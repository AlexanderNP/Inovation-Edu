<?php

  session_start();

  if(!isset($_SESSION) || !isset($_SESSION['user'])) {

    $script = 'authorization.php';
    header("Location: $script");

  }
  
  $user_login = $_SESSION['user'];

  include('open_bd.php');

  $user;
  $user_index;

  for($index = 0; $index < count($users); $index++) {

    if($user_login == $users[$index]['login']) {

      $user = $users[$index];
      $user_index = $index;

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
  <link rel="stylesheet" href="css/user-profile.css">
  <title>Редактировать профиль - <?php echo $user['login']; ?></title>
</head>

<body>
  <div class="wrapper">
    <header class="header">
      <div class="container">
        <div class="headerInner">
          <a href='index.php'><img src="images/icon-user.svg" alt="user" class="headerIconUser"></a>
          <a href="index.php" class="headerUser">
            <p class="headerName"><?php echo $user['name'].' '.$user['last_name']; ?></p>
            <p class="headerCategory"><?php echo $user['stack']; ?></p>
          </a>
          <button class="headerBtnExit">
            <img src="images/exit.svg" class="headerImgExit" alt="exit">
          </button>
        </div>
      </div>
    </header>
    <main class="main">
      <section class="mainProfile">
        <div class="containerProfile">
          <form class="profileForm" action="changeProfile.php" method='POST'>
            <?php echo '<input class="formProfileInput" name="firstName" type="text" required value="'.$user['name'].'">'; ?>
            <?php echo '<input class="formProfileInput" name="secondName" type="text" required value="'.$user['last_name'].'">'; ?>
            <?php echo '<textarea class="formProfileTextarea" name="message" cols="30" rows="10" placeholder="'.$user['about'].'"></textarea>'; ?>
            <select class="formProfileSelect" name="interests">
              <option value="" disabled selected hidden>Сфера интереса</option>
              <option value="frontend">frontend</option>
              <option value="backend">backend</option>
              <option value="manager">manager</option>
            </select>
            <select class="formProfileSelect" name="stack">
              <option value="" disabled selected hidden>Стек</option>
              <option value="JavaScript">JavaScript</option>
              <option value="Python">Python</option>
              <option value="Python">C#</option>
            </select>
            <?php echo '<input type="hidden" name="id" value="'.$user_index.'">'; ?>
            <button class="profileBtn button">Сохранить</button>
          </form>
        </div>
      </section>
    </main>
  </div>
</body>

</html>