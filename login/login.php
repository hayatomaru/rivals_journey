<?php
ini_set( 'display_errors', 1 );
ini_set( 'error_reporting', E_ALL );

  require_once('../config.php');
  require_once('../management.php');
  require_once('../function.php');
 require_once('../login/controller/Login.php');
  require_once('Controller.php');


  $log = new Login();

  $log->run();

?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ログイン</title>
    <link rel = "stylesheet" href = '../css/default.css'>
    <link rel = "stylesheet" href = '../css/styles.css'>
    <link rel = "stylesheet" href = 'login.css'>
   <link rel = "stylesheet" href = "../css/header.css">
  </head>
  <body>
    <?php include "../header.php" ?>
    <h1>ログイン</h1>
    <div id = "login_menu">
      <div id = "login_left">
        <form action = "" method = "post" id = "signup">
          <h2>ログイン</h2>
          <h3>ユーザ名</h3>
          <input type = "text" name = "email" placeholder = "email" value = "<?= isset($log->getValues()->email) ? h($log->getValues()->email) : ''; ?>">
          <h3>パスワード</h3>
          <input type = "password" name = "password" placeholder = "password">
          <div id = "enter" class = "btn" onclick= "document.getElementById('signup').submit()">ログイン</div>
        </form>
        <a href = "signup.php" class = "btn">新規登録</a>
      </div>

      <div id = "login_right">
        <img src = "../img/monk.png">
      </div>
    </div>
  </body>
</html>
