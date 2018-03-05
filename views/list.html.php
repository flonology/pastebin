<?php
  use Pastebin\UrlBuilder;

  foreach (View::get('paste_list') as $paste) {
    $password_url = UrlBuilder::url('password', $paste->getId());

    View::add('url', $password_url);
    View::add('name', $paste->getName());

    $date = new DateTime('@' . $paste->getExpires());
    View::add('expires', $date->format('c'));

    include 'list_paste.html.php';
  }
?>
