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

  namespace encrypted_images_php\charMappings;

  /**
   * Map colors to characters.
   *
   * @param string $color The color in the format 'R, G, B'.
   *
   * @return string The mapped character.
   */
  class charMap {
    protected function getChar($color) {
      if ($color == '204, 180, 194') {
         return 'a';
      }
      if ($color == '255, 255, 255') {
         return 'A';
      }
      if ($color == '197, 186, 201') {
        return 'b';
      }
      if ($color == '221, 206, 212') {
        return 'B';
      }
      if ($color == '181, 185, 193') {
        return 'c';
      }
      if ($color == '184, 201, 223') {
        return 'C';
      }
      if ($color == '224, 218, 192') {
        return 'd';
      }
      if ($color == '185, 191, 195') {
        return 'D';
      }
      if ($color == '181, 197, 198') {
        return 'e';
      }
      if ($color == '193, 206, 255') {
        return 'E';
      }
      if ($color == '252, 193, 211') {
        return 'f';
      }
      if ($color == '183, 192, 229') {
        return 'F';
      }
      if ($color == '180, 191, 192') {
        return 'g';
      }
      if ($color == '187, 219, 189') {
        return 'G';
      }
      if ($color == '195, 187, 234') {
        return 'h';
      }
      if ($color == '182, 216, 189') {
        return 'H';
      }
      if ($color == '197, 183, 248') {
        return 'i';
      }
      if ($color == '200, 182, 204') {
        return 'I';
      }
      if ($color == '255, 235, 196') {
        return 'j';
      }
      if ($color == '194, 186, 228') {
        return 'J';
      }
      if ($color == '199, 238, 239') {
        return 'k';
      }
      if ($color == '208, 247, 234') {
        return 'K';
      }
      if ($color == '244, 214, 189') {
        return 'l';
      }
      if ($color == '187, 243, 239') {
        return 'L';
      }
      if ($color == '188, 231, 238') {
        return 'm';
      }
      if ($color == '187, 197, 227') {
        return 'M';
      }
      if ($color == '186, 240, 191') {
        return 'n';
      }
      if ($color == '187, 198, 206') {
        return 'N';
      }
      if ($color == '205, 193, 184') {
        return 'o';
      }
      if ($color == '191, 187, 197') {
        return 'O';
      }
      if ($color == '194, 200, 206') {
        return 'p';
      }
      if ($color == '195, 183, 229') {
        return 'P';
      }
      if ($color == '182, 219, 196') {
        return 'q';
      }
      if ($color == '238, 216, 184') {
        return 'Q';
      }
      if ($color == '199, 181, 208') {
        return 'r';
      }
      if ($color == '239, 231, 198') {
        return 'R';
      }
      if ($color == '189, 188, 230') {
        return 's';
      }
      if ($color == '242, 192, 230') {
        return 'S';
      }
      if ($color == '199, 199, 199') {
        return 't';
      }
      if ($color == '188, 190, 230') {
        return 'T';
      }
      if ($color == '230, 180, 253') {
        return 'u';
      }
      if ($color == '241, 247, 247') {
        return 'U';
      }
      if ($color == '242, 190, 199') {
        return 'v';
      }
      if ($color == '230, 247, 234') {
        return 'V';
      }
      if ($color == '197, 186, 249') {
        return 'w';
      }
      if ($color == '194, 247, 249') {
        return 'W';
      }
      if ($color == '242, 182, 246') {
        return 'x';
      }
      if ($color == '188, 222, 193') {
        return 'X';
      }
      if ($color == '188, 194, 183') {
        return 'y';
      }
      if ($color == '197, 195, 197') {
        return 'Y';
      }
      if ($color == '187, 249, 240') {
        return 'z';
      }
      if ($color == '233, 231, 242') {
        return 'Z';
      }
      if ($color == '195, 184, 218') {
        return '0';
      }
      if ($color == '232, 180, 196') {
        return '1';
      }
      if ($color == '191, 193, 196') {
        return '2';
      }
      if ($color == '185, 186, 186') {
        return '3';
      }
      if ($color == '191, 247, 180') {
        return '4';
      }
      if ($color == '187, 199, 248') {
        return '5';
      }
      if ($color == '248, 198, 184') {
        return '6';
      }
      if ($color == '243, 195, 184') {
        return '7';
      }
      if ($color == '232, 192, 208') {
        return '8';
      }
      if ($color == '239, 197, 183') {
        return '9';
      }
      if ($color == '199, 187, 241') {
        return '/';
      }
      if ($color == '195, 216, 223') {
        return '+';
      }
      if ($color == '193, 211, 184') {
        return '=';
      }
    }
  }
