<?php
  use Pastebin\UrlBuilder;
  $passwordOkMessage = View::get('password_ok') ? 'YES' : 'NO';
  $list_url = UrlBuilder::url('list');
?>

<p>
  ID: <?php View::put($paste->getId()); ?><br/>
  Name: <?php View::put($paste->getName()); ?><br/>
  Password OK: <?php View::put($passwordOkMessage); ?>
<p>

<p>
  <textarea><?php View::put($paste->getText()); ?></textarea>
</p>

<div class="center">
  <a href="<?php View::put($list_url); ?>">LIST</a>
</div>

<script>
  document.querySelector('textarea').addEventListener('click', function() {
    this.select();
  });
</script>
