<?php
  require_once('../config.php');
  require_once('../management.php');
  require_once('../function.php');
  require_once('controller/Signup.php');
  require_once('Controller.php');

  $app = new Signup();

  $app->run();

  // var_dump($decks);
  // exit;

?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>新規登録</title>
    <link rel = "stylesheet" href = '../css/default.css'>
    <link rel = "stylesheet" href = '../css/styles.css'>
    <link rel = "stylesheet" href = 'login.css'>
    <link rel = "stylesheet" href = "../css/header.css">
  </head>
  <body>
    <?php include "../header.php" ?>
    <h1>新規登録</h1>
    <div id = "login_menu">
      <div id = "login_left">
        <form action = "" method = "post" id = "signup">
          <h2>新規登録</h2>
          <h3>ユーザ名</h3>
          <input type = "text" name = "email" placeholder = "email" value = "<?= isset($app->getValues()->email) ? h($app->getValues()->email) : ''; ?>">
          <h3>パスワード</h3>
          <input type = "text" name = "password" placeholder = "password">
          <div id = "enter" class = "btn" onclick= "document.getElementById('signup').submit()">登録をする</div>
        </form>
        <a href = "login.php" class = "btn">ログイン</a>
      </div>

      <div id = "login_right">
        <img src = "../img/marchant.png">
      </div>
    </div>
  </body>
</html>
