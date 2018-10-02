<?php
class Calendar {
	public $year, $month, $numDays, $weeks, $nextMonth, $prevMonth;
	private $time, $start;

	const MONTHS = [
		'January', 'February', 'Mars', 'April', 'May', 'June',
		'July', 'August', 'September', 'October', 'November', 'December'
	];

	const WEEKDAYS = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

	public function __construct($time) {
		$this->time = $time;
		$this->start = strtotime(date('Y-m-01', $time));
		$this->numDays = intval(date('t', $time));
		$this->weeks = [[]];

		$this->year = intval(date('Y', $this->start));
		$this->month = new \stdClass();
		$this->month->n = intval(date('m', $this->start)) - 1;
		$this->month->name = self::MONTHS[$this->month->n];

		$this->nextMonth = [$this->year, $this->month->n + 2];
		if ($this->nextMonth[1] > 12) {
			$this->nextMonth[0]++;
			$this->nextMonth[1] = 1;
		}

		$this->prevMonth = [$this->year, $this->month->n];
		if ($this->prevMonth[1] < 1) {
			$this->prevMonth[0]--;
			$this->prevMonth[1] = 12;
		}

		$day = 1;
		$startWeekday = $this->weekday($this->start);
		$numDaysPrevMonth = intval(date('t', $this->start - 1));

		// Populate first week
		for ($i=0; $i<7; $i++) {
			$d = new \stdClass();
			$d->weekday = self::WEEKDAYS[$i];

			if ($i > $startWeekday - 2) {
				$d->day = $day++;
				$d->isThisMonth = true;
			} else {
				$d->day = $numDaysPrevMonth - $startWeekday + $i + 2;
				$d->isThisMonth = false;
			}

			$this->weeks[0][] = $d;
		}

		// Populate remainer of weeks
		while ($day <= $this->numDays) {
			$weekIndex = sizeof($this->weeks) - 1;

			if (sizeof($this->weeks[$weekIndex]) >= 7) {
				$this->weeks[] = [];
				$weekIndex++;
			}

			$weekday = sizeof($this->weeks[$weekIndex]);

			$d = new \stdClass();
			$d->day = $day++;
			$d->weekday = self::WEEKDAYS[$weekday];
			$d->isThisMonth = true;

			$this->weeks[$weekIndex][] = $d;
		}

		// Populate the first days of the next month
		$day = 1;
		$weekIndex = sizeof($this->weeks) - 1;
		$firstEmptyDay = sizeof($this->weeks[$weekIndex]);
		for ($i=$firstEmptyDay; $i<7; $i++) {
			$d = new \stdClass();
			$d->day = $day++;
			$d->weekday = self::WEEKDAYS[$i];
			$d->isThisMonth = false;
			$d->isToday = false;

			$this->weeks[$weekIndex][] = $d;
		}
	}

	private function weekday($time) {
		$weekday = intval(date('N', $time));

		if ($weekday !== -1) {
			return $weekday;
		} else {
			return 6;
		}
	}
}
