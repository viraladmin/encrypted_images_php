<?php
  /**
   * Class encryption\images
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

  namespace encrypted_images_php\encryption;
  use encrypted_images_php\charMappings\colorMap;
  use encrypted_images_php\encryption\text;
  class images {

     /**
     * Encrypt a string and embed it into an image with a watermark.
     *
     * @param string $str The input string to be encrypted.
     * @param string $watermark (Optional) The watermark type (e.g., 'ethereum', 'bitcoin', 'cardano').
     * @param string $key (Optional) The encryption key. Default is "welovenfts".
     * @param int $r (Optional) Red channel adjustment.
     * @param int $g (Optional) Green channel adjustment.
     * @param int $b (Optional) Blue channel adjustment.
     *
     * @return string Base64-encoded image containing the encrypted data.
     */
    public function encryptToImage($str, $watermark, $key = "welovenfts", $r = 100, $g = 134, $b = 131) {
      $textEncryptor = new text();
      $ciphertext = $textEncryptor->encrypt($str, $key);
      $Width = strlen($ciphertext);
      $Height = strlen($ciphertext);
      $Image = imagecreatetruecolor($Width, $Height);
      imagealphablending($Image, false);
      imagesavealpha($Image, true);
      $colored = new colorMap();
      $reflection = new \ReflectionClass(get_class($colored));
      $method = $reflection->getMethod('getColor');

      // Use <= to create an offset that shifts the last character to the first position on the image.
      for($Row = 0; $Row <= $Height; $Row++) {
        for($Column = 0; $Column <= $Width; $Column++) {
          $method = $reflection->getMethod('getColor');
          $attributes = $method->getAttributes(ColorAttribute::class);
          $colorClosure = $method->getClosure($colored);
          $color = $colorClosure->call($colored, $ciphertext[$Column - 1]);
          $colors = explode(', ', $color);

          // $r, $g, $b are variables that can be used to change the image gradient output.
          if ($Row > 0) {
            $red = $colors[0] - ($Row + $r);
            $red = abs($red);
            if ($red == 256) { $red = 255; }
            $green = $colors[1] - ($Row + $g);
            $green = abs($green);
            if ($green == 256) { $green = 255; }
            $blue = $colors[2] - ($Row + $b);
            $blue = abs($blue);
            if ($blue == 256) { $blue = 255; }
            $alpha = 0;
          } else {
            $red = $colors[0];
            $green = $colors[1];
            $blue = $colors[2];
            $alpha = 0;
          }
          $Color = imagecolorallocatealpha($Image, $red, $green, $blue, $alpha);
          imagesetpixel($Image, $Column, $Row, $Color);
        }
      }

      //if watermark is empty, set it to null
      if (isset($watermark) && $watermark == '') {
        unset($watermark);
      }

      //set watermark
      if (isset($watermark)) {
        if ($watermark == 'ethereum') {
          $src = imagecreatefrompng('watermarks/eth.png');
        }
        if ($watermark == 'bitcoin') {
          $src = imagecreatefrompng('watermarks/btc.png');
        }
        if ($watermark == 'cardano') {
          $src = imagecreatefrompng('watermarks/ada.png');
        }
        $nw = ($Width / 2) - 16;
        $nh = ($Height / 2) - 16;
        $background = imagecolorallocatealpha($src, 0, 0, 0, 127);
        imagecolortransparent($src, $background);
        imagealphablending($src, false);
        imagesavealpha($src, true);
        imagecopymerge($Image, $src, $nw, $nh, 0, 0, 32, 32, 100);
        imagesavealpha($Image, true);
      }
      ob_start();
      imagepng($Image);
      $img = ob_get_clean();
      return base64_encode($img);
    }
  }