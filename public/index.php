<?php
require '../require.php';
// renders layout of highlighted item
Template::render('index.tpl', [
  'highlightedMenuItem' => 'index',
  'today' => date('Y-m-d')
]);
