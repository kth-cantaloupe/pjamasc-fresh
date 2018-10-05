<?php
require '../require.php';

if (!Authentication::admin()) {
	header('Location: product_list.php');
	exit;
}

Template::render('add_product.tpl', [
  'highlightedMenuItem' => 'product_list'
]);
