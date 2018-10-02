<?php
require '../require.php';

if (isset($_POST['id']) && isset($_POST['value'])) {
  if (Authentication::admin()) {
    Database::getInstance()->updateInfo($_POST['id'], $_POST['value']);
  }
}

$info = Database::getInstance()->getAllInfo();

Template::render('about.tpl', [
  'highlightedMenuItem' => 'about',
  'info' => $info
]);
