<?php
  require_once '../vendor/autoload.php';
  use encrypted_images_php\encryption\images;

  // get string to encrypt from url
  $data = strip_tags($_GET['str']);

  //get watermark from the url
  //watermarkets must be in the folder 
  //"watermarks" from whereever you 
  //initialize encrypted_images_php\encryption\images
  $watermark = strip_tags($_GET['watermark']);

  // get key from url if it exists
  if (isset($_GET['key'])) { 
    $key = strip_tag($_GET['key']);
  }

  // set key empty for default if not exists
  if (!isset($key)) {
    $key = "";
  }
  //encrypt data
  $encryption = new images();
  $encrypted = $encryption->encryptToImage($data, $watermark, $key);

  $r = 200;
  $g = 190;
  $b = 255; 
  $encrypted_alt_color_scheme = $encryption->encryptToImage($data, $watermark, $key, $r, $g, $b);

  $r = 16;
  $g = 93;
  $b = 122; 
  $encrypted_another_alt_color_scheme = $encryption->encryptToImage($data, $watermark, $key, $r, $g, $b);

  echo ' <img src="data:image/png;base64,'. $encrypted .'"><br><br><br>';
  echo ' <img src="data:image/png;base64,'. $encrypted_alt_color_scheme .'"><br><br><br>';
  echo ' <img src="data:image/png;base64,'. $encrypted_another_alt_color_scheme .'">';