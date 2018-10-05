$(function() {
	$('.about-info-edit-button').on('click', function(event) {
		var info = event.target.parentNode.parentNode;
		var infoId = info.dataset.infoId;
		var infoName = $(info).find('.panel-heading').text().trim();
		var infoValue = $(info).find('.panel-body').text().trim();

		var newValue = prompt('Please enter a new value for "' + infoName + '"', infoValue);

		if (newValue && newValue !== infoValue) {
			$.post('about.php', {id:infoId,value:newValue}, function(res) {
				$(info).find('.panel-body').text(newValue);
			});
		}
	});
});
