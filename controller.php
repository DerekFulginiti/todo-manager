<?php

class Controller {

  public static function loadView($content) {
    include_once "view.php";
    $page = new Page();
    $page->content = $content;
    $page->Display();
  }

  public static function validateForm($page) {
    $user_info = $_POST['user'];
    if($page == "signup.php") {
      foreach($user_info as $key => $val) {
        switch($val) {
          case "flname":
            // implement regex check
            break;
          case "email":
            // implement regex check
            break;
          case "phone":
            // implement regex check
            break;
          case "password":
            // implement regex check
            break;
          default:
            // probably throw custom exception here
            break;
        }
      }
    }else if($page == "index.php") {

    }
  }
}

?>
