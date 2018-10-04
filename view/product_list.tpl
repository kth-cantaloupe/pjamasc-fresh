{extends file="layout.tpl"}

{block name="body"}
	<div class="container">
		<p>Here we show a selection of our products.</p>

		{foreach from=$products item=product}
			<div class="product">
				<img src="assets/images/products/{$product->id}.jpg" alt="{$product->name|escape}">
				<h2>{$product->name|escape}</h2>
				<p>{$product->description|escape}</p>
				[<a href="product.php?id={$product->id}">Read more...</a>]
			</div>
		{/foreach}
	</div>
{/block}
