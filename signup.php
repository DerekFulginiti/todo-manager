<?php

include_once "controller.php";
// base URL name for form validation logic
$page = basename($_SERVER['PHP_SELF']);

// form logic sent to controller
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  Controller::validateForm($page);
}

$html = <<<HTML
    <section class="signup-wrapper">
      <h1>Sign up!</h1>
      <form class="signup" id="signup" action="signup.php" method="POST">
        <div class="form">
          <div class="field">
            <input name="full-name" id="full-name" type="text" required maxlength="50" placeholder="Full name" autocomplete="off" value="" />
          </div>
          <div class="field">
            <input name="email" id="email" type="email" required placeholder="Email" autocomplete="off" value="" />
          </div>
          <div class="field">
            <input name="phone" id="phone" type="text" required placeholder="Phone" length="10" autocomplete="off" value="" pattern="(?[0-9]{3})?-?[0-9]{3}-?[0-9]{4}" />
          </div>
          <div class="field">
            <input name="password" id="password" type="password" required placeholder="Password" minlength="6" autocomplete="off" value="" />
          </div>
          <div class="signup-button">
            <input class="signup-button" id="submit-button" type="submit" value="Sign Up" />
          </div>
        </div>
      </form>
      <div class="login-prompt">
        <span>Already have an account? <a href="index.php">Log in!</a></span>
      </div>
    </section>
HTML;

Controller::loadView($html);
