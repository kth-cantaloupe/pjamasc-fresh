<?php
require '../require.php';

// redirects if not logged in as admin
if (!Authentication::admin()) {
  header('Location: index.php');
  exit;
}

$id = 0;

// Downloads rfp
if (isset($_GET['id']))
  $id = intval($_GET['id']);

$mode = 'view';
if (isset($_GET['mode']))
  $mode = $_GET['mode'];

$file = '../storage/rfp/' . $id . '.pdf';

if (file_exists($file)) {
  header('Content-Type: application/pdf');
  if ($mode === 'download')
    header('Content-Disposition: attachment; filename="RFP-'.$id.'.pdf"');
  readfile($file);
}

header('HTTP/1.1 404 Not Found');
header('Content-Type: text/plain');
echo 'The requested RFP does not exist.';
