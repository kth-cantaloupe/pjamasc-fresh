{extends file="layout.tpl"}

<!--
{block name="scripts"}
    <script src="assets/js/add_event.js"></script>
{/block}
-->


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
						<div data-date="{$day->date}" id="{if $day->isThisMonth}{$day->date}{/if}" class="calendar-day{if !$day->isThisMonth} not-current-month{/if}{if $day->event} eventcolor{/if}">
							<span class="day-of-month">{$day->day}</span>
							<span class="day-of-week">{$day->weekday}</span>

							{if $day->event}
                                <input id="des" type="hidden" value="{$day->event->description|escape}">
                                <param id="title" type="hidden" value="{$day->event->title|escape}">
								
							{/if}
						</div>
                    
					{/foreach}
				</div>
			{/foreach}
			<div style="clear:both"></div>
		</div>
        
            <div><h2 id = "eventTitle"></h2><p id = "eventDescription"></p></div>
        
        
        
         {if Authentication::admin() == true}
        
        <div class="container" id="eventFormBox">
            <div class="form-group">
            <h2 id="formTitle">Add an event here: </h2>
            </div>
		<form action="" method="post" id="eventForm">
			<div class="form-group">
				Event title:
				<input type="text" name="name" id="event-name">
			</div>
            <div class="form-group">
				Event date:
				<input type="text" name="name" id="event-date">
			</div>
            
			<div class="form-group">
				Description: <br>
				<textarea name="description" id="event-description" rows = "10"></textarea>
			</div>
            <div class="form-group">
			<input type="submit" value="Add event">
            </div>
		</form>
	</div>
        {/if}
{/block}

        
        