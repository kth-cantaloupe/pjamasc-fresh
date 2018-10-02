<?php
require '../require.php';

$time = time();
$year = date('Y', $time);
$month = date('m', $time);

if (isset($_GET['year']) && isset($_GET['month'])) {
  if ($_GET['year'] >= 1990 && $_GET['year'] <= 2030) {
    if ($_GET['month'] >= 1 && $_GET['month'] <= 12) {
      $year = $_GET['year'];
      $month = $_GET['month'];
    }
  }
}

$calendar = new Calendar(strtotime(sprintf('%d-%d-1', $year, $month)), time());

$events = Database::getInstance()->getAllEvents($year, $month);
$eventsByDate = [];
foreach ($events as $event)
  $eventsByDate[$event->date] = $event;
foreach ($calendar->weeks as $week)
  foreach ($week as $day)
    if (isset($eventsByDate[$day->date]))
      $day->event = $eventsByDate[$day->date];
    else
      $day->event = null;

Template::render('calendar.tpl', [
  'highlightedMenuItem' => 'calendar',
  'calendar' => $calendar,
  'events' => $eventsByDate
]);
