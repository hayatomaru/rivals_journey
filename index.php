<?php
  require_once('./config.php');
  require_once('./management.php');
  require_once('./function.php');

  $App = new DB();
  $leaders = $App->getLeader();
  $types = $App->getType();
  $decks = $App->getDeck2();

  // var_dump($decks);
  // exit;

?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ライバルズの旅</title>
    <link rel = "stylesheet" href = 'css/styles.css'>
    <link rel = "stylesheet" href = 'css/default.css'>
    <link rel = "stylesheet" href = 'css/header.css'>
  </head>
  <body>
    <?php include ("./header.php") ?>
    <div id = "top_container">
      <h1>ライバルズの旅</h1>
      <P> ライバルズが面白くなるコンテンツを用意！</p>
    </div>
    <div id = "container">
      <div id = "left_side">
        <h2>ニュース</h2>
        <div id = "news">
          <p>7月31日　　サイトがオープンしました！</p>
        </div>
        <h2>おすすめ動画</h2>
        <div id = "video">
          <p>comming soon</p>
        </div>
      </div>
      <div id = "right_side">
        <h2>大会情報</h2>
        <p>comming soon</p>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src = "main.js"></script>
  </body>
</html>
