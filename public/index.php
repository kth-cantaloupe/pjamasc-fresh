<?php
require '../require.php';

Template::render('index.tpl', [
  'highlightedMenuItem' => 'index',
  'today' => date('Y-m-d')
]);
