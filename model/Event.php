<?php
class Event {
  public $date, $title;

  public function __construct($row) {
    $this->date = $row['event_date'];
    $this->title = $row['event_title'];
  }
}
