<?php
require '../require.php';
// Updates about us info on post request
if (isset($_POST['id']) && isset($_POST['value'])) {
  if (Authentication::admin()) {
    Database::getInstance()->updateInfo($_POST['id'], $_POST['value']);
  }
}

// Fetches about us text
$info = Database::getInstance()->getAllInfo();

// renders layout
Template::render('about.tpl', [
  'highlightedMenuItem' => 'about',
  'info' => $info
]);
