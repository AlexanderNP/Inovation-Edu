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

  include('time_diff.php');
  include('time_diff2.php');

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Главная страница - <?php echo $user['login']; ?></title>
</head>

<body>
  <div class="wrapper">
    <header class="header">
      <div class="container">
        <div class="headerInner">
          <a href='user_profile.php'><img src="images/icon-user.svg" alt="user" class="headerIconUser"></a>
          <a href="user_profile.php" class="headerUser">
            <p class="headerName"><?php echo $user['name'].' '.$user['last_name']; ?></p>
            <p class="headerCategory"><?php echo $user['stack']; ?></p>
          </a>
          <!--<button class="headerBtnPush">
            <img src="images/not-push.svg " class="headerPushImg" alt="net-push">
          </button> -->
          <form action="exit.php" method="POST">
            <button class="headerBtnExit">
              <img src="images/exit.svg" class="headerImgExit" alt="exit">
            </button>
          </form>
        </div>
      </div>
    </header>
    <main class="main">
      <div class="container">
        <div class="mainWrapper">
          <section class="mainTest">
            <h1 class="historyTitle">История</h1>
            <div class="testInner">
              <ul class="testContentList">
                <?php

                  $history = $user['results'];

                  if(count($history) == 0) {

                    echo '<p class="emptyHistory">Пока что вы не проходили тестирование.</p>';

                  }

                  for($index = count($history)-1; $index >= 0; $index--) {

                    echo '<li class="testContentItem">
                      <div class="testTitleWrap">
                        <p class="testTitle">'.$history[$index]['name'].'</p>
                        <span class="testLevel '.$history[$index]['diff'].'">'.$history[$index]['diff'].'</span>
                      </div>
                      <div class="testLastResult">
                        <p class="lastResult">Ваш результат:</p>
                        <p class="lastResultValue">'.$history[$index]['result'].'</p>
                      </div>
                      <div class="testLastPassing">
                        <p class="lastPassing">Пройден:</p>
                        <p class="lastPassingValue">'.$history[$index]['time'].'</p>
                      </div>
                      <div class="testFirstPassing">
                        <p class="firstPassing">Создан:</p>
                        <p class="firstPassingValue">'.$history[$index]['open'].'</p>
                      </div>
                      <a class="testLink button" data-quest-id="'.$index.'" data-user-id="'.$user_index.'">Подробнее</a>
                    </li>';

                  };

                ?>
              </ul>
            </div>
          </section>
          <section class="mainUpdate">
            <div class="updateInner">
              <p class="updateInnerTitle">Обновления</p>
              <ul class="updateList">
                <?php

                  
                  for($index = count($quests)-1; $index >= 0; $index--) {
                    if(timeDiff2($quests[$index]['close'])) {
                      echo '<li class="updateItem">
                        <div class="updateDesk">
                          <p class="updateTitle">'.$quests[$index]['name'].'</p>
                          <p class="updateCompany">'.$quests[$index]['company'].'</p>
                        </div>
                        <p class="updateLast">До конца: '.timeDiff($quests[$index]['close']).'</p>
                        <a href="test.php?id='.$index.'" class="updateBtn button">ПЕРЕЙТИ</a>
                      </li>';
                    }

                  }

                ?>
              </ul>
            </div>
          </section>
        </div>
      </div>
    </main>
  </div>

</body>

</html>