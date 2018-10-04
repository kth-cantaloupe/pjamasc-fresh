<?php
class User {
  public $id, $email, $name, $orgName, $orgNo, $password, $type;

    /**
     * User constructor.
     * @param $row Array of values for the user (id, mail, full name, organization name, company number, password and user type.
     */
  public function __construct($row) {
    $this->id = $row['user_id'];
    $this->email = $row['user_email'];
    $this->name = $row['user_name'];
    $this->orgName = $row['user_org_name'];
    $this->orgNo = $row['user_org_no'];
    $this->password = $row['user_password'];
    $this->type = $row['user_type'];
  }

    /**
     * Verifies if entered password is correct.
     * @param $password - user password
     * @return bool - true if password matches, false if not
     */
  public function verifyPassword($password) {
    return password_verify($password, $this->password);
  }
}
