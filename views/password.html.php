<?php
  use Pastebin\UrlBuilder;
  $url = UrlBuilder::url('show', View::get('pid'));
?>

<form action="<?php View::put($url); ?>" method="post" autocomplete="off">
  <label for="password">Password</label>
  <input type="password" name="password" id="password"/>

  <div class="center">
    <button type="submit">LOAD PASTE</button>
  </div>
</form>
