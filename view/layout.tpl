<!DOCTYPE html>
<html>
  <head>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/pjamasc.js"></script>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/pjamasc.css">
    {block name="stylesheets"}{/block}
    <title>{block name="title"}{/block}</title>
  </head>
  <body>
    <nav>
      <div class="container">
        <ul id="main-nav">
          <li{if isset($highlightedMenuItem) && $highlightedMenuItem === 'index'} class="active"{/if}><a href="index.php">Home</a></li>
          <li{if isset($highlightedMenuItem) && $highlightedMenuItem === 'product_list'} class="active"{/if}><a href="product_list.php">Products</a></li>
          <li{if isset($highlightedMenuItem) && $highlightedMenuItem === 'calendar'} class="active"{/if}><a href="calendar.php">Calendar</a></li>
          <li{if isset($highlightedMenuItem) && $highlightedMenuItem === 'contact'} class="active"{/if}><a href="contact.php">Contact</a></li>
        </ul>
        {if !Authentication::user()}
          <form action="#" id="login-form" novalidate>
            <input type="email" id="login-email" class="login-form-input" placeholder="E-mail" maxlength="60">
            <input type="password" id="login-password" class="login-form-input" placeholder="Password" maxlength="72">
            <input type="submit" value="Log in">
          </form>
        {else}
          <div id="user-menu">
            Logged in as {Authentication::user()->name|escape}.
            <form action="#" id="logout-form" novalidate>
              <input type="submit" value="Log out">
            </form>
          </div>
        {/if}
        <div style="clear:both"></div>
      </div>
    </nav>
    {block name="body"}{/block}
  </body>
</html>
