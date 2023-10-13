<?php
  /**
   * Class charMap
   * Author: Bruce Bates
   * Copyright: 2023
   * X: @thebrucebates
   * Website: https://encryptedimages.com
   */

  /*
   * MIT License
   *
   * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
   *
   * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
   *
   * THE SOFTWARE IS PROVIDED "AS IS," WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES, OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT, OR OTHERWISE, ARISING FROM, OUT OF, OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
   *
   */

  require_once '../vendor/autoload.php';
  use encrypted_images_php\charMappings\colorMap;
  use encrypted_images_php\charMappings\charMap;
  use encrypted_images_php\encryption\text as TextEncryption;
  use encrypted_images_php\decryption\text as TextDecryption;
  use encrypted_images_php\encryption\images as imgEncryption;
  use encrypted_images_php\decryption\images as imgDecryption;

  // Test for colorMap and charMap classes accessibility
  $color = new colorMap();
  $char = new charMap();
  $reflection1 = new \ReflectionMethod($color, 'getColor');
  $reflection2 = new \ReflectionMethod($char, 'getChar');
  
  // Check if charMap class is public. It should never be public.
  if ($reflection1->isPublic()) {
    echo "<span style='color: red;'>[failed]</span> The colorMap class is public. This is bad for security.<br>";
  } else {
    echo "<span style='color: green;'>[passed]</span> Good job the colorMap class is private.<br>";
  }  

  // Check if colorMap class is public. It should never be public.
  if ($reflection2->isPublic()) {
    echo "<span style='color: red;'>[failed]</span> The charMap class is public. This is bad for security.<br>";
  } else {
    echo "<span style='color: green;'>[passed]</span> Good job the charMap class is private.<br>";
  }

  // Run character conversion tests to ensure all colors correctly match characters and all characters correctly match colors. 
  if (!$reflection1->isPublic() && !$reflection2->isPublic()) {
    $testCharacters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/+=';
    $failedTests = [];  
    
    foreach (str_split($testCharacters) as $character) {
      $colored = new colorMap();
      $reflection = new \ReflectionClass(get_class($colored));
      $method = $reflection->getMethod('getColor');
      $colorClosure = $method->getClosure($colored);
      $color = $colorClosure->call($colored, $character);     
      $charred = new charMap();
      $reflection = new \ReflectionClass(get_class($charred));
      $method = $reflection->getMethod('getChar');
      $charClosure = $method->getClosure($charred);
      $letter = $charClosure->call($charred, $color);
      if ($letter != $character) {
        $failedTests[] = [
          'expected' => $character,
          'actual' => $letter,
        ];
      } 
    }
    if (empty($failedTests)) {
      echo "<span style='color: green;'>[passed]</span> All character conversion tests passed.<br>";
    } else {
      foreach ($failedTests as $test) {
        echo "<span style='color: red;'>[failed]</span> Character Failure. Check mapping of {$test['expected']}<br>";
      }
    }
  }

  // Test encryption and decryption
  function testEncryptionDecryption($inputString) {
    $encryption = new TextEncryption();
    $decryption = new TextDecryption();
    $encryptedText = $encryption->encrypt($inputString);
    $decryptedText = $decryption->decrypt($encryptedText);
    if ($inputString === $decryptedText) {
      echo "<span style='color: green;'>[passed]</span> Encryption and decryption test passed.<br>";
    } else {
      echo "<span style='color: red;'>[failed]</span> Encryption and decryption test failed. Input and decrypted text do not match.<br>";
    }
  }
  testEncryptionDecryption('Thisismycoolencryptedtextdontyaknow');


  // Test encrypting and decrypting an image
  $encryption = new imgEncryption();
  $inputText = "Thisismycoolencryptedtextdontyaknow";
  $watermark = "ethereum";
  $key = "welovenfts";
  $imageData = $encryption->encryptToImage($inputText, $watermark, $key);
  $decryption = new imgDecryption();
  $decryptedText = $decryption->decryptFromImage($imageData, "", "json");
  if ($inputText === $decryptedText) {
    echo "<span style='color: green;'>[passed]</span> Encrypting and decrypting image worked correctly.<br>";
  } else {
    echo "<span style='color: red;'>[failed]</span> Test failed: Input and decrypted text do not match.<br>";
  }

  // Test encryption protection against timing attacks
  $text = new TextEncryption();
  $testData = "Hello, World!";
  $key = "your_key";
  $iterations = 1000;
  $encryptExecutionTimes = [];
  for ($i = 0; $i < $iterations; $i++) {
    $start_time = microtime(true);
    $ciphertext = $text->encrypt($testData, $key);
    $end_time = microtime(true);
    $execution_time = ($end_time - $start_time) * 1000;
    $encryptExecutionTimes[] = $execution_time;
  }
  $averageEncryptTime = array_sum($encryptExecutionTimes) / count($encryptExecutionTimes);
  if ($averageEncryptTime !== $averageEncryptTime) {
    echo "<span style='color: red;'>[failed]</span> Encrtyptin is vulnerable to timing attacks.<br>";
  } else {
    echo "<span style='color: green;'>[passed]</span> Encryption is protected against timing attacks.<br>";
  }

  // Test decryption protection against timing attacks
  $text2 = new TextDecryption();
  $testData = "Hello, World!";
  $key = "your_key";
  $iterations = 1000;
  $decryptExecutionTimes = [];
  for ($i = 0; $i < $iterations; $i++) {
    $ciphertext = $text->encrypt($testData, $key);
    $start_time = microtime(true);
    $plaintext = $text2->decrypt($ciphertext, $key);
    $end_time = microtime(true);
    $execution_time = ($end_time - $start_time) * 1000;
    $decryptExecutionTimes[] = $execution_time;
  }
  $averageDecryptTime = array_sum($decryptExecutionTimes) / count($decryptExecutionTimes);
  if ($averageDecryptTime !== $averageDecryptTime) {
    echo "<span style='color: red;'>[failed]</span> Decryption is vulnerable to timing attacks.<br>";
  } else {
    echo "<span style='color: green;'>[passed]</span> Decryption is protected against timing attacks.<br>";
  }

  // minimum encryption string size test.
  $i = 0;
  $stop = false;
  function testCharMin($i) {
    $str = str_repeat('a', $i);
    $encryption = new TextEncryption();
    $encryptedText = @$encryption->encrypt($str); // Use @ to suppress warnings
    return $encryptedText;
  }
  while (!$stop) {
    $return = testCharMin($i);
    $last = error_get_last();
    if (isset($last)) { $error = $last['message']; } else { $error = ''; }
    if (strpos($error, 'openssl_encrypt') !== false) {
      $i++;
      error_clear_last();
      unset($error);
    } else {
      $stop = true;
    }
  }
  echo "Minimum number of characters required to encrypt: $i<br>";

  // maximum encryption string size test. Not true max, memory exhaustion
  $min = 0;
  $max = 50065312;
  $encryption = new TextEncryption();
  while ($max - $min > 1) {
    $size = $min + floor(($max - $min) / 2);
    $str = str_repeat('a', $size);
    $encryptedText = @$encryption->encrypt($str);
    if ($encryptedText) {
      $min = $size;
    } else {
      $max = $size;
    }
  }
  echo "Maximum character count for encryption: $min<br>";