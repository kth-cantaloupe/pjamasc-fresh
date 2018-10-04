<?php
class Database {
  private static $instance;
  private $mysqli;

  public function __construct() {
    $this->mysqli = new mysqli('localhost', 'pjamasc', 'f2msaS9QKyplfwOh', 'pjamasc');
    $this->mysqli->set_charset('utf8');
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
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
    $stmt = $this->mysqli->prepare('SELECT * FROM rfp INNER JOIN user ON rfp_owner = user_id ORDER BY rfp_creation DESC');
    $stmt->execute();
    $res = $stmt->get_result();

    $rfps = [];
    while ($row = $res->fetch_array(MYSQLI_ASSOC)){
      $rfp = new RFP($row);
      $rfp->owner = new User($row);
      $rfps[] = $rfp;
    }

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
      try {
          $stmt = $this->mysqli->prepare('INSERT INTO review 
                (review_author, review_product, review_creation, review_rating, review_comment) 
                VALUES (?, ?, CURRENT_TIMESTAMP, ?, ?)');
          $stmt->bind_param('iiis', $author, $product, $rating, $comment);
          $stmt->execute();
          return true;
      } catch (Exception $e) {
          return false;
      }
  }

  public function storeRFP($userid, $notes){
    $stmt = $this->mysqli->prepare('INSERT INTO rfp (rfp_owner, rfp_notes) VALUES (?, ?)');
    $stmt->bind_param('is', $userid, $notes);
    $stmt->execute();
    return $this->mysqli->insert_id;
  }

  public function addUser($emailaddress, $fullname, $companyname, $companyno, $hashedpassword, $type){
    try {
      $stmt = $this->mysqli->prepare('INSERT INTO user (user_email, user_name, user_org_name, user_org_no, user_password, user_type) VALUES (?, ?, ?, ?, ?, ?)');
      $stmt->bind_param('ssssss', $emailaddress, $fullname, $companyname, $companyno, $hashedpassword, $type);
      $stmt->execute();
    } catch (Exception $e){
        if($this->mysqli->errno === 1062)
          return false;
    }
    return $this->mysqli->insert_id;
  }


  public static function getInstance() {
    if (self::$instance == null)
      self::$instance = new Database();

    return self::$instance;
  }
}
