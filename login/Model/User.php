<?php

require_once('Model.php');
require_once("Exception/DuplicateEmail.php");
require_once('Exception/UnmatchEmailOrPassword.php');

class User extends Model{
  public function create($values){
    $stmt = $this->db->prepare('insert into users (name,password,created,modified)values(:name,:password,now(),now())');
    $res = $stmt->execute([
      ':name'=>$values['email'],
      ':password'=>password_hash($values['password'],PASSWORD_DEFAULT),
    ]);
    if($res === false){
      throw new \MyApp\Exception\DuplicateEmail();
    }
  }

  public function login($values){
    $stmt = $this->db->prepare('select * from users where name = :email');
    $stmt->execute([
      ':email'=>$values['email']
    ]);
    $stmt->setFetchMode(\PDO::FETCH_CLASS,'stdClass');
    $user = $stmt->fetch();

    if (empty($user)){
      throw new \MyApp\Exception\UnmatchEmailOrPassword();
    }

    if (!password_verify($values['password'],$user->password)){
      throw new \MyApp\Exception\UnmatchEmailOrPassword();
    }

    return $user;
  }

  public function findAll() {
    $stmt = $this->db->query("select * from users order by id");
    $stmt->setFetchMode(\PDO::FETCH_CLASS, 'stdClass');
    return $stmt->fetchAll();
  }
}
