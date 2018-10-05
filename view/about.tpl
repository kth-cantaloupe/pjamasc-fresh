{extends file="layout.tpl"}

{block name="scripts"}
	<script src="assets/js/about.js"></script>
{/block}

{block name="stylesheets"}
	<link rel="stylesheet" href="assets/css/about.css">
{/block}

{block name="body"}
	<div class="container">
		{foreach from=$info item=infoItem}
			<div class="about-info" data-info-id="{$infoItem->id}">
				<h2>{$infoItem->title|escape}</h2>
				<p>{$infoItem->value|escape}</p>
				{if Authentication::admin()}
					<input type="button" value="Edit...">
				{/if}
			</div>
		{/foreach}
	</div>
{/block}
