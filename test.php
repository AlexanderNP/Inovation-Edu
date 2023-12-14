<?php

  include('open_bd.php');

  session_start();
  if(!isset($_SESSION) || !isset($_SESSION['user'])) {
    $script = 'authorization.php';
    header("Location: $script");
  }

  $user_login = $_SESSION['user'];

  $user;

  for($index = 0; $index < count($users); $index++) {
    if($user_login == $users[$index]['login']) {
      $user = $users[$index];
    }
  }

  if(!isset($_GET['id'])) {
    $script = 'index.php';
    header("Location: $script");
  }

  $test_index = $_GET['id'];

  $current_quest;

  $current_quest = $quests[$test_index];
  
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/test.css">
  <title>Тест - <?php echo $current_quest['name']; ?></title>
</head>

<body>
  <div class="wrapper">
    <header class="header">
      <div class="container">
        <div class="headerInner">
          <img src="images/icon-user.svg" alt="user" class="headerIconUser">
          <a href="#" class="headerUser">
            <p class="headerName"><?php echo $user['name'].' '.$user['last_name']; ?></p>
            <p class="headerCategory"><?php echo $user['stack']; ?></p>
          </a>
          <form action="exit.php" method="POST">
            <button class="headerBtnExit">
              <img src="images/exit.svg" class="headerImgExit" alt="exit">
            </button>
          </form>
        </div>
      </div>
    </header>
    <main class="main">
      <section class="mainTest">
        <div class="container">
          <div class="testInner">
            <a class="testLinkBack button" href="index.php">
              Вернуться назад
            </a>
            <form class="testForm" method="POST" action="sendQuest.php">
              <?php

                for($index = 0; $index < count($current_quest['quest']); $index++) {
                  
                  $question = $current_quest['quest'][$index];

                  if(isset($question['variable'])) {
                    echo '<div class="testQuestion">
                    <h2 class="questionNumber">Вопрос '.$index.'</h2>
                    <p class="questionTitle">'.$question['text'].'</p><br>';
                    for($jIndex = 0; $jIndex < count($question['variable']); $jIndex++) {
                        echo '<label class="checkbox-container">
                        <input name="answer'.$index.'" value="'.$question['variable'][$jIndex].'" type="checkbox">
                        <span class="checkmark"></span>
                        <input name="type'.$index.'" value="check" type="hidden">
                        <p class="checkbox-text">'.$question['variable'][$jIndex].'</p>
                      </label>';
                    }
                    echo '</div>';
                  }
                  else {
                    echo '<div class="testQuestion">
                      <h2 class="questionNumber">Вопрос '.$index.'</h2>
                      <p class="questionTitle">'.$question['text'].'</p>
                      <p class="questionInstruct">Вставьте ответ в форму</p>
                      <input name="type'.$index.'" value="open" type="hidden">
                      <textarea class="questionCode" name="answer'.$index.'" id="" cols="30" rows="10"></textarea>
                    </div>';
                  }

                }

              ?>
              <?php echo '<input type="hidden" name="id" value="'.$test_index.'">'; ?>
              <button class="formBtn button">Закончить тест</button>

            </form>
          </div>
        </div>
      </section>
    </main>
  </div>

  <script src="./js/checkbox.js"></script>

</body>

</html>