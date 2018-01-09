<?php

class Controller {

  public static function main($html) {
    include_once "view.php";
    $content = $html;
    $page = new Page();
    $page->content = $content;
    $page->Display();
  }

  public static function validateForm($page) {
  // logic for form submission
    echo "A form has been submitted.";
    $user_info = $_POST['user'];
    if($page == "signup.php") {
      echo "inside of the signup form";
      foreach($user_info as $key => $val) {
        $val = trim($val);
        switch($key) {
          case "flname":
            break;
          case "email":
            break;
          case "phone":
            break;
          case "password":
            break;
          default:
              break;
        }
      }
    }else if($page == "index.php") {

    }
  }
}

?>
