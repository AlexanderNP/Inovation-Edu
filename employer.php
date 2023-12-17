<?php


include('open_bd.php');
session_start();

if((!isset($_SESSION) || !isset($_SESSION['href'])) && (!isset($_GET) || !isset($_GET['href']))) {
  $script = 'authorization.php';
  header("Location: $script");
}
else if(isset($_SESSION['href'])) {
  $href = $_SESSION['href'];
}
else {
  $href = $_GET['href'];
  $_SESSION['href'] = $href;
}

for($index = 0; $index < count($companys); $index++) {
  if($href == $companys[$index]['href']) {
    $company = $companys[$index];
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
  <link rel="stylesheet" href="css/employer.css">
  <title><?php echo $company['name']; ?></title>
</head>
<body>
  <div class="wrapper">
    <header class="header">
      <div class="container">
        <div class="headerInner">
          <img src="images/icon-user.svg" alt="user" class="headerIconUser">
          <a href="" class="headerUser">
            <p class="headerName"><?php echo $company['name']; ?></p>
          </a>
          <a href="authorization.php" class="headerBtnExit">
            <img src="images/exit.svg" class="headerImgExit" alt="exit">
          </a>
        </div>
      </div>
    </header>
    <main class="main">
    <div class="popUp" id="popup">
        <div class="popUp-container">
          <div class="popUp-body">
            <button class="popUp-btn-close">
              <img class="popUp-close-img" src="images/close-svgrepo-com.svg" alt="close">
            </button>
            <div class="Results" id="testResults">
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="mainWrapper">
          <section class="mainResult">
            <div class="resultInner">
              <h2 class="resultTitleInner">Результаты</h2>
              <ul class="resultList">
                <?php

                  for($index = 0; $index < count($users); $index++) {

                    for($jIndex = 0; $jIndex < count($users[$index]['results']); $jIndex++) {

                      if($users[$index]['results'][$jIndex]['company'] == $company['name']) {

                        echo '<li class="resultItem">
                          <div class="resultAbout">
                            <p class="resultName">'.$users[$index]['name'].' '.$users[$index]['last_name'].'</p>
                            <p class="resultValue">Кол-во баллов: '.$users[$index]['results'][$jIndex]['result'].'</p>
                          </div>
                          <p class="resultTitle">'.$users[$index]['results'][$jIndex]['name'].'</p>
                          <a class="resultLink" data-user-id="'.$index.'" data-quest-id="'.$jIndex.'">ПЕРЕЙТИ</a>
                        </li>';

                      }

                    }

                  }

                ?>
              </ul>
            </div>
          </section>
          <section class="mainCompanyTest">
            <?php echo '<a class="companyTestNew button" href="constructor.php?href='.$href.'">НОВЫЙ ТЕСТ</a>'; ?>
            <div class="companyTestInner">
              <p class="companyTestInnerTitle">Ваши тесты</p>
                <ul class="companyTestList">
                  <?php

                      for($index = count($quests)-1; $index >= 0; $index--) {
                        if(timeDiff2($quests[$index]['close']) && $quests[$index]['company'] == $company['name']) {
                          echo '<li class="companyTestItem">
                          <div class="companyTestDesk">
                            <p class="companyTestTitle">'.$quests[$index]['name'].'</p>
                          </div>
                          <p class="companyTestLast">До конца: '.timeDiff($quests[$index]['close']).'</p>
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

  <script src="./js/popupCompany.js" defer></script>
  <script src="./js/getResult.js" defer></script>
</body>
</html>