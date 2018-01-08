<?php

include_once "controller.php";
// base URL name for form validation logic
$page = basename($_SERVER['PHP_SELF']);

// form logic sent to controller
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  Controller::validateForm($page);
}

$html = <<<HTML
		<section class="login-wrapper">
			<h1>Log In</h1>
			<form class="login" id="login" action="index.php" method="POST">
				<div class="form">
					<div class="field">
						<div class="sidetip">
							<p class="ok"></p>
							<p class="invalid"></p>
						</div>
						<input name="email" id="email" type="email" required placeholder="Email" autocomplete="off" value="" />
					</div>
					<div class="field">
						<div class="sidetip">
							<p class="ok"></p>
							<p class="invalid"></p>
						</div>
						<input name="password" id="password" type="password" required placeholder="Password" minlength="6" autocomplete="off" value="" />
					</div>
					<div class="login-button">
						<input class="login" id="submit-button" type="submit" value="Log In" />
					</div>
				</div>
			</form>
			<div class="signup-prompt">
				<span>Don't have an account? <a href="signup.php">Sign up</a></span>
			</div>
		</section>
HTML;

// display page
Controller::loadView($html);
