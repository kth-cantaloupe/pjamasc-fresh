<?php
class Info {
  public $id, $title, $value, $weight;

    /**
     * Info constructor.
     * @param $row Array of values for the info (id, title, value and weight)
     */
  public function __construct($row) {
    $this->id = $row['info_id'];
    $this->title = $row['info_title'];
    $this->value = $row['info_value'];
    $this->weight = $row['info_weight'];
  }
}
