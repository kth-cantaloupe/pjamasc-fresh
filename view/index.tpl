{extends file="layout.tpl"} {block name="body"}
<main>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active" style="background-image: url('assets/images/caro-1.png');">
                <div class="carousel-caption">
                    <h3>Lorem ipsum</h3>
                    <p>Lorem ipsum Lorem ipsum lorem ipsum.</p>
                </div>
            </div>

            <div class="item" style="background-image: url('assets/images/caro-2.png');">
                <div class="carousel-caption">
                    <h3>Lorem ipsum</h3>
                    <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</p>
                </div>
            </div>

            <div class="item" style="background-image: url('assets/images/caro-3.png');">
                <div class="carousel-caption">
                    <h3>Lorem ipsum</h3>
                    <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</p>
                </div>
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div id="home-info" class="container">
        <h1>Lorem Ipsum</h1>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ut efficitur orci. Nullam lobortis est dui, a finibus urna imperdiet eget. Vestibulum ultrices nulla vel risus aliquet, sit amet semper purus venenatis. Pellentesque ut turpis at ipsum tempor
            vulputate. Suspendisse semper lectus ac ante rhoncus, id interdum lectus volutpat. Donec porttitor facilisis enim, in semper risus mattis auctor. Vestibulum congue sed odio nec commodo. Vestibulum vitae vulputate magna, eu bibendum nisi. Suspendisse
            in sodales tortor. Sed vehicula tempus eros, nec blandit urna maximus ac. Nunc tempus sed tellus vel vehicula. Vivamus eu arcu rhoncus, pulvinar tellus sit amet, posuere purus. Fusce nec ullamcorper massa. Phasellus rhoncus sagittis malesuada.
            Cras vel enim consectetur, laoreet mi at, efficitur arcu. Etiam convallis mauris eget dolor ultrices, et scelerisque dolor blandit. Fusce congue nunc a gravida faucibus. Mauris ullamcorper est vitae odio interdum rutrum. Vestibulum feugiat
            est dolor, at sagittis eros feugiat et. Nullam aliquet, arcu euismod consequat finibus, tellus eros fermentum turpis, vel pulvinar massa dui quis erat. Cras eu mattis turpis. Pellentesque sed dui ornare, interdum velit in, efficitur diam.
            Quisque in facilisis ante. Proin condimentum tincidunt sem, at eleifend sem mattis id. Sed tincidunt, nibh nec aliquet mattis, nisl massa maximus dui, sed sagittis tortor sapien suscipit metus.
        </p>
    </div>

</main>
{/block}