<?php
// Define database parameters
$db_host = "localhost"; 
$db_user = "root"; 
$db_pass = "backpack10"; 
$db_name = "users"; 

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

// Display the title
echo "<div style='text-align: center;'>";
echo "<h2>This is " . $_SESSION["username"] . "'s profile. </h2>";

// Query the database for the user's points
$sql = "SELECT points FROM security WHERE username = '" . $_SESSION["username"] . "'";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
// Fetch the points as an associative array
$row = mysqli_fetch_assoc($result);

// Display the points
echo "<p>You have " . $row["points"] . " points. </p>";
}

// Query the database 
$sql = "SELECT flag FROM submissions WHERE username = '" . $_SESSION["username"] . "'";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
  // Display a heading for the flags
  echo "<h3>Flags you have submitted:</h3>";
  // Create an unordered list for the flags
  echo "<ul>";
  // Loop through the result set and display each flag as a list item
  while ($row = mysqli_fetch_array($result)) {
    echo "<li>" . $row["flag"] . "</li>";
  }
  // Close the unordered list
  echo "</ul>";
} else {	
    // Display an error message	
    echo "<p>Error: " . mysqli_error($conn) . ". </p>";	
  }

echo "</div>";

} else {
// login button
echo "<div style='position: absolute; top: 0; right: 0; width: 450px; height: 100px;'>";

// attributes
echo "<button style='margin: 10px;' onclick='location.href=\"login.php\"'>Login</button>";
echo "</div>";
}
?>
<!DOCTYPE html>
<html>
<head>
 <title>Profile</title>
 <!-- Style -->
 <style>
 /* bg */
 body {
 background-color: lightblue;
 font-family: Verdana;
 }
 /* h1 */
 h1 {
 color: white;
 font-family: Arial;
 text-shadow: 2px 2px 4px #000000;
 text-align: center;
 }
 /* div */
 .button-container {
 display: flex;
 justify-content: center;
 align-items: center;
 margin-top: 20px;
 }
 /* buttons */
 .button {
 margin: 10px;
 border-radius: 10px;
 background-color: #007bff;
 color: white;
 font-weight: bold;
 padding: 10px 20px;
 transition: transform 0.3s;
 }
 /* button hover effect */
 .button:hover {
 transform: scale(1.1);
 }
 </style>
</head>
<body>
 <div class="button-container">
 <!-- attributes -->
 <button class="button" onclick='location.href="index.php"'>Home</button>
 <button class="button" onclick='location.href="flag.php"'>Submit Flag</button>
 </div>
</body>
</html>
