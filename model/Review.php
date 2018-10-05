<?php
class Review {
  public $author, $product, $creation, $rating, $comment;

    /**
     * Review constructor.
     * @param $row Array of values for a review (author, product, creation date, rating and comment
     */
  public function __construct($row) {
    $this->author = $row['review_author'];
    $this->product = $row['review_product'];
    $this->creation = $row['review_creation'];
    $this->rating = $row['review_rating'];
    $this->comment = $row['review_comment'];
  }
}
