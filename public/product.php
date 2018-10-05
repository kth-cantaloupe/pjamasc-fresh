<?php
require '../require.php';

// Gather data to be rendered in the view.
$product = Database::getInstance()->getProductById($_GET["id"]);
$reviews = Database::getInstance()->getReviewsByProduct($product->id);

// If this document is executed when review is posted make database call and return whether it succeeded.
if(isset($_POST["comment"])) {
    $success = Database::getInstance()->insertProductReview($_POST["author"], $_POST["product"], $_POST["rating"], $_POST["comment"]);
    header('Content-Type: application/json');

    if($success)
        echo json_encode(['status' => 'success']);
    else
        echo json_encode(['status' => 'failed']);

    exit;
}

// Render html
Template::render('product.tpl', [
    'highlightedMenuItem' => 'product_list',
    'product' => $product,
    'reviews' => $reviews
]);
