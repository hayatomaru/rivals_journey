<?php

require_once('../login/Controller.php');
require_once('../login/Model/User.php');

class Login extends Controller {

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
    try{
      $this->_validate();
    }catch(\MyApp\Exception\EmptyPost $e){
      $this->setErrors('login', $e->getMessage());
    }

    $this->setValues('email', $_POST['email']);

    if($this->hasError()){
      return;
    }else{
      try{
        $userModel = new User();
        $user = $userModel->login([
          'email'=>$_POST['email'],
          'password'=>$_POST['password']
        ]);
      }catch(\MyApp\Exception\UnmatchEmailOrPassword $e){
        $this->setErrors('login',$e->getMessage());
        return;
      }

      session_regenerate_id(true);
      $_SESSION['me'] = $user;

      // var_dump($_SESSION['me']);
      //
      // exit;

      header('Location:../../mypage/mypage.php');
      exit;
    }
  }

  private function _validate(){

    if(!isset($_POST['email']) || !isset($_POST['password'])){
      echo "Invalid Form!";
      exit;
    }


    if($_POST['email'] === '' || $_POST['password'] === ''){
      throw new \MyApp\Exception\EmptyPost();
    }
  }

}
