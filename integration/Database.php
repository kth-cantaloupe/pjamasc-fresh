<?php
class Database {
  private static $instance;
  private $mysqli;

  public function __construct() {
    $this->mysqli = new mysqli('localhost', 'pjamasc', 'f2msaS9QKyplfwOh', 'pjamasc');
  }

  public function getUserByEmail($email) {
    $stmt = $this->mysqli->prepare('SELECT * FROM user WHERE user_email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_array(MYSQLI_ASSOC))
      return new User($row);

    return null;
  }

  public function getAllInfo() {
    $stmt = $this->mysqli->prepare('SELECT * FROM info ORDER BY info_weight ASC');
    $stmt->execute();
    $res = $stmt->get_result();

    $info = [];
    while ($row = $res->fetch_array(MYSQLI_ASSOC))
      $info[] = new Info($row);

    return $info;
  }

  public function getAllProducts() {
    $stmt = $this->mysqli->prepare('SELECT * FROM product ORDER BY product_name ASC');
    $stmt->execute();
    $res = $stmt->get_result();

    $products = [];
    while ($row = $res->fetch_array(MYSQLI_ASSOC))
      $products[] = new Product($row);

    return $products;
  }

  public function getReviewsByProduct($product) {
    $stmt = $this->mysqli->prepare('SELECT * FROM review WHERE review_product = ? ORDER BY review_creation DESC');
    $stmt->execute();
    $res = $stmt->get_result();

    $reviews = [];
    while ($row = $res->fetch_array(MYSQLI_ASSOC))
      $reviews[] = new Review($row);
  }

  public function getAllRFPs() {
    $stmt = $this->mysqli->prepare('SELECT * FROM rfp ORDER BY rfp_creation DESC');
    $stmt->execute();
    $res = $stmt->get_result();

    $rfps = [];
    while ($row = $res->fetch_array(MYSQLI_ASSOC))
      $rfps[] = new RFP($row);

    return $rfps;
  }

  public function getInstance() {
    if (self::$instance == null)
      self::$instance = new Database();

    return self::$instance;
  }
}
