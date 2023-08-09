<?php
// Set the name and value of the cookie
$cookie_name = "admin";
$cookie_value = "admin=no";

// Encode the value using base64
$encoded_value = base64_encode($cookie_value);

// Set the cookie with the encoded value
setcookie($cookie_name, $encoded_value, time() + (86400 * 30), "/"); // 86400 = 1 day
?>

<!DOCTYPE html>
<html>
<head>
 <title>Cool Zone</title>
 <style>
 body {
 background-color: #f2f2f2;
 font-family: Arial, sans-serif;
 }

 .container {
 max-width: 800px;
 margin: 0 auto;
 padding: 20px;
 background-color: #fff;
 box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
 }

 h1 {
 color: #333;
 }

 .cool-kids-zone {
 text-align: center;
 margin-top: 30px;
 padding: 20px;
 background-color: #e9e9e9;
 }

 .cool-kids-zone p {
 color: #555;
 font-size: 18px;
 margin-bottom: 10px;
 }

 .btn {
 display: inline-block;
 padding: 8px 12px;
 background-color: #555;
 color: #fff;
 text-decoration: none;
 border-radius: 4px;
 }

 .btn:hover {
 background-color: #333;
 }
 </style>
</head>
<body>
 <div class="container">
 <h1>Welcome to the Cool Zone</h1>

 <div class="cool-kids-zone">
 <?php
 // Function to decode base64 cookie value
 function decodeCookieValue($cookieValue)
 {
 return base64_decode($cookieValue);
 }

 // Get the value of the admin cookie
 $adminCookie = isset($_COOKIE['admin']) ? decodeCookieValue($_COOKIE['admin']) : 'false';

 // Check if the user is an admin
 if ($adminCookie === 'admin=yes') {
 // User is a cool kid, load the contents of the cool kids zone
 echo "<p>Welcome to the Cool Kids Zone! Flag: c00lk1d</p>";
 } else {
 // User is not a cool kid
 echo "<p>Sorry, you are not a cool kid.</p>";
 }
 ?>
 </div>
 <br>
 <a class="btn" href="/index.php">Go Home</a>
 </div>
</body>
</html>
