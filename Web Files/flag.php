<?php
// start a session
session_start();

// connect to the database
$db = mysqli_connect("localhost", "root", "backpack10", "users");

// check if the user is logged in
if (isset($_SESSION["username"])) {
  // get the username from the session
  $username = $_SESSION["username"];
  // get the points from the database
  $sql = "SELECT points FROM security WHERE username = '$username'";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_assoc($result);
  $points = $row["points"];
  // check if the form is submitted
  if (isset($_POST["submit"])) {
    // get the form data
    $flag = $_POST["flag"];

    // validate the form data
    if (empty($flag)) {
      // display an error message
      echo "Please enter a flag.";
    } else {
      // check if the flag and the username already exist in the submissions table
      $sql = "SELECT * FROM submissions WHERE flag = '$flag' AND username = '$username'";
      $result = mysqli_query($db, $sql);

      // check if the query was successful
      if ($result) {
        // check if there are any rows returned
        if (mysqli_num_rows($result) > 0) {
          // display an error message that the flag has already been submitted
          echo "Sorry, you have already submitted this flag.";
        } else {
          // check if the flag is valid
          if ($flag == "apple" || $flag == "banana" || $flag == "potato" || $flag == "tr4v3rs4l" || $flag == "c00lk1d") {
            // insert a new row in the submissions table with the flag, username and current timestamp
            $sql = "INSERT INTO submissions (flag, username, timestamp) VALUES ('$flag', '$username', NOW())";
            $result = mysqli_query($db, $sql);

            // check if the query was successful
            if ($result) {
              // increase the points by 10
              $sql = "UPDATE security SET points = points + 10 WHERE username = '$username'";
              // echo the result of the update query
              $result = mysqli_query($db, $sql);
              // update the points variable
              $points = $points + 10;
              // display a success message
              echo "You got it right! Your points are increased by 10.";
            } else {
              // display an error message that the submission could not be inserted
              echo "Error: " . mysqli_error($db) . ". ";
            }
          } else {
            // display an error message that the flag is not valid
            echo "Sorry, that's not a valid flag.";
          }
        }
      } else {
        // display an error message that the query failed
        echo "Error: " . mysqli_error($db) . ". ";
      }
    }
  }
// Create a container div for the buttons and set its position, width and height
// Adjust width +100px per extra button added
echo "<div style='position: absolute; top: 0; right: 0; width: 500px; height: 100px;'>";

// Create the buttons and set their margin and onclick attributes
echo "<button style='margin: 10px;' onclick='location.href=\"index.php\"'>Home</button>";
echo "<button style='margin: 10px;' onclick='location.href=\"challenges.php\"'>Challenges</button>";
echo "<button style='margin: 10px;' onclick='location.href=\"leaderboard.php\"'>Leaderboard</button>";
echo "<button style='margin: 10px;' onclick='location.href=\"profile.php\"'>My Profile</button>";
echo "<button style='margin: 10px;' onclick='location.href=\"logout.php\"'>Logout</button>";
echo "</div>";
} else {
  // redirect to the login page
  header("Location: login.php");
}


?>

<!DOCTYPE html>
<html>
<head>
  <title>Flag Page</title>
</head>
<body>
    <br>
  <h1>Flag Page</h1>
  <p>Welcome, <?php echo $username; ?>. Your current points are: <?php echo $points; ?>.</p>
  <form method="post" action="flag.php">
    <p>Enter a flag: <input type="text" name="flag"></p>
    <p><input type="submit" name="submit" value="Submit"></p>
  </form>
</body>
</html>