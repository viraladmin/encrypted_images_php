# Encrypted Images PHP

**Author**: Bruce Bates  
**Copyright**: 2023  
**X**: @thebrucebates  
**Website**: [https://encryptedimages.art](https://encryptedimages.art)

## License

Encrypted Images PHP is distributed under the MIT License. [![License](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)

## Installation

```text
composer require viraladmin/encrypted_images_php
```
## Table of Contents

1. [Introduction](#introduction)
2. [Supported Characters](#supported-characters)
3. [Min and Max Characters](#min-and-max-characters)
4. [Security](#security)
5. [Watermarks](#watermarks)
6. [Functions](#functions)
   - [Text Encryption](#text-encryption)
   - [Image Encryption](#image-encryption)
   - [Text Decryption](#text-decryption)
   - [Image Decryption](#image-decryption)

## Introduction

Encrypted Images PHP is a PHP library designed for encrypting text into images and decrypting images back into text.

## Supported Characters

The library supports the following characters:

- Lowercase letters (a-z)
- Uppercase letters (A-Z)
- Equal sign (=)
- Backslash (\)
- Plus sign (+)

Please note that space (" ") is not included in the supported characters.

## Min and Max Characters

- **Minimum Characters**: 10
- **Maximum Characters**: 5,006,512 (memory exhaustion)
  - Please note that memory exhaustion may occur much earlier when converting encrypted text to images.

## Security

This library is secure (as much as php can be) against encryption timing attacks.

## Watermarks

Encrypted Images PHP supports various watermarks that you can embed into the images. You can choose from the following watermark types:

- Ethereum
- Bitcoin
- Cardano
- None

## Functions

### Text Encryption

Encrypt a string using AES-128-CBC encryption and verify integrity to protect against timing attacks.

**Parameters:**

- `$str` (string): The input string to be encrypted.
- `$key` (string, optional): The encryption key. Default is "welovenfts".

**Returns:**

- (string|false): The encrypted string or false if encryption fails or integrity check fails.

**Example Usage:**

```php
require_once 'vendor/autoload.php';
use encrypted_images_php\encryption\text;

// Initialize the class
$textEncryptor = new text();

// Encrypt a string
$encryptedString = $textEncryptor->encrypt("Your secret message", 'encryption-key');

// Check if encryption was successful
if ($encryptedString !== false) {
    // Proceed with the encrypted data
} else {
    // Handle the encryption failure
}
```
### Image Encryption

Encrypt a string and embed it into an image with a watermark.

**Parameters:**

- `$str` (string): The input string to be encrypted.
- `$watermark` (string, optional): The watermark type (e.g., 'ethereum', 'bitcoin', 'cardano').
- `$key` (string, optional): The encryption key. Default is "welovenfts".
- `$r` (int, optional): Top gradient adjustment.
- `$g` (int, optional): Middle gradient adjustment.
- `$b` (int, optional): Bottom gradient adjustment.

**Returns:**

- (string): Base64-encoded image containing the encrypted data.

**Example Usage:**

```php
require_once 'vendor/autoload.php';
use encrypted_images_php\encryption\images;

// Initialize the class
$imageEncryptor = new images();

// Encrypt a string and embed it into an image with a watermark
$imageData = $imageEncryptor->encryptToImage("Your secret message", 'ethereum', 'encryption-key', 100, 134, 131);

// Display or use the base64-encoded image data as needed
echo '<img src="data:image/png;base64,' . $imageData . '" alt="Encrypted Image" />';
```

### Text Decryption

Decrypt an encrypted text and return the original plaintext.

**Parameters:**

- `$text` (string): The encrypted text to be decrypted.
- `$key` (string, optional): The decryption key. Default is "welovenfts".

**Returns:**

- (string|array): Original plaintext or an error message.

**Example Usage:**

```php
require_once 'vendor/autoload.php';
use encrypted_images_php\decryption\text;

// Initialize the class
$textDecryptor = new text();

// Decrypt an encrypted text
$decryptedText = $textDecryptor->decrypt($encryptedText, 'decryption-key');

if ($decryptedText !== 'error') {
    // Proceed with the original plaintext
} else {
    // Handle the decryption error
}
```

### Image Decryption

Decrypt data from an image and return the original plaintext.

**Parameters:**

- `$fileData` (string): The image data or file path.
- `$key` (string, optional): The decryption key. Default is "welovenfts".
- `$datatype` (string, optional): The data type, either "web" or "json".

**Returns:**

- (string|array): An error message if decryption fails or the original plaintext.

**Example Usage:**

```php
require_once 'vendor/autoload.php';
use encrypted_images_php\decryption\images;

// Initialize the class
$imageDecryptor = new images();

// Decrypt data from an image
$decryptedText = $imageDecryptor->decryptFromImage($imageData, 'decryption-key', 'web');

if (!is_string($decryptedText)) {
    // Proceed with the original plaintext
} else {
    // Handle the decryption error
}
```
