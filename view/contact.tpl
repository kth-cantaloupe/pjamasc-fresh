{extends file="layout.tpl"}

{block name="stylesheets"}
	<link rel="stylesheet" href="assets/css/contact.css">
{/block}

{block name="body"}
	<div class="container">
		{if sizeof($errors) > 0}
			<ul class="formErrors">
				{foreach from=$errors item=error}
					<li>{$error}</li>
				{/foreach}
			</ul>
		{/if}
		{if !Authentication::admin()}
			<form action="contact.php" method="POST" enctype="multipart/form-data">
				{if !Authentication::user()}
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
				{/if}
				<div class="form-group">
					<label for="register-notes">Description Notes</label>
					<input type="text" id="register-notes" name="notes">
				</div>

				<div class="form-group">
					<label for="register-rfp">Request For Proposal (*.pdf)</label>
					<input type="file" id="register-rfp" name="rfp" accept="application/pdf">
				</div>

				{if !Authentication::user()}
					<button type="submit" name="submit">Register User</button>
				{else}
					<button type="submit" name="submit">Register RFP</button>
				{/if}
			</form>
		{/if}
		{if Authentication::admin()}
			{foreach from=$RFPs item=rfp}
				<ul class="rfp">
					<li>{$rfp->id}</li>
					<li>{$rfp->creation}</li>
					<li>{$rfp->owner->name}</li>
					<li>{$rfp->owner->orgName}</li>
					<li>{$rfp->notes}</li>
				</ul>
			{/foreach}
		</ul>
		{/if}
	</div>
{/block}
