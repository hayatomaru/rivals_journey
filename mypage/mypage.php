<?php
  require_once('../config.php');
  require_once('../management.php');
  require_once('../function.php');

  $App = new DB();
  $leaders = $App->getLeader();
  $types = $App->getType();
  $decks = $App->getDeck($_SESSION['me']->id);

  // var_dump($decks);
  // exit;

?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>マイページ</title>
    <link rel = "stylesheet" href = '../css/default.css'>
    <link rel = "stylesheet" href = '../css/styles.css'>
    <link rel = "stylesheet" href = '../css/header.css'>
    <link rel = "stylesheet" href = './mypage.css'>
  </head>
  <body>
    <?php include "../header.php" ?>
    <h1>マイページ</h1>
    <div id = "container">
      <h2>デッキ一覧</h2>
      <div id = "deck_list">
        <?php foreach($decks as $deck): ?>
          <div class = "select" id = "deck_<?php echo h($deck->id) ?>" data-id = "<?php echo h($deck->id) ?>">
            <h4 class = "deckName"><?php echo h($deck->name) ?></h4>
            <p class = "detail">リーダー：<?php echo h($deck->leader) ?> </p>
            <p class = "detail">タイプ：<?php echo h($deck->type) ?></p>
            <a href = "<?php echo h($deck->url) ?>" class = "btn inline">デッキを確認</a>
            <a href = "../deck_data/index.php?deckName=<?php echo h($deck->name) ?>" class = "btn inline">詳細</a>
            <div class = "delete btn" data-name = "<?php echo h($deck->name) ?>">削除</div>
          </div>
        <?php endforeach; ?>
      </div>
      <form action = "logout.php" method = "post" id = "logout">
      <input type  = "submit" value = "ログアウト">
      </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src = "../main.js"></script>
  </body>
</html>
