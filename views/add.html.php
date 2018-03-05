<?php
  use Pastebin\UrlBuilder;
  $paste_name = View::get('paste_name');
  $list_url = UrlBuilder::url('list');
  $create_url = UrlBuilder::url('create_paste');
?>

<form action="<?php View::put($create_url); ?>" method="post" autocomplete="off">
  <label for="paste_name">Name</label>
  <input
    type="text"
    name="paste_name"
    id="paste_name"
    value="<?php View::put($paste_name); ?>"
  />

  <label for="paste_text">Text</label>
  <textarea name="paste_text" id="paste_text"></textarea>

  <label for="password">Password</label>
  <input type="password" name="password" id="password"/>

  <div class="center">
    <button type="submit">SAVE</button>
    <a href="<?php View::put($list_url); ?>">LIST</a>
  </div>
</form>
