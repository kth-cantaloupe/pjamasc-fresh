<?php
class Product {
  public $id, $name, $description;

    /**
     * Product constructor.
     * @param $row - Array of values for the product (id, name and description)
     */
  public function __construct($row) {
    $this->id = $row['product_id'];
    $this->name = $row['product_name'];
    $this->description = $row['product_description'];
  }
}
