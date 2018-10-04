{extends file="layout.tpl"} {block name="scripts"}
<script src="assets/js/about.js"></script>
{/block} {block name="stylesheets"}
<link rel="stylesheet" href="assets/css/about.css"> {/block} {block name="body"}
<main>
    <div id="about-info" class="container">
        <h1>About us</h1>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ut efficitur orci. Nullam lobortis est dui, a finibus urna imperdiet eget. Vestibulum ultrices nulla vel risus aliquet, sit amet semper purus venenatis. Pellentesque ut turpis at ipsum tempor
            vulputate. Suspendisse semper lectus ac ante rhoncus, id interdum lectus volutpat. Donec porttitor facilisis enim, in semper risus mattis auctor. Vestibulum congue sed odio nec commodo. Vestibulum vitae vulputate magna, eu bibendum nisi. Suspendisse
            in sodales tortor. Sed vehicula tempus eros, nec blandit urna maximus ac. Nunc tempus sed tellus vel vehicula. Vivamus eu arcu rhoncus, pulvinar tellus sit amet, posuere purus. Fusce nec ullamcorper massa. Phasellus rhoncus sagittis malesuada.
        </p>

        <button type="button" class="btn btn-primary">Edit</button>

        <div id="about-admin">
            <form action="" method="get">
                <div class="form-group">
                    <label for="about-text">About text:</label>
                    <textarea class="form-control" rows="5" id="about-text"></textarea>
                    <button type="submit" name="submit" class="btn btn-primary">Submit change</button>
                </div>
            </form>
        </div>

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
<div class="container">
    {foreach from=$info item=infoItem}
    <div class="about-info" data-info-id="{$infoItem->id}">
        <h2>{$infoItem->title|escape}</h2>
        <p>{$infoItem->value|escape}</p>
        {if Authentication::admin()}
        <input type="button" value="Edit..."> {/if}
    </div>
    {/foreach}
</div>
{/block}