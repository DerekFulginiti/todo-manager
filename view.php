<?php

class Page {
  public $content;
  public $title = 'To-Do List Management';
  public $keywords = 'To-Do List, List, Management';
  public $buttons = array( 'Home'     => 'home.php',
               'Contact'  => 'contact.php',
               'Services' => 'services.php',
               'Site Map' => 'map.php'

              );
  public function __set($name, $value) {
    $this->$name = $value;
  }

  public function Display() {
    $page = <<<HTML
    <!DOCTYPE html>
    <html>
      <head>
        {$this->DisplayMeta()}
        {$this->DisplayKeywords()}
        {$this->DisplayTitle()}
        {$this->DisplayStyles()}
      </head>
      <body>
        <div class="container">
          {$this->DisplayHeader()}
          {$this->content}
          {$this->DisplayFooter()}
          {$this->DisplayJS()}
        </div>
      </body>
    </html>
HTML;
    print $page;
  }

  public function DisplayMeta() {
    $meta = <<<HTML
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
HTML;
    return $meta;

  }

  public function DisplayTitle() {
    return '<title>' . $this->title . '</title>';
  }

  public function DisplayKeywords() {
    return '<meta name="keywords" content="' . $this->keywords . '" />';
  }

  public function DisplayStyles() {
    $styles = <<<HTML
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <!-- <link href="reset.css" rel="stylesheet" /> -->
    <link href="master.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lobster|Roboto:400,700" rel="stylesheet">
HTML;
    return $styles;
  }

  public function DisplayHeader() {
    $header = <<<HTML
      <header>
        <span>To-Do List Manager</span>
      </header>
HTML;
    return $header;
  }

  public function DisplayMenu($buttons) {
    // menu HTML goes here
  }

  public function IsURLCurrentPage($url) {
    if(strpos($_SERVER['PHP_SELF'], $url) === false)
      return false;
    else
      return true;
  }

  public function DisplayButton($width, $name, $url, $active = true) {
    if($active) {
      // button styling here
    }
    else {
      // no button HTML here
    }
  }

  public function DisplayFooter() {
    // footer HTML goes here
  }

  public function DisplayJS() {
    $html = <<<HTML
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    <script src="app.js"></script>
HTML;
  return $html;
  }
}

?>
