{extends file="layout.tpl"}

{block name="stylesheets"}
	<link rel="stylesheet" href="assets/css/contact.css">
{/block}

{block name="body"}
	<div class="container">
		<form action="contact.php" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="register-company-name">Company Name</label>
				<input type="text" id="register-company-name" name="company-name">
			</div>

			<div class="form-group">
				<label for="register-company-no">Company Registration Number</label>
				<input type="text" id="register-company-no" name="company-no">
			</div>

			<div class="form-group">
				<label for="register-full-name">Full Name</label>
				<input type="text" id="register-full-name" name="full-name">
			</div>

			<div class="form-group">
				<label for="register-telephone-number">Telephone Number</label>
				<input type="text" id="register-telephone-number" name="telephone-number">
			</div>

			<div class="form-group">
				<label for="register-email-address">Email Address</label>
				<input type="email" id="register-email-address" name="email-address">
			</div>

			<div class="form-group">
				<label for="register-password">Password</label>
				<input type="text" id="register-password" name="password">
			</div>

			<div class="form-group">
				<label for="register-password-confirmation">Confirm Password</label>
				<input type="text" id="register-password-confirmation" name="password-confirmation">
			</div>

			<div class="form-group">
				<label for="register-rfp">Request For Proposal (*.pdf)</label>
				<input type="file" id="register-rfp" name="rfp" accept="application/pdf">
			</div>

			<button type="submit" name="submit">Register User</button>
		</form>
	</div>
{/block}
