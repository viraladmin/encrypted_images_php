<?php
  /**
   * Class encryption\text
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
  class text {

    /**
     * Encrypt a string using AES-128-CBC encryption and verify integrity to protect against timing attacks.
     *
     * @param string $str The input string to be encrypted.
     * @param string $key (Optional) The encryption key. Default is "welovenfts".
     *
     * @return string|false The encrypted string or false if encryption fails or integrity check fails.
     */
    public function encrypt($str, $key = "welovenfts") {
      if ($key == '') { $key = "welovenfts"; }
      $cipher = "AES-128-CBC";
      $ivlen = openssl_cipher_iv_length($cipher);
      $iv = base64_encode(substr($str, 0, 10));
      if (strlen($str) > 175) {
        $chunkSize = 128;
	$chunks = str_split($str, $chunkSize);
	$ciphertext = '';
	foreach ($chunks as $chunk) {
          $ciphertext_raw = openssl_encrypt($chunk, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
          $ciphertext .= $this->calculateCiphertext($str, $ciphertext_raw, $cipher, $iv, $key);
        }
      } else {
        $ciphertext_raw = openssl_encrypt($str, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
        $ciphertext = $this->calculateCiphertext($str, $ciphertext_raw, $iv, $key);
      }
      if ($this->verify($str, $ciphertext, $key)) {
        return $ciphertext;
      } else {
        return false;
      }
    }

    /**
     * Calculate the final ciphertext by adding IV and HMAC to the encrypted data.
     *
     * @param string $str The input string.
     * @param string $ciphertext_raw The raw ciphertext.
     * @param string $iv The initialization vector.
     * @param string $key The encryption key.
     *
     * @return string The final ciphertext.
     */
    private function calculateCiphertext($str, $ciphertext_raw, $iv, $key) {
      $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
      $ciphertext = base64_encode($iv . $hmac . $ciphertext_raw);
      return $ciphertext;
    }

    /**
     * Verify the integrity of the ciphertext by checking the HMAC to protect against timing attacks.
     *
     * @param string $str The original input string.
     * @param string $ciphertext The ciphertext to be verified.
     * @param string $key The encryption key.
     *
     * @return bool True if the ciphertext is valid, false otherwise.
     */
    private function verify($str, $ciphertext, $key) {
      $ivlen = openssl_cipher_iv_length("AES-128-CBC");
      $iv = base64_decode(substr($ciphertext, 0, $ivlen));
      $hmac_ciphertext = base64_decode(substr($ciphertext, $ivlen));
      $hmac = hash_hmac('sha256', $hmac_ciphertext, $key, $as_binary = true);
      $ciphertext_hash = hash_hmac('sha256', $hmac_ciphertext, $key, $as_binary = true);
      return hash_equals($hmac, $ciphertext_hash);
    }
  }