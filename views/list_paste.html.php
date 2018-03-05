<?php
  $url = View::get('url');
  $name = View::get('name');
  $expires = View::get('expires');
?>

<p>
  <a href="<?php View::put($url); ?>">
    <span class="list header"><?php View::put($name); ?></span><br/>
    <span class="list expires">Expires <?php View::put($expires); ?></span>
  </a>
</p>
