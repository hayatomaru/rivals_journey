<?php

require_once('../config.php');
require_once('Controller.php');
require_once('Model/User.php');

class Signup extends Controller {

  public function run() {
    if ($this->isLoggedIn()) {
      // login
      header('Location: ' . SITE_URL);
      exit;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
      $this->postProcess();
    }
  }

  protected function postProcess(){
    //validate
    try{
      $this->_validate();
    }catch(\MyApp\Exception\InvalidEmail $e){
      // echo $e->getMessage();
      // exit;
      $this->setErrors('email', $e->getMessage());
    }catch(\MyApp\Exception\InvalidPassword $e){
      // echo $e->getMessage();
      // exit;
      $this->setErrors('password', $e->getMessage());
    }


    // echo "success";
    // exit;

    $this->setValues('email', $_POST['email']);

    if($this->hasError()){
      return;
    }else{
      try{
        $userModel = new User();
        $userModel->create([
          'email'=>$_POST['email'],
          'password'=>$_POST['password']
        ]);
      }catch(\MyApp\Exception\DuplicateEmail $e){
        $this->setErrors('email',$e->getMessage());
        return;
      }

      header('Location:' .SITE_URL );
      exit;
    }
  }

 // || $_POST['token'] !== $_SESSION['token'
  private function _validate(){
    if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
      throw new \MyApp\Exception\InvalidEmail();
    }
    if(!preg_match('/\A[a-zA-Z0-9]+\z/',$_POST['password'])){
      throw new \MyApp\Exception\InvalidPassword();
    }
  }

}
