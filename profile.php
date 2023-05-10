<?php
// Define database parameters
$db_host = "localhost"; // The hostname of the database server
$db_user = "root"; // The username of the database user
$db_pass = "backpack10"; // The password of the database user
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

// Display the title
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

// Query the database for the user's submitted flags
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

// Create a container div for the buttons and set its position, width and height
// Adjust width +100px per extra button added
echo "<div style='position: absolute; top: 0; right: 0; width: 450px; height: 100px;'>";

// Create the buttons and set their margin and onclick attributes
echo "<button style='margin: 10px;' onclick='location.href=\"index.php\"'>Home</button>";
echo "<button style='margin: 10px;' onclick='location.href=\"challenges.php\"'>Challenges</button>";
echo "<button style='margin: 10px;' onclick='location.href=\"leaderboard.php\"'>Leaderboard</button>";
echo "<button style='margin: 10px;' onclick='location.href=\"profile.php\"'>My Profile</button>";
echo "<button style='margin: 10px;' onclick='location.href=\"logout.php\"'>Logout</button>";
echo "</div>";

} else {
// Display a login button that redirects to a login page
echo "<div style='position: absolute; top: 0; right: 0; width: 450px; height: 100px;'>";

// Create the buttons and set their margin and onclick attributes
echo "<button style='margin: 10px;' onclick='location.href=\"login.php\"'>Login</button>";
echo "</div>";
}
?>