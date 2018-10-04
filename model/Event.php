<?php
class Event {
  public $date, $title;

    /**
     * Event constructor.
     * @param $row Array of values for an event including date and title.
     */
  public function __construct($row) {
    $this->date = $row['event_date'];
    $this->title = $row['event_title'];
  }
}
