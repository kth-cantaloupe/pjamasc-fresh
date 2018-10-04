<?php
require '../require.php';

$product = Database::getInstance()->getProductById($_GET["id"]);
$reviews = Database::getInstance()->getReviewsByProduct($product->id);

if(isset($_POST["comment"])) {
    Database::getInstance()->insertProductReview($_POST["author"], $_POST["product"], $_POST["rating"], $_POST["comment"]);
}


Template::render('product.tpl', [
    'highlightedMenuItem' => 'product_list',
    'product' => $product,
    'reviews' => $reviews
]);
