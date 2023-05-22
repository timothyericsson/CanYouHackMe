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
    <style>
        .logout-button {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($name); ?>!</h1>
    <img src="<?php echo $imagePath; ?>" width="200" height="200" alt="User Image">
    <a href="/index.php" class="logout-button">Home</a>
    <h2>Change Profile Picture</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="image">
        <input type="submit" value="Upload">
    </form>
</body>
</html>


<!-- make sure that /uploads/ is chmod 777 -->