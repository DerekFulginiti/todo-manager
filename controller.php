<?php

class Controller {

	public static $first_name = "";
	public static $last_name = "";
	public static $hash = "";

  public static function main($html) {
    include_once "view.php";
    $content = $html;
    $page = new Page();
    $page->content = $content;
    $page->Display();
  }

  public static function validateForm($page) {
  // logic for form submission
    $user_info = $_POST['user'];
    if($page == "signup.php") {
      foreach($user_info as $key => $val) {
        $val = strtolower(trim($val));
        switch($key) {
          case "flname":
            if($name_arr = self::validateName($val)) {
              // echo "first name is $first_name and last name is $last_name";
              $first_name = $name_arr[0];
              $last_name = $name_arr[1];
            } else {
              // error has occurred
              return 1;
            }
            break;
          case "email":
             if(self::validateEmail($val)) {
              // echo "email is $val";
             } else {
              return 2;
              // no match or error has occurred
             }
            break;
          case "phone":
            if(self::validatePhone($val)) {
              // echo "phone number is $val";
            } else {
              return 3;
            }
            break;
          case "password":
            if(self::validatePassword($val)) {
              // echo "password is $val";
              if(self::encryptPassword($val) === FALSE)
              	return 4;
            } else {
              return 4;
            }
            break;
          default:
              return 5;
              break;
        }
      }
    }else if($page == "index.php") {
    	foreach($user_info as $key => $val) {
        $val = strtolower(trim($val));
        switch($key) {
          case "email":
             if(self::validateEmail($val)) {
              // echo "email is $val";
             } else {
              return 1;
              // no match or error has occurred
             }
            break;
          case "password":
            if(self::validatePassword($val)) {
              // echo "password is $val";
              if(self::encryptPassword($val) === FALSE)
              	return 2;
            } else {
              return 2;
            }
            break;
          default:
              return 3;
              break;
        }
      }
    }
  }

  private static function validateName($name) {
    $pattern = '/^([a-z]{1,20}) ([a-z]{1,20})$/';
    if(preg_match($pattern, $name, $matches)) {
    	self::$first_name = $matches[1];
    	self::$last_name = $matches[2];
      return Array($matches[1], $matches[2]);
    }else {
      // no match or error has occurred
      return FALSE;
    }
  }

  private static function validateEmail($email) {
    $pattern = '/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';
    if(preg_match($pattern, $email, $matches)) {
      return $matches[0];
    }else {
      // no match or error has occurred
      return FALSE;
    }
  }

  private static function validatePhone($phone) {
    $pattern = '/^\(?[0-9]{3}\)?\-?[0-9]{3}\-?[0-9]{4}$/';
    return preg_match($pattern, $phone);
  }

  private static function validatePassword($password) {
    $pattern = '/^([^ ]){6,20}$/';
    return preg_match($pattern, $password);
  }

  public static function encryptPassword($password) {
  	return password_hash($password, PASSWORD_DEFAULT);
  }

  public static function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
  }
}

?>
