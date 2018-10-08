<!DOCTYPE html>
<html lang="sv">

<head>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/pjamasc.js"></script>
    {block name="scripts"}{/block}
    <link rel="stylesheet" href="assets/css/reset.css">
    <!--<link rel="stylesheet" href="assets/css/pjamasc.css">-->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
             <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.3/html5shiv.js"></script>
             <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
         <![endif]-->
    <link rel="stylesheet" href="assets/css/bootstrap-mod.css">
    <link rel="stylesheet" href="assets/css/style.css"> {block name="stylesheets"}{/block}
    <title>{block name="title"}PJAMASC{/block}</title>
</head>

<body>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">PJAMASC</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="navbar-form navbar-right">
                    {if !Authentication::user()}
                    <form action="#" id="login-form" novalidate>
                        <input type="email" id="login-email" class="form-control" placeholder="E-mail" maxlength="60">
                        <input type="password" id="login-password" class="form-control" placeholder="Password" maxlength="72">
                        <button type="submit" name="submit" class="btn btn-primary" value="Log in">Log in</button>
                    </form>
                    {else}
                    <div id="user-menu">
                        <form action="#" id="logout-form" novalidate>
                            <p>Logged in as {Authentication::user()->name|escape}.</p>
                            <button type="submit" name="submit" class="btn btn-danger" value="Log out">Log out</button>
                        </form>
                    </div>
                    {/if}
                </ul>
                <ul class="nav navbar-nav">
                    <li{if isset($highlightedMenuItem) && $highlightedMenuItem==='product_list' } class="active" {/if}><a href="product_list.php">Products</a></li>
                        <li{if isset($highlightedMenuItem) && $highlightedMenuItem==='calendar' } class="active" {/if}><a href="calendar.php">Calendar</a></li>
                            <li{if isset($highlightedMenuItem) && $highlightedMenuItem==='contact' } class="active" {/if}><a href="contact.php">Contact</a></li>
                                <li{if isset($highlightedMenuItem) && $highlightedMenuItem==='about' } class="active" {/if}><a href="about.php">About</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>
    {block name="body"}{/block}
    <footer>
        <div class="row">
        </div>
        <div class="copyright">
            © 2018 Copyright: PJAMASC
        </div>
    </footer>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>
