<?php
  require_once '../vendor/autoload.php';
  use encrypted_images_php\decryption\images;

  if (isset($_FILES['uploaded_image']) && $_FILES['uploaded_image']['error'] === 0) {
    // Define the encryption key
    $key = isset($_GET['key']) ? strip_tags($_GET['key']) : "welovenfts"; // Default key if not provided

    // Get the temporary file path of the uploaded image
    $tempFilePath = $_FILES['uploaded_image']['tmp_name'];

    // Create an instance of the `images` class
    $decryption = new images();

    // When uploading files directly one must use 'web'
    $decrypted = $decryption->decryptFromImage($tempFilePath, $key, 'web');
    echo $decrypted;
  }
?>
  <form method="post" enctype="multipart/form-data">
    <label for="uploaded_image">Upload example Select the encrypted image to decrypt:</label>
    <input type="file" name="uploaded_image" id="uploaded_image" accept="image/*" required>
    <br><br>
    <label for="key">Encryption Key (optional):</label>
    <input type="text" name="key" id="key">
    <br><br>
    <input type="submit" value="Upload and Decrypt">
  </form>