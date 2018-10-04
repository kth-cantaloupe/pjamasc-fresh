<?php
class RFP {
  public $id, $owner, $notes, $creation;

    /**
     * RFP constructor.
     * @param $row Array of values for the RFP (id, owner, notes and creation date)
     */
  public function __construct($row) {
    $this->id = $row['rfp_id'];
    $this->owner = $row['rfp_owner'];
    $this->notes = $row['rfp_notes'];
    $this->creation = $row['rfp_creation'];
  }
}
