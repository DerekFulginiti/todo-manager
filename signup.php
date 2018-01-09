<?php

include_once "controller.php";
$page = basename($_SERVER['PHP_SELF']);
$name_err, $email_err, $phone_err, $pass_err;

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	switch(Controller::validateForm($page)) {
		case 1:
			break;
		case 2:
			break;
		case 3:
			break;
		case 4:
			break;
		case 5:
			break;
		default:
			break;
	}
}

$html = <<<HTML
  <section class="signup-wrapper">
    <h1>Sign up</h1>
    <form class="login needs-validation" id="signup" action="" method="POST" novalidate>
     <div class="form-group">
      <div class="vfb" id="flname-vfb">
      </div>
      <label class="sr-only" for="flname">Full Name</label>
      <input type="text" class="form-control" name="user[flname]" id="flname" required placeholder="Full Name" autocomplete="off" value="" />
    </div>
    <div class="form-group">
      <div class="vfb" id="email-vfb">
      </div>
      <label class="sr-only" for="email">Email</label>
      <input type="email" class="form-control" name="user[email]" id="email" required placeholder="Email" autocomplete="off" value="" />
    </div>
    <div class="form-group">
      <div class="vfb" id="phone-vfb">
      </div>
      <label class="sr-only" for="phone">Phone Number</label>
      <input type="text" class="form-control" name="user[phone]" id="phone" required placeholder="Phone Number" autocomplete="off" value="" />
    </div>
    <div class="form-group">
      <div class="vfb" id="password-vfb">
      </div>
      <label class="sr-only" for="password">Password</label>
      <input type="password" class="form-control" name="user[password]" id="password" required placeholder="Password" minlength="6" autocomplete="off" value="" />
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
