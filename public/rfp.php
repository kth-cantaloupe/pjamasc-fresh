<?php
require '../require.php';

if (!Authentication::admin()) {
  header('Location: index.php');
  exit;
}

$id = 0;

if (isset($_GET['id']))
  $id = intval($_GET['id']);

$file = '../storage/rfp/' . $id . '.pdf';

if (file_exists($file)) {
  header('Content-Type: application/pdf');
  readfile($file);
}

header('HTTP/1.1 404 Not Found');
header('Content-Type: text/plain');
echo 'The requested RFP does not exist.';
