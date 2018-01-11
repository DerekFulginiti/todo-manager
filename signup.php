<?php

require_once "mysql_connect.php"; // $db contains connection
require_once "controller.php";
$page = basename($_SERVER['PHP_SELF']);
$full_name = $email = $phone = $password = $name_err = $email_err = $phone_err = $pass_err = $form_ret = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$full_name = $_POST['user']['flname'];
	$email = $_POST['user']['email'];
	$phone = $_POST['user']['phone'];
	$password = $_POST['user']['password'];
	switch(Controller::validateForm($page)) {
		case 1: //name error
			$name_err = "<p class='invalid'>Ex: Frodo Baggins</p>";
			break;
		case 2: // email error
			$email_err = "<p class='invalid'>Ex: gandalfthewhite@gmail.com</p>";
		case 3: // phone error
			break;
			$phone_err = "<p class='invalid'>Ex: (999)-999-9999.</p>";
			break;
		case 4: // password error
			$pass_err = "<p class='invalid'>6-20 characters without spaces.</p>";
			break;
		case 5: // unknown error
			$form_ret = "An unknown error has occurred. Please try again.";
			break;
		default: // no errors have occurred
			$name_err = $email_err = $phone_err = $pass_err = "<p class='ok'>Valid</p>";
			$first_name = Controller::$first_name;
			$last_name = Controller::$last_name;
			$hash = Controller::encryptPassword($password);
			$sql = "SELECT 1 FROM user WHERE email = ?";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(1, $email, PDO::PARAM_STR);
			$stmt->execute();
			if($stmt->fetchColumn() === FALSE) {
				// user does not exist
				$sql = "INSERT INTO user (first_name, last_name, email, phone, password, verified) VALUES (:first_name, :last_name, :email, :phone, :hash, 0)";
				$stmt = $db->prepare($sql);
				$stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
				$stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
				$stmt->bindParam(":email", $email, PDO::PARAM_STR);
				$stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
				$stmt->bindParam(":hash", $hash, PDO::PARAM_STR);
				if($stmt->execute()) {
					// user entered successfully
					// print "user entered!!";
				} else {
					// db error occurred
					$form_ret = "An unknown error has occurred. Please try again.";
					break;
				}
			} else {
				// user already exists
				$form_ret = "A user with that email already exists.";
			}
			break;

	}
}

$html = <<<HTML
  <section class="signup-wrapper">
    <h1>Sign up</h1>
    <p class="invalid">$form_ret</p>
    <form class="login needs-validation" id="signup" action="" method="POST" novalidate>
     <div class="form-group">
      <div class="vfb" id="flname-vfb">
      	$name_err
      </div>
      <label class="sr-only" for="flname">Full Name</label>
      <input type="text" class="form-control" name="user[flname]" id="flname" required placeholder="Full Name" autocomplete="off" value="$full_name" />
    </div>
    <div class="form-group">
      <div class="vfb" id="email-vfb">
      	$email_err
      </div>
      <label class="sr-only" for="email">Email</label>
      <input type="email" class="form-control" name="user[email]" id="email" required placeholder="Email" autocomplete="off" value="$email" />
    </div>
    <div class="form-group">
      <div class="vfb" id="phone-vfb">
      	$phone_err
      </div>
      <label class="sr-only" for="phone">Phone Number</label>
      <input type="text" class="form-control" name="user[phone]" id="phone" required placeholder="Phone Number" autocomplete="off" value="$phone" />
    </div>
    <div class="form-group">
      <div class="vfb" id="password-vfb">
      	$pass_err
      </div>
      <label class="sr-only" for="password">Password</label>
      <input type="password" class="form-control" name="user[password]" id="password" required placeholder="Password" minlength="6" autocomplete="off" value="$password" />
    </div>
    <div class="signup-button">
      <input class="btn btn-primary btn-block" id="submit-button" type="submit" value="Sign Up" disabled />
    </div>
    </form>
    <div class="login-prompt">
    <span>Already have an account? <a href="index.php">Log in!</a></span>
    </div>
  </section>
HTML;

Controller::main($html);

?>
