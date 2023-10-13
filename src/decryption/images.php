<?php
  /**
   * Class decryption\images
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

  namespace encrypted_images_php\decryption;
  use encrypted_images_php\decryption\text;
  use encrypted_images_php\charMappings\charMap;
  class images {

    /**
     * Decrypt data from an image and return the original plaintext.
     *
     * @param string $fileData The image data or file path.
     * @param string $key (Optional) The decryption key. Default is "welovenfts".
     * @param string $datatype (Optional) The data type, either "web" or "json".
     *
     * @return string|array An error message if decryption fails, or the original plaintext.
     */
    public function decryptFromImage($fileData, $key = "welovenfts", $datatype = "web") {
      if ($key == '') {
        $key = "welovenfts";
      }
      $original_plaintext = null;

      // Json datatype allows base64 images to be sent. Web datatype allows image upload.
      if ($datatype == "json") {
        $str = base64_decode($fileData);
        if ($str === false) {
          return "Error: Failed to decode base64 data.";
        }
        $size = getimagesizefromstring($str);
        if ($size === false) {
          return "Error: Invalid image data.";
        }
        $end = $size[0];
      } else {
        $size = getimagesize($fileData);
        if ($size === false) {
          return "Error: Invalid image file.";
        }
        $str = file_get_contents($fileData);
        $end = $size[0];
      }
      $out = '';
      $im = imagecreatefromstring($str);
      if (!$im) {
        return "Error: Failed to create image resource.";
      }
      $colorMap = new charMap();
      $reflection = new \ReflectionClass(get_class($colorMap));
      $getCharMethod = $reflection->getMethod('getChar');
      $getColor = $reflection->getMethod('getChar');

      // We need to extract the first row of colors form the image to decrypt
      for ($l = 0; $l < $end; $l++) {
        $rgb = imagecolorat($im, $l, 0);
        $colors = imagecolorsforindex($im, $rgb);
        $str = $colors['red'] . ', ' . $colors['green'] . ', ' . $colors['blue'];

        // This shifts the first character of the string back to its correct last position.
        if ($l == 0) {
          $last = $getCharMethod->invoke($colorMap, $str);
        } elseif ($l == 127) {
          $out .= $getCharMethod->invoke($colorMap, $str);
          $out .= $last;
        } else {
          $out .= $getCharMethod->invoke($colorMap, $str);
        }
      }
      $textInstance = new text();
      $original_plaintext = $textInstance->decrypt($out, $key);
      return $original_plaintext;
    }
  }