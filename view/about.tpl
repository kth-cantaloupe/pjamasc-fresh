{extends file="layout.tpl"} {block name="scripts"}
<script src="assets/js/about.js"></script>
{/block} {block name="stylesheets"}
<link rel="stylesheet" href="assets/css/about.css"> {/block} {block name="body"}
<main>
  <div class="container">
    {foreach from=$info item=infoItem}
      <div class="panel panel-default" data-info-id="{$infoItem->id}">
        <div class="panel-heading">
          {$infoItem->title|escape}
        </div>
        <div class="panel-body">
          {$infoItem->value|escape}
        </div>
        {if Authentication::admin()}
          <div class="panel-footer">
            <input type="button" value="Edit..." class="btn btn-primary about-info-edit-button">
          </div>
        {/if}
      </div>
    {/foreach}


        <div class="about-profiles">
            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
                <img src="assets/images/profile-pic.png" alt="Picture of John">
                <h3 class="about-name">John Doe</h3>
                <h4 class="about-position">Developer</h4>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
                <img src="assets/images/profile-pic.png" alt="Picture of John">
                <h3 class="about-name">John Doe</h3>
                <h4 class="about-position">Developer</h4>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
                <img src="assets/images/profile-pic.png" alt="Picture of John">
                <h3 class="about-name">John Doe</h3>
                <h4 class="about-position">Developer</h4>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
                <img src="assets/images/profile-pic.png" alt="Picture of John">
                <h3 class="about-name">John Doe</h3>
                <h4 class="about-position">Developer</h4>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
                <img src="assets/images/profile-pic.png" alt="Picture of John">
                <h3 class="about-name">John Doe</h3>
                <h4 class="about-position">Developer</h4>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
                <img src="assets/images/profile-pic.png" alt="Picture of John">
                <h3 class="about-name">John Doe</h3>
                <h4 class="about-position">Developer</h4>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
                <img src="assets/images/profile-pic.png" alt="Picture of John">
                <h3 class="about-name">John Doe</h3>
                <h4 class="about-position">Developer</h4>
            </div>
            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
                <img src="assets/images/profile-pic.png" alt="Picture of John">
                <h3 class="about-name">John Doe</h3>
                <h4 class="about-position">Developer</h4>
            </div>
        </div>
    </div>
</main>
{/block}
