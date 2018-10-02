<?php
class RFP {
  public $id, $owner, $notes, $creation;

  public function __construct($row) {
    $this->id = $row['rfp_id'];
    $this->owner = $row['rfp_owner'];
    $this->notes = $row['rfp_notes'];
    $this->creation = $row['rfp_creation'];
  }
}
