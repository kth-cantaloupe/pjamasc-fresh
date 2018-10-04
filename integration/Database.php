<?php
class Database {
  private static $instance;
  private $mysqli;

    /**
     * Database constructor. Sets up connection to db and sets appropriate settings.
     */
  public function __construct() {
    $this->mysqli = new mysqli('localhost', 'pjamasc', 'f2msaS9QKyplfwOh', 'pjamasc');
    $this->mysqli->set_charset('utf8');
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  }

    /**
     * @param $id Id of user
     * @return null|User The user DTO with the given id, if exists. Otherwise null.
     */
  public function getUserById($id) {
    $stmt = $this->mysqli->prepare('SELECT * FROM user WHERE user_id = ?');
    $stmt->bind_param('i', $id);

    return $this->getUserByStmt($stmt);
  }

    /**
     * @param $email of the user
     * @return null|User The user DTO with the given email, if exists. Otherwise null.
     */
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

    /**
     * @return array with all info from the info table.
     */
  public function getAllInfo() {
    $stmt = $this->mysqli->prepare('SELECT * FROM info ORDER BY info_weight ASC');
    $stmt->execute();
    $res = $stmt->get_result();

    $info = [];
    while ($row = $res->fetch_array(MYSQLI_ASSOC))
      $info[] = new Info($row);

    return $info;
  }

    /**
     * @return array containing all products.
     */
    public function getAllProducts() {
        $stmt = $this->mysqli->prepare('SELECT * FROM product ORDER BY product_name ASC');
        $stmt->execute();
        $res = $stmt->get_result();

        $products = [];
        while ($row = $res->fetch_array(MYSQLI_ASSOC))
            $products[] = new Product($row);

        return $products;
    }

    /**
     * @param $id
     * @return null|Product Returns the product with the given id, otherwise null.
     */
    public function getProductById($id) {
        $stmt = $this->mysqli->prepare('SELECT * FROM product WHERE product_id = ?');
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($row = $res->fetch_array(MYSQLI_ASSOC))
            return new Product($row);

        return null;
    }

    /**
     * @param $product products containing the reviews
     * @return array containing all the reviews for the given product.
     */
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

    /**
     * @return array containing all RFPs
     */
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

    /**
     * @param null $year year of events, optional
     * @param null $month month of events, optional
     * @return array containing the events with the constraints
     */
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

  function getPendingUsers(){
    $stmt = $this->mysqli->prepare('SELECT * FROM user WHERE user_type = \'unconfirmed_customer\'');
    $stmt->execute();
    $result = $stmt->get_result();

    $pendingUsers = [];
    while ($row = $result->fetch_array(MYSQLI_ASSOC)){
      $pendingUsers[] = new User($row);
    }
    return $pendingUsers;
  }

    /**
     * @param $info id of the info to be updated
     * @param $value new info to replace the old info.
     */
  public function updateInfo($info, $value) {
    $stmt = $this->mysqli->prepare('UPDATE info SET info_value = ? WHERE info_id = ?');
    $stmt->bind_param('si', $value, $info);
    $stmt->execute();
  }

    /**
     * @param $author id of the author
     * @param $product id of the product reviewed
     * @param $rating rating of review
     * @param $comment the comment written in the review
     * @return bool whether the query succeeded
     */
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

    /**
     * @param $userid id of user creating the rfp
     * @param $notes notes/description of the rfp
     * @return mixed id of the created rfp
     */
  public function storeRFP($userid, $notes){
    $stmt = $this->mysqli->prepare('INSERT INTO rfp (rfp_owner, rfp_notes) VALUES (?, ?)');
    $stmt->bind_param('is', $userid, $notes);
    $stmt->execute();
    return $this->mysqli->insert_id;
  }

    /**
     * @param $emailaddress email of the new user
     * @param $fullname full name of the new user
     * @param $companyname company which the new user represents
     * @param $companyno company number
     * @param $hashedpassword the hashed password
     * @param $type the user type (admin, customer etc)
     * @return bool|mixed false if query failed, otherwise the auto_increment id
     */
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

    /**
     * @param $userId the user id to be confirmed
     */
  function confirmUser($userId){
    $stmt = $this->mysqli->prepare('UPDATE user SET user_type = \'customer\'WHERE user_id = ?');
    $stmt->bind_param('i', $userId);
    $stmt->execute();
  }

    /**
     * @return Database connection singleton instance
     */
  public static function getInstance() {
    if (self::$instance == null)
      self::$instance = new Database();

    return self::$instance;
  }
}
