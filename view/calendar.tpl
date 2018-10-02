{extends file="layout.tpl"}

{block name="stylesheets"}
	<link rel="stylesheet" href="assets/css/calendar.css">
{/block}

{block name="body"}
	<div class="container">
		[<a href="calendar.php?year={$calendar->prevMonth[0]}&amp;month={$calendar->prevMonth[1]}">Föregående månad</a>]
		[<a href="calendar.php?year={$calendar->nextMonth[0]}&amp;month={$calendar->nextMonth[1]}">Nästa månad</a>]

		<h1>{$calendar->month->name} {$calendar->year}</h1>
		<div class="calendar">
			<div class="calendar-week-days">
				<div>Måndag</div>
				<div>Tisdag</div>
				<div>Onsdag</div>
				<div>Torsdag</div>
				<div>Fredag</div>
				<div>Lördag</div>
				<div>Söndag</div>
			</div>
			{foreach from=$calendar->weeks item=week}
				<div class="calendar-week">
					{foreach from=$week item=day}
						<div class="calendar-day{if !$day->isThisMonth} not-current-month{/if}">
							<span class="day-of-month">{$day->day}</span>
							<span class="day-of-week">{$day->weekday}</span>

							{if $day->event}
								<div class="event">{$day->event->title}</div>
							{/if}
						</div>
					{/foreach}
				</div>
			{/foreach}
			<div style="clear:both"></div>
		</div>
{/block}
