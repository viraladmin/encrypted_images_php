<?php
  require_once '../vendor/autoload.php'; // Adjust the path based on your project's file structure
  use encrypted_images_php\decryption\images;

  // Define the JSON file for storing user data
  $userDataFile = 'json/users.json';

  // Process login form data
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have a file input field named 'image' in your login form
    $uploadedImage = $_FILES['image']['tmp_name'];

    // Use the `decryptFromImage` method to decrypt the uploaded image
    $encryptionKey = 'your_secret_key';
    $imageDecryptor = new images();
    $decryptedText = $imageDecryptor->decryptFromImage($uploadedImage, $encryptionKey);

    // Extract user-provided string and read user data from the JSON file
    $userStringParts = explode('=', $decryptedText);
    $users = json_decode(file_get_contents($userDataFile), true) ?? [];

    // Find a matching user in the JSON data. Change this based on what data you collect and encrypt.
    foreach ($users as $user) {
      if (
        hash_equals($user['username'], $userStringParts[0]) &&
        hash_equals($user['lastname'], $userStringParts[1]) &&
        hash_equals($user['year_of_birth'], $userStringParts[2]) &&
        hash_equals($user['firstname'], $userStringParts[3])
      ) {
        // Set a session for the user
        session_start();
        $_SESSION['username'] = $user['username'];
        // log user in
        echo 'Logged in. Welcome, ', $_SESSION['username'];
        exit;
      }
    }
    echo "Login failed. Invalid image or data.";
  }
?>
  <!-- HTML form for user login -->
  <form method="post" enctype="multipart/form-data">
    <input type="file" name="image" accept="image/*" required><br>
    <button type="submit">Log In</button>
  </form>