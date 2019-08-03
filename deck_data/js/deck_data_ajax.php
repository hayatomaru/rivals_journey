<?php

require_once('../../config.php');
require_once('../../management.php');

$ajax_processing = new DB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    header('Content-Type: application/json');
    $deck_data_list = [
      'name' => filter_input(INPUT_POST,"name"),
      'leader' => filter_input(INPUT_POST,"leader"),
      "win" => filter_input(INPUT_POST,"win"),
      "mode" => filter_input(INPUT_POST,"mode")
    ];

    $ajax_processing->scoring();

    echo json_encode($deck_data_list);
    exit;
  } catch (Exception $e) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    echo $e->getMessage();
    exit;
  }
}

// echo htmlspecialchars("you win" . $_POST['win'], ENT_QUOTES, "utf-8");
