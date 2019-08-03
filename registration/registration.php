<?php

require_once('../config.php');
require_once('../management.php');
require_once('../function.php');

$App = new DB();
$leaders = $App->getLeader();
$types = $App->getType();


 ?>


<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>デッキ登録</title>
    <link rel = "stylesheet" href = "../css/default.css">
    <link rel = "stylesheet" href = "registration.css">
    <link rel = "stylesheet" href = "../css/header.css">
  </head>
  <body>
    <?php include("../header.php") ?>
    <h1>デッキ登録</h1>
    <div id = "container">
      <div id = "left">
      <form action = "" id = "write" method = "post">
        <h2>デッキ名</h2>
          <input id = "deck_name" type = "text">
        <h2>リーダー</h2>
          <select id = "deck_leader">
            <option disabled selected value>選択してください。</option>
            <?php foreach ($leaders as $leader): ?>
              <option id = "chara_<?php echo h($leader->id) ?>" vlaue = "<?php echo h($leader->character_name) ?>"><?php echo h($leader->character_name) ?></option>
            <?php endforeach; ?>
          </select>
        <h2>デッキタイプ</h2>
          <select id = "deck_type">
            <option disabled selected value>選択してください。</option>
            <?php foreach ($types as $type): ?>
              <option id = "type_<?php echo h($leader->id) ?>" vlaue = "<?php echo h($type->type) ?>"><?php echo h($type->type) ?></option>          <?php endforeach; ?>
          </select>
        <h2>デッキURL</h2>
          <textarea id = "deck_url" type = "text"></textarea>
        <div id = "error"></div>
        <div id = "registration">登録</div>
      </form>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src = "registration.js"></script>
  </body>
</html>
