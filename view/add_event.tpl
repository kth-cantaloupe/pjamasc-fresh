
{block name="stylesheets"}
	<link rel="stylesheet" href="assets/css/calendar.css">
{/block}

{block name="body"}

	<div class="container">
		<form action="add_event.php" method="post">
			<div class="form-group">
				<label for="event-name">Event name</label>
				<input type="text" name="name" id="event-name">
			</div>
            <div class="form-group">
				<label for="event-date">Event date</label>
				<input type="text" name="name" id="event-name">
			</div>

			<div class="form-group">
				<label for="event-description">Envent description</label>
				<textarea name="description" id="event-description"></textarea>
			</div>

			<input type="submit" value="Add event">
		</form>
	</div>
{/block}