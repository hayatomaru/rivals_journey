<?php


require_once('../config.php');
require_once('../management.php');
require_once('../function.php');

$App = new DB();
$leaders = $App->getLeader();
$types = $App->getType();
$decks = $App->getDeck2();
// $fight = $App->getFight();

$deckName = $_GET['deckName'];



$deck_details = $App->findDeckData($deckName);



$victories = $App->mathmatic($deckName);

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo h($deckName) ?></title>
        <!-- <link rel = "stylesheet" href = "../css/default.css"> -->
    <link rel = "stylesheet" href = "css/styles.css">
    <link rel = "stylesheet" href = "../css/header.css">
  </head>

  <body>
    <?php include "../header.php" ?>
    <div id = "container">
      <?php foreach($deck_details as $deck_detail): ?>
      <div id = "first_wrapper">
        <div id = "deck">
          <div id = "deck_name">
            <h1 id = "deck_naming"><?php echo h($deck_detail->name) ?></h1>
            <div id = "deck_type">
              <div class = "group"><?php echo h($deck_detail->leader) ?></div>
              <div class = "group"><?php echo h($deck_detail->type) ?></div>
            </div>
          </div>
          <!-- <img id = "character_photo" src = "<?php echo h($deck_detail->photo) ?>"> -->
          <div id = "deck_data">
            <div class = "boxes" id = "element1">
              <div class = "boxes_mini">勝率</div>
              <div class = big id = "whole_percent"><?php echo $victories[9] ?>%</div>
            </div>
            <div class = "boxes" id = "element2">
              <div class = "boxes_mini">勝敗数</div>
              <div class = "big" id = "whole_victory"><?php echo $victories[7] ?>勝<?php echo $victories[8] ?>敗</div>
            </div>
            <div class = "boxes" id = "element3">
              <div class = "boxes_mini">相性</div>
              <div id = "strong_leader">強い：???</div>
              <div id = "weak_leader">弱い：???</div>
            </div>
            <div class = "boxes" id = "element4">
              <div class = "boxes_mini">その他</div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach ?>
      <div class = "characters">
        <h2>各キャラクターとの戦績</h2>
        <?php foreach($leaders as $leader): ?>

        <div class = "character">
          <div class = "icon">
            <div class = "photo"><img src = "<?php echo h($leader->photo) ?>"></div>
            <p class = "leader_name"><?php echo h($leader->character_name) ?></p>
          </div>
          <div class = "data">
            <div class = "score">
              <div class = "box1 right-border winner"><?php echo $App->getFight($leader->character_name,$deckName)[$leader->character_name] ?></div>
              <div class = "box1 right-border">勝</div>
              <div class = "box1 right-border loser"><?php echo $App->getVictory($leader->character_name,$deckName)[$leader->character_name] ?></div>
              <div class = "box1">敗</div>
            </div>
            <div class = "win_per">
              <div class = "box2 right-border">勝率</div>
              <div class = "box2 percent"><?php echo $victories[$leader->id - 1] ?></div>
              <div class = "box2 percent_single">%</div>
            </div>
            <div class = "select">
              <div class = "controll">
                <div class = "S-btn win_plus">勝ち+1</div>
                <div class = "S-btn win_minus">勝ち-1</div>
              </div>
              <div class = "controll">
                <div class = "S-btn lose_plus">負け+1</div>
                <div class = "S-btn lose_minus">負け-1</div>
              </div>
              <div class = "S-btn reset">リセット</div>
            </div>
          </div>
          <div class = "detail">
            <h3>代表デッキ</h3>
            <input class = "border">
            <input class = "border">
            <h3>メモ</h3>
            <textarea class = "memo border"></textarea>

          </div>
        </div>
        <?php endforeach ?>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/deck_data.js"></script>
  </body>
</html>
