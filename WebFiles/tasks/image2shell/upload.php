<?php
// Check if the user is logged in
session_start();
if (!isset($_SESSION['username'])) {
 header("Location: login.php");
 exit;
}

// Get the user's name from the PHPSESSID cookie
$name = $_SESSION['username'];

// Update the user's image if a new image is uploaded
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
 $image = $_FILES['image']['tmp_name'];
 $targetDirectory = 'uploads/';
 $targetPath = $targetDirectory . $_FILES['image']['name'];
 $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];

 // Validate the image file and move it to the target directory
 if (in_array($_FILES['image']['type'], $allowedMimeTypes) && move_uploaded_file($image, $targetPath)) {
 $imagePath = $targetPath;
 } else {
 echo "Please upload a valid image file (JPG, JPEG, PNG, GIF).";
 }
}

// Get the user's image file if it exists, or use a default blank image
$imagePath = 'uploads/' . $_FILES['image']['name'];
if (!file_exists($imagePath)) {
 $imagePath = 'default.jpg'; // Path to the default blank image
}
?>

<!DOCTYPE html>
<html>
<head>
 <title>User Profile</title>
 <!-- Style the page -->
 <link rel="stylesheet" href="/style2.css">
</head>
<body>
 <div class="container">
 <!-- Display the welcome message -->
 <header>
 <h1>Welcome, <?php echo htmlspecialchars($name); ?>!</h1>
 </header>
 <!-- Display the user's image and the upload form -->
 <main>
 <div class="profile-image">
 <img src="<?php echo $imagePath; ?>" width="200" height="200" alt="User Image">
 </div>
 <div class="upload-form">
 <h2>Upload Profile Picture</h2>
 <form method="POST" enctype="multipart/form-data">
 <input type="file" name="image">
 <input type="submit" value="Upload">
 </form>
 </div>
 </main>
 <!-- Display the home link -->
 <footer>
 <a href="/index.php" class="home-link">Home</a>
 </footer>
 </div>
</body>
</html>
