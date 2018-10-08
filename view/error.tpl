{extends file="layout.tpl"}

{block name="body"}
  <main>
    <div class="container">
      <h1>{$errorTitle}</h1>
      <p>
        {$errorDescription}
        <ul>
          <li><a href="index.php">&laquo; Go to the home page</a></li>
        </ul>
      </p>
    </div>
  </main>
{/block}
