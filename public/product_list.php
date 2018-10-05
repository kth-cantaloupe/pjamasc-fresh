<?php
require '../require.php';

$products = Database::getInstance()->getAllProducts();

Template::render('product_list.tpl', [
  'highlightedMenuItem' => 'product_list',
  'products' => $products
]);
