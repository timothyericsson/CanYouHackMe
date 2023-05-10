<?php
// Define database parameters
$db_host = "localhost"; // The hostname of the database server
$db_user = "root"; // The username of the database user
$db_pass = "password"; // The password of the database user
$db_name = "users"; // The name of the database

// Create a new mysqli object
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check for connection errors
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

// Start the session
session_start();

// Check if the user is already logged in
if (isset($_SESSION["username"])) {
// Display a welcome message and a logout button
echo "<div style='text-align: right;'>";
echo "Welcome, " . $_SESSION["username"] . "! ";
echo "<a href='logout.php'>Logout</a>";
echo "</div>";
} else {
// Display a login button that redirects to a login page
echo "<div style='text-align: right;'>";
echo "<a href='login.php'>Login</a>";
echo "</div>";
}

// Display some content for the website
echo "<h1>This is a simple example website</h1>";
echo "<p>It has a login button on the top right</p>";
echo "<p>It also connects to a MySQL database</p>";
?>
