<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/pjamasc.css">
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
        <form action="#" id="login-form">
          <input type="email" class="login-form-input" placeholder="E-mail" maxlength="60">
          <input type="password" class="login-form-input" placeholder="Password" maxlength="72">
          <input type="submit" value="Log in">
        </form>
        <div style="clear:both"></div>
      </div>
    </nav>
    {block name="body"}{/block}
  </body>
</html>
