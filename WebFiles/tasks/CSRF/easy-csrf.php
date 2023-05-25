<?php
// Establish a connection to the MySQL database
$host = "localhost"; // Replace with your MySQL server host
$db_user = "root"; // Replace with your MySQL username
$db_pass = "backpack10"; // Replace with your MySQL password
$db_name = "users"; // Replace with your MySQL database name

$conn = mysqli_connect($host, $db_user, $db_pass, $db_name);
if (!$conn) {
 die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// Start a session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
 // Check if the new password is provided
 if (isset($_GET["new_password"])) {
  $newPassword = $_GET["new_password"];

  // Check if the user is logged in
  if (isset($_SESSION['username'])) {
   // Update the password in the database for the currently logged-in user
   $query = "UPDATE security SET password = '" . mysqli_real_escape_string($conn, $newPassword) . "' WHERE username = '" . mysqli_real_escape_string($conn, $_SESSION['username']) . "'";
   $result = mysqli_query($conn, $query);

   if ($result) {
    echo "Password reset successfully.";
   } else {
    echo "Error updating password: " . mysqli_error($conn);
   }
  } else {
   echo "Please log in first.";
  }
 } else {
  echo "Please provide a new password.";
 }
}
?>

<!DOCTYPE html>
<html>
<head>
 <title>Password Reset</title>
 <style>
 body {
 background-color: #f2f2f2;
 color: #333;
 font-family: Arial, sans-serif;
 margin: 0;
 padding: 20px;
 }

 h1 {
 color: #333;
 text-align: center;
 }

 .container {
 max-width: 500px;
 margin: 0 auto;
 background-color: #fff;
 padding: 20px;
 border-radius: 5px;
 box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
 }

 .button {
 display: block;
 position: absolute;
 top: 20px;
 right: 20px;
 padding: 10px;
 background-color: #333;
 color: #fff;
 border: none;
 border-radius: 5px;
 cursor: pointer;
 text-align: center;
 text-decoration: none;
 }
 </style>
</head>
<body>
 <div class="container">
 <a class="button" href="/index.php">Go back to Home</a>
 <h1>Password Reset</h1>
 <form action="" method="GET">
 <label for="new_password">New Password:</label>
 <input type="password" id="new_password" name="new_password" required><br>

 <input type="submit" value="Reset Password">
 </form>
 </div>
</body>
</html>
