<?php
require '../require.php';

Template::render('index.tpl', [
  'today' => date('Y-m-d')
]);
