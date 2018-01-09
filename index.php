<?php

class Controller {

	public static function main() {
		include_once "view.php";
		$content = <<<HTML
		<section class="login-wrapper">
			<h1>Log In</h1>
			<form class="login needs-validation" id="login" action="index.php" method="POST" novalidate>
				<div class="form-group">
					<div class="vfb" id="email-vfb">
					</div>
					<label class="sr-only" for="email">Email</label>
					<input type="email" class="form-control" name="email" id="email" required placeholder="Email" autocomplete="off" value="" />
				</div>
				<div class="form-group">
					<div class="vfb" id="password-vfb">
					</div>
					<label class="sr-only" for="password">Password</label>
					<input type="password" class="form-control" name="password" id="password" required placeholder="Password" minlength="6" autocomplete="off" value="" />
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
		$page = new Page();
		$page->content = $content;
		$page->Display();
	}
}

Controller::main();
