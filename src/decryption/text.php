<?php
  /**
   * Class decryption\text
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
  class text {

    /**
     * Decrypt an encrypted text and return the original plaintext.
     *
     * @param string $text The encrypted text to be decrypted.
     * @param string $key (Optional) The decryption key. Default is "welovenfts".
     *
     * @return string|array Original plaintext or an error message.
     */
    public function decrypt($text, $key = "welovenfts") {
      if ($key == '') { $key = "welovenfts"; }
      $cipher = "AES-128-CBC";
      $ivlen = openssl_cipher_iv_length($cipher);
      $c = base64_decode($text);
      $iv = substr($c, 0, $ivlen);
      $hmac = substr($c, $ivlen, $sha2len = 32);
      $ciphertext_raw = substr($c, $ivlen + $sha2len);
      $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
      $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
      if (strlen($c) < $ivlen) {
        return('IV is missing or invalid');
      }
      if ($this->verify($text, $key)) {
        return $original_plaintext;
      } else {
        return('error');
      }
    }

    /**
     * Verify the integrity of the ciphertext and protect against timing attacks.
     *
     * @param string $ciphertext The encrypted text.
     * @param string $key The decryption key.
     *
     * @return bool True if the ciphertext is valid, false otherwise.
     */
    private function verify($ciphertext, $key) {
      $ivlen = openssl_cipher_iv_length("AES-128-CBC");
      $iv = base64_decode(substr($ciphertext, 0, $ivlen));
      $hmac_ciphertext = base64_decode(substr($ciphertext, $ivlen));
      $hmac = hash_hmac('sha256', $hmac_ciphertext, $key, $as_binary = true);
      $ciphertext_hash = hash_hmac('sha256', $hmac_ciphertext, $key, $as_binary = true);
      return hash_equals($hmac, $ciphertext_hash);
    }
  }