$(function() {
	$('#login-form').on('submit', function(event) {
		event.preventDefault();

		$.post('login.php', {email:$('#login-email').val(), password:$('#login-password').val()}, function(res) {
			$('#login-email').removeClass('form-error');
			$('#login-password').removeClass('form-error');

			if (res.status === 'success') {
				window.location = window.location.href;
			} else if (res.code === 1) {
				$('#login-email').addClass('form-error').focus();
			} else if (res.code === 2) {
				$('#login-password').addClass('form-error').focus();
			}
		});
	});

	$('#logout-form').on('submit', function(event) {
		event.preventDefault();

		$.post('logout.php', function() {
		window.location = window.location.href;
		});
	});
});
