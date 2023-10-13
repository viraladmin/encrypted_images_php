<?php
  /**
   * Class colorMap
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

  namespace encrypted_images_php\charMappings;
  class colorMap {

    /**
     * Map characters to colors.
     *
     * @param string $char The character to map to a color.
     *
     * @return string The color in the format 'R, G, B'.
     */
    protected function getColor($char) {
      if ($char == 'a') {
        return '204, 180, 194';
      }
      if ($char == 'A') {
        return '255, 255, 255';
      }
      if ($char == 'b') {
        return '197, 186, 201';
      }
      if ($char == 'B') {
        return '221, 206, 212';
      }
      if ($char == 'c') {
        return '181, 185, 193';
      }
      if ($char == 'C') {
        return '184, 201, 223';
      }
      if ($char == 'd') {
        return '224, 218, 192';
      }
      if ($char == 'D') {
        return '185, 191, 195';
      }
      if ($char == 'e') {
        return '181, 197, 198';
      }
      if ($char == 'E') {
        return '193, 206, 255';
      }
      if ($char == 'f') {
        return '252, 193, 211';
      }
      if ($char == 'F') {
        return '183, 192, 229';
      }
      if ($char == 'g') {
        return '180, 191, 192';
      }
      if ($char == 'G') {
        return '187, 219, 189';
      }
      if ($char == 'h') {
        return '195, 187, 234';
      }
      if ($char == 'H') {
        return '182, 216, 189';
      }
      if ($char == 'i') {
        return '197, 183, 248';
      }
      if ($char == 'I') {
        return '200, 182, 204';
      }
      if ($char == 'j') {
        return '255, 235, 196';
      }
      if ($char == 'J') {
        return '194, 186, 228';
      }
      if ($char == 'k') {
        return '199, 238, 239';
      }
      if ($char == 'K') {
        return '208, 247, 234';
      }
      if ($char == 'l') {
        return '244, 214, 189';
      }
      if ($char == 'L') {
        return '187, 243, 239';
      }
      if ($char == 'm') {
        return '188, 231, 238';
      }
      if ($char == 'M') {
        return '187, 197, 227';
      }
      if ($char == 'n') {
        return '186, 240, 191';
      }
      if ($char == 'N') {
        return '187, 198, 206';
      }
      if ($char == 'o') {
        return '205, 193, 184';
      }
      if ($char == 'O') {
        return '191, 187, 197';
      }
      if ($char == 'p') {
        return '194, 200, 206';
      }
      if ($char == 'P') {
        return '195, 183, 229';
      }
      if ($char == 'q') {
        return '182, 219, 196';
      }
      if ($char == 'Q') {
        return '238, 216, 184';
      }
      if ($char == 'r') {
        return '199, 181, 208';
      }
      if ($char == 'R') {
        return '239, 231, 198';
      }
      if ($char == 's') {
        return '189, 188, 230';
      }
      if ($char == 'S') {
        return '242, 192, 230';
      }
      if ($char == 't') {
        return '199, 199, 199';
      }
      if ($char == 'T') {
        return '188, 190, 230';
      }
      if ($char == 'u') {
        return '230, 180, 253';
      }
      if ($char == 'U') {
        return '241, 247, 247';
      }
      if ($char == 'v') {
        return '242, 190, 199';
      }
      if ($char == 'V') {
        return '230, 247, 234';
      }
      if ($char == 'w') {
        return '197, 186, 249';
      }
      if ($char == 'W') {
        return '194, 247, 249';
      }
      if ($char == 'x') {
        return '242, 182, 246';
      }
      if ($char == 'X') {
        return '188, 222, 193';
      }
      if ($char == 'y') {
        return '188, 194, 183';
      }
      if ($char == 'Y') {
        return '197, 195, 197';
      }
      if ($char == 'z') {
        return '187, 249, 240';
      }
      if ($char == 'Z') {
        return '233, 231, 242';
      }
      if ($char == '0') {
        return '195, 184, 218';
      }
      if ($char == '1') {
        return '232, 180, 196';
      }
      if ($char == '2') {
        return '191, 193, 196';
      }
      if ($char == '3') {
        return '185, 186, 186';
      }
      if ($char == '4') {
        return '191, 247, 180';
      }
      if ($char == '5') {
        return '187, 199, 248';
      }
      if ($char == '6') {
        return '248, 198, 184';
      }
      if ($char == '7') {
        return '243, 195, 184';
      }
      if ($char == '8') {
        return '232, 192, 208';
      }
      if ($char == '9') {
        return '239, 197, 183';
      }
      if ($char == '/') {
        return '199, 187, 241';
      }
      if ($char == '+') {
        return '195, 216, 223';
      }
      if ($char == '=') {
        return '193, 211, 184';
      }
    }
  }

