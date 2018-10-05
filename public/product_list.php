<?php
require '../require.php';

// Fetches all products
$products = Database::getInstance()->getAllProducts();

// Renders layout
Template::render('product_list.tpl', [
  'highlightedMenuItem' => 'product_list',
  'products' => $products
]);
