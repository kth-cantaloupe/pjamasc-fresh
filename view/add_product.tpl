{extends "layout.tpl"}

{block name="stylesheets"}
	<link rel="stylesheet" href="assets/css/add_product.css">
{/block}

{block name="body"}
	<div class="container">
		<form action="add_product.php" method="post">
			<div class="form-group">
				<label for="product-name">Product name</label>
				<input type="text" name="name" id="product-name">
			</div>

			<div class="form-group">
				<label for="product-description">Product description</label>
				<textarea name="description" id="product-description"></textarea>
			</div>

			<div class="form-group">
				<label for="product-image">Product image (*.jpg)</label>
				<input type="file" name="image" accept="image/jpeg" id="product-image">
			</div>

			<input type="submit" value="Add product">
		</form>
	</div>
{/block}
