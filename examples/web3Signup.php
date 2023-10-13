<?php
  require_once '../vendor/autoload.php'; // Adjust the path based on your project's file structure
  use encrypted_images_php\encryption\images;

  // Define the JSON file for storing user data
  $userDataFile = './json/users.json';

  // Create the JSON file if it doesn't exist
  if (!file_exists($userDataFile)) {
    file_put_contents($userDataFile, '[]');
  }

  // Process sign-up form data
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $yearOfBirth = $_POST['year_of_birth'];
    $monthOfBirth = $_POST['month_of_birth'];

    // Combine user data as specified (adjusted the order)
    $userString = "$username=$lastname=$yearOfBirth=$firstname";

    // Encrypt user string
    $encryptionKey = 'your_secret_key';
    $imageEncryptor = new images();
    $encryptedImage = $imageEncryptor->encryptToImage($userString, 'ethereum', $encryptionKey);

    // Serve the image to the user for download
    echo '<img src="data:image/png;base64,'.$encryptedImage.'"><br><Br>';
    echo 'Save this file. This is your downlaod information. Do not lose this file. It cannot be recreated.';

    // Store user data in JSON (including month of birth)
    $userData = [
      'username' => $username,
      'firstname' => $firstname,
      'lastname' => $lastname,
      'year_of_birth' => $yearOfBirth,
      'month_of_birth' => $monthOfBirth,
    ];

    $users = json_decode(file_get_contents($userDataFile), true) ?? [];
    $users[] = $userData;
    file_put_contents($userDataFile, json_encode($users, JSON_PRETTY_PRINT));
    exit; // End the script
}
?>
  <!-- HTML form for user sign-up -->
  <form method="post">
    <input type="text" name="username" placeholder="Username" required>
    <input type="text" name="firstname" placeholder="First Name" required>
    <input type="text" name="lastname" placeholder="Last Name" required>
    <input type="text" name="year_of_birth" placeholder="Year of Birth" required>
    <input type="text" name="month_of_birth" placeholder="Month of Birth" required>
    <button type="submit">Sign Up</button>
  </form>