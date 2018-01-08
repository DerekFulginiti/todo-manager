<?php

class Controller {

	public static function main() {
		include_once "view.php";
		$content = <<<HTML
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
		$page = new Page();
		$page->content = $content;
		$page->Display();
	}
}

Controller::main();
