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
  <link rel="stylesheet" href="css/constructor.css">
  <title>Конструктор тестов</title>
</head>

<body>
  <div class="wrapper">
    <header class="header">
      <div class="container">
        <div class="headerInner">
          <img src="images/icon-user.svg" alt="user" class="headerIconUser">
          <a href="employer.php" class="headerUser">
            <p class="headerName"><?php echo $company['name']; ?></p>
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
      <section class="mainConstruct">
        <div class="container">
          <div class="constructInner">
            <a href="employer.php" class="constructLink button">Вернуться назад</a>
            <form action="newTest.php" method="POST" class="constructForm">
              <label class="constructLabel">
                Название теста
                <input required type="text" name="name" id="" class="constructInput">
              </label>
              <label class="constructLabel">
                Сложность
                <select class="constructInput" name="diff" id="">
                  <option value="" disabled selected hidden></option>
                  <option value="Hard">Hard</option>
                  <option value="Medium">Medium</option>
                  <option value="Easy">Easy</option>
                </select>
              </label>
              <label class="constructLabel">
                Конец теста
                <input type="date" name="date" id="" class="constructInput">
              </label>
              <div id="questionsContainer"></div>
              <?php echo '<input type="hidden" name="company" value="'.$company['name'].'">'; ?>
              <button id="submitBtn" class="constructBtn button hidden">Опубликовать тест</button>
            </form>
            <div class="constructBtnWrap">
              <button class="constructBtn variantQuestion button" onclick="addQuestion('multipleChoice')">Добавить вопрос с вариантами</button>
              <button class="constructBtn openQuestion button" onclick="addQuestion('open')">Добавить открытый вопрос</button>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
  <script src="./js/constructor.js" defer></script>
</body>

</html>