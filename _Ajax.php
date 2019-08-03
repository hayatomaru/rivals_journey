<?php
// Ajaxの処理を行っているファイル。インスタンスの一部になるため、しっかりとモデルファイルと繋ごう
require_once('config.php');
require_once('function.php');
require_once('management.php');

$ajax_processing = new DB();
//
// ini_set('display_errors',1);

//今回はmanagementクラスのインスタンスを作って、post()というメソッドを呼び出す処理を書いている

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    header('Content-Type: application/json');
    $deck_data_list = [
      "id" => filter_input(INPUT_POST,"id"),
      "name" => filter_input(INPUT_POST,"name"),
      "leader" => filter_input(INPUT_POST,"leader"),
      "type" => filter_input(INPUT_POST,"type"),
      "url" => filter_input(INPUT_POST,"url"),
    ];

    $ajax_processing->post();

    // echo $this->request->is(['ajax']);
    echo json_encode($deck_data_list);
    exit;
  } catch (Exception $e) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    echo $e->getMessage();
    exit;
  }
}
