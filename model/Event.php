<?php
class Event {
  public $date, $title, $description;

  public function __construct($row) {
    $this->date = $row['event_date'];
    $this->title = $row['event_title'];
    $this->description = $row['event_description'];
  }
}
