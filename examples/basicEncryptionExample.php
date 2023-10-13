<?php
  require_once '../vendor/autoload.php';
  use encrypted_images_php\encryption\text;

  // get string to encrypt from url
  $data = strip_tags($_GET['str']);
  // get key from url if it exists
  if (isset($_GET['key'])) { 
    $key = strip_tag($_GET['key']);
  }
  // set key empty for default if not exists
  if (!isset($key)) {
    $key = "";
  }
  $encryption = new text();

  //encrypt data
  $encrypted = $encryption->encrypt($data, $key);

  echo $encrypted;