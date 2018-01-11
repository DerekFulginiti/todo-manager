<?php

require_once "mysql_connect.php"; // $db contains connection
require_once "controller.php";
$page = basename($_SERVER['PHP_SELF']);
$email = $password = $form_ret = $email_err = $pass_err = "";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$email = trim($_POST['user']['email']);
	$password = trim($_POST['user']['password']);
	switch(Controller::validateForm($page)) {
		case 1: //email error
			$email_err = "<p class='invalid'>Ex: gandalfthewhite@gmail.com</p>";
			break;
		case 2: // pass error
			$pass_err = "<p class='invalid'>6-20 characters without spaces.</p>";
			break;
		case 3: // unknown error
			$form_ret = "An unknown error has occurred. Please try again.";
			break;
		default: // no errors have occurred
			$email_err = $pass_err = "<p class='ok'>Valid</p>";
			$sql = "SELECT password, verified FROM user WHERE email = ?";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(1, $email, PDO::PARAM_STR);
			$stmt->execute();
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			if($result === FALSE) { // user does not exist
				$form_ret = "A user with that email address does not exist.";
			} else { // user exists
				$hash = $result['password'];
				$verified = (int)$result['verified'];
				// verify password
				if(Controller::verifyPassword($password, $hash)) { // valid password
					// verified logic
					if($verified == 1) { // verified
						// jump to tasks page
					} else { // not verified
						$form_ret = "Your account has not yet been verified.";
					}
				} else { // invalid password
					$form_ret = "You have entered an invalid password.";
					break;
				}
			}
			break;

	}
}

$html = <<<HTML
		<section class="login-wrapper">
			<h1>Log In</h1>
			<p class="invalid">$form_ret</p>
			<form class="login needs-validation" id="login" action="index.php" method="POST" novalidate>
				<div class="form-group">
					<div class="vfb" id="email-vfb">
						$email_err
					</div>
					<label class="sr-only" for="email">Email</label>
					<input type="email" class="form-control" name="user[email]" id="email" required placeholder="Email" autocomplete="off" value="$email" />
				</div>
				<div class="form-group">
					<div class="vfb" id="password-vfb">
						$pass_err
					</div>
					<label class="sr-only" for="password">Password</label>
					<input type="password" class="form-control" name="user[password]" id="password" required placeholder="Password" minlength="6" autocomplete="off" value="$password" />
					<small class="form-text text-muted">Your password must be 6-20 characters and can contain any characters except spaces.</small>
				</div>
				<div class="login-button">
					<input class="btn btn-primary btn-block" id="submit-button" type="submit" value="Log In" disabled/>
				</div>
			</form>
			<div class="signup-prompt">
				<span class="text-muted">Don't have an account? <a href="signup.php">Sign up</a></span>
			</div>
		</section>
HTML;

Controller::main($html);
