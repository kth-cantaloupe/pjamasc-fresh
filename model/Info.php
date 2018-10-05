<?php
class Info {
  public $id, $title, $value, $weight;

  public function __construct($row) {
    $this->id = $row['info_id'];
    $this->title = $row['info_title'];
    $this->value = $row['info_value'];
    $this->weight = $row['info_weight'];
  }
}
