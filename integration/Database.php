<?php
class Database {
  private static $instance;
  private $mysqli;

  public function __construct() {
    $this->mysqli = new mysqli('localhost', 'pjamasc', 'f2msaS9QKyplfwOh', 'pjamasc');
    $this->mysqli->set_charset('utf8');
  }

  public function getUserById($id) {
    $stmt = $this->mysqli->prepare('SELECT * FROM user WHERE user_id = ?');
    $stmt->bind_param('i', $id);

    return $this->getUserByStmt($stmt);
  }

  public function getUserByEmail($email) {
    $stmt = $this->mysqli->prepare('SELECT * FROM user WHERE user_email = ?');
    $stmt->bind_param('s', $email);

    return $this->getUserByStmt($stmt);
  }

  private function getUserByStmt($stmt) {
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

    public function getProductById($id) {
        $stmt = $this->mysqli->prepare('SELECT * FROM product WHERE product_id = ?');
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($row = $res->fetch_array(MYSQLI_ASSOC))
            return new Product($row);

        return null;
    }

  public function getReviewsByProduct($product) {
    $stmt = $this->mysqli->prepare('SELECT * FROM review INNER JOIN user ON user_id = review_author WHERE review_product = ? ORDER BY review_creation DESC');
    $stmt->bind_param("i", $product);
    $stmt->execute();
    $res = $stmt->get_result();

    $reviews = [];
    while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
        $review = new Review($row);
        $review->author = new User($row);
        $reviews[] = $review;
    }

    return $reviews;
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

  public function getAllEvents($year = null, $month = null) {
    $sql = 'SELECT * FROM event';

    if ($year !== null && $month !== null)
      $sql .= ' WHERE YEAR(event_date) = ? AND MONTH(event_date) = ?';

    $sql .= ' ORDER BY event_date ASC';

    $stmt = $this->mysqli->prepare($sql);

    if ($year !== null && $month !== null)
      $stmt->bind_param('ii', $year, $month);

    $stmt->execute();
    $res = $stmt->get_result();

    $events = [];
    while ($row = $res->fetch_array(MYSQLI_ASSOC))
      $events[] = new Event($row);

    return $events;
  }

  public function updateInfo($info, $value) {
    $stmt = $this->mysqli->prepare('UPDATE info SET info_value = ? WHERE info_id = ?');
    $stmt->bind_param('si', $value, $info);
    $stmt->execute();
  }

  public function insertProductReview($author, $product, $rating, $comment) {
      $stmt = $this->mysqli->prepare('INSERT INTO review 
                (review_author, review_product, review_creation, review_rating, review_comment) 
                VALUES (?, ?, CURRENT_TIMESTAMP, ?, ?)');
      $stmt->bind_param('iiis', $author, $product, $rating, $comment);
      $stmt->execute();
  }

  public function getInstance() {
    if (self::$instance == null)
      self::$instance = new Database();

    return self::$instance;
  }
}
