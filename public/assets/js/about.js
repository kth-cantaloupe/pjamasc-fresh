$(function() {
	$('.about-info input').on('click', function(event) {
		var info = event.target.parentNode;
		var infoId = info.dataset.infoId;
		var infoName = $(info).find('h2').text().trim();
		var infoValue = $(info).find('p').text().trim();

		var newValue = prompt('Please enter a new value for "' + infoName + '"', infoValue);

		if (newValue && newValue !== infoValue) {
			$.post('about.php', {id:infoId,value:newValue}, function(res) {
				$(info).find('p').text(newValue);
			});
		}
	});
});
