<?php
  require_once('config.php');
  require_once('function.php');

  class DB {
    private $_db;

    private $deckdatas;

    // construct で　$_db　に　MySQL　のデータベースを格納していく
    public function __construct(){
      try{
        $this->_db = new PDO(DSN,DB_USERNAME,DB_PASSWORD);
        $this->_db ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      }catch(PDOException $e){
        echo $e->getmessage();
        exit;
      }
    }

    public function getLeader(){
      $stmt1 = $this->_db->query('select * from leader') ;
      return $stmt1->fetchAll(PDO::FETCH_OBJ);
    }

    public function getType(){
      $stmt2 = $this->_db->query('select * from types');
      return $stmt2->fetchAll(PDO::FETCH_OBJ);
    }

    public function getDeck($user_Id){
      $stmt = $this->_db->prepare('select * from deck_data where userid = ?');
      $stmt->execute([$user_Id]);
      return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getDeck2(){
      $stmt = $this->_db->query('select * from deck_data order by rand() limit 7');
      return $stmt->fetchAll(PDO::FETCH_OBJ);;
    }



    public function post(){
      switch ($_POST['mode']){
        case 'reg';
          return $this->registration();
        case 'del';
          return $this->delete();
      }
    }
    public function registration(){
      $sql =  "insert into deck_data(name,leader,type,url,userid) values (:name,:leader,:type,:url,:userid)";
      $stmt = $this->_db->prepare($sql);
      $stmt->execute([
        ':name'=>$_POST['name'],
        ':leader'=>$_POST['leader'],
        ':type'=>$_POST['type'],
        ':url'=>$_POST['url'],
        ':userid'=>$_SESSION['me']->id
      ]);

      $stmt2 = $this->_db->prepare("insert into fight(name,userid) values (:name,:userid)");
      $stmt2->execute([
        ':name'=>$_POST['name'],
        ':userid'=>$_SESSION['me']->id
      ]);

      $stmt3 = $this->_db->prepare("insert into victory(name,userid) values (:name,:userid)");
      $stmt3->execute([
        ':name'=>$_POST['name'],
        ':userid'=>$_SESSION['me']->id
      ]);

      return[
        'id' => $this->_db->lastInsertId()
      ];
    }

    public function delete(){
      $sql = "delete from deck_data where name = ? and userid = ?";
      $stmt = $this->_db->prepare($sql);
      $stmt->execute([$_POST['name'],$_SESSION['me']->id]);

      $sql = "delete from fight where name = ? and userid = ?";
      $stmt2 = $this->_db->prepare($sql);
      $stmt2->execute([$_POST['name'],$_SESSION['me']->id]);

      $sql = "delete from victory where name = ? and userid = ?";
      $stmt3 = $this->_db->prepare($sql);
      $stmt3->execute([$_POST['name'],$_SESSION['me']->id]);
    }



    public function scoring(){
      switch ($_POST['mode']){
        case 'w_plus';
          return $this->w_plus();
        case 'w_minus';
          return $this->w_minus();
        case 'l_plus';
          return $this->l_plus();
        case 'l_minus';
          return $this->l_minus();
        case 'reset';
          return $this->reset();
      }
    }
    public function w_plus(){
      $sql = "update fight set " . $_POST['leader'] . "= :win + 1 where name = :name";
      $stmt = $this->_db->prepare($sql);
      $stmt->execute([
        ':win'=>$_POST['win'],
        ':name'=>$_POST['name']
      ]);
    }
    public function w_minus(){
      $sql = "update fight set " . $_POST['leader'] . "= :win - 1 where name = :name";
      $stmt = $this->_db->prepare($sql);
      $stmt->execute([
        ':win'=>$_POST['win'],
        ':name'=>$_POST['name']
      ]);
    }
    public function l_plus(){
      $sql = "update victory set " . $_POST['leader'] . "= :win + 1 where name = :name";
      $stmt = $this->_db->prepare($sql);
      $stmt->execute([
        ':win'=>$_POST['win'],
        ':name'=>$_POST['name']
      ]);
    }
    public function l_minus(){
      $sql = "update victory set " . $_POST['leader'] . "= :win - 1 where name = :name";
      $stmt = $this->_db->prepare($sql);
      $stmt->execute([
        ':win'=>$_POST['win'],
        ':name'=>$_POST['name']
      ]);
    }
    public function reset(){
      $sql = "update fight set " . $_POST['leader'] . "= 0 where name = :name";
      $stmt = $this->_db->prepare($sql);
      $stmt->execute([
        ':name'=>$_POST['name']
      ]);
      $sql = "update victory set " . $_POST['leader'] . "= 0 where name = :name";
      $stmt = $this->_db->prepare($sql);
      $stmt->execute([
        ':name'=>$_POST['name']
      ]);
    }

    public function findDeckData($name){
      $stmt4 = $this->_db->prepare('select * from deck_data join leader on  deck_data.leader = leader.character_name where deck_data.name = ?');
      $stmt4->execute([$name]);
      return $stmt4->fetchAll(PDO::FETCH_OBJ);
    }


    public function getFight($leader,$name){
      $stmt5 = $this->_db->prepare('select ' .$leader. ' from fight where name= ?');
      $stmt5->execute([$name]);
      return $stmt5->fetch();
    }

    public function getVictory($leader,$name){
      $stmt6 = $this->_db->prepare('select ' .$leader. ' from victory where name= ?');
      $stmt6->execute([$name]);
      return $stmt6->fetch();
    }

    public function mathmatic($name){
      $stmt1 = $this->_db->prepare('select * from fight where name= ?');
      $stmt1 -> execute([$name]);
      $deck_data1 = $stmt1->fetch(PDO::FETCH_OBJ);
      // return $stmt1->fetchAll(PDO::FETCH_OBJ);
      // return $deck_data1;
      $stmt2 = $this->_db->prepare('select * from victory where name= ?');
      $stmt2 -> execute([$name]);
      $deck_data2 = $stmt2->fetch(PDO::FETCH_OBJ);
      // return $stmt2->fetchAll(PDO::FETCH_OBJ);
      $percentage = [0,0,0,0,0,0,0,0,0,0];
      $percentage[0] = round($deck_data1->テリー / ($deck_data1->テリー + $deck_data2->テリー) * 100);
      // $percentage[0] = 100;
      $percentage[1] = round($deck_data1->ゼシカ / ($deck_data1->ゼシカ + $deck_data2->ゼシカ) * 100);
      $percentage[2] = round($deck_data1->アリーナ / ($deck_data1->アリーナ + $deck_data2->アリーナ) * 100);
      $percentage[3] = round($deck_data1->ククール / ($deck_data1->ククール + $deck_data2->ククール) * 100);
      $percentage[4] = round($deck_data1->トルネコ / ($deck_data1->トルネコ + $deck_data2->トルネコ) * 100);
      $percentage[5] = round($deck_data1->ミネア / ($deck_data1->ミネア + $deck_data2->ミネア) * 100);
      $percentage[6] = round($deck_data1->ピサロ / ($deck_data1->ピサロ + $deck_data2->ピサロ) * 100);
      $percentage[7] = $deck_data1->テリー + $deck_data1->ゼシカ + $deck_data1->アリーナ + $deck_data1->ククール + $deck_data1->トルネコ + $deck_data1->ミネア + $deck_data1->ピサロ;
      $percentage[8] = $deck_data2->テリー + $deck_data2->ゼシカ + $deck_data2->アリーナ + $deck_data2->ククール + $deck_data2->トルネコ + $deck_data2->ミネア + $deck_data2->ピサロ;
      $percentage[9] = round($percentage[7] / ($percentage[7] + $percentage[8]) * 100);
      return $percentage;
    }

    // public function findLeader($datas,$leader){
    //   f
    // }

  }
