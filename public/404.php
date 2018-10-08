<?php
require '../require.php';

Template::render('error.tpl', [
  'errorTitle' => '404: Not Found',
  'errorDescription' => 'The requested resource could not be found.'
]);
