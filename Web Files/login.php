<?php
// start a session
session_start();

// connect to the database
$db = mysqli_connect("localhost", "root", "backpack10", "users");

// check if the form is submitted
if (isset($_POST["login"])) {
  // get the form data
  $username = $_POST["username"];
  $password = $_POST["password"];

  // validate the form data
  if (empty($username) || empty($password)) {
    // display an error message
    echo "Please enter your username and password.";
  } else {
    // check if the user exists in the database
    $sql = "SELECT * FROM security WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result) == 1) {
      // set the session variable
      $_SESSION["username"] = $username;
      // redirect to the home page
      header("Location: index.php");
    } else {
      // display an error message
      echo "Invalid username or password.";
    }
  }
}
// Create a container div for the buttons and set its position, width and height
// Adjust width +100px per extra button added
echo "<div style='position: absolute; top: 0; right: 0; width: 450px; height: 100px;'>";

// Create the buttons and set their margin and onclick attributes
echo "<button style='margin: 10px;' onclick='location.href=\"index.php\"'>Home</button>";
echo "<button style='margin: 10px;' onclick='location.href=\"register.php\"'>Register</button>";
echo "</div>";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
</head>
<body>
  <h1>Login Page</h1>
  <form method="post" action="login.php">
    <p>Username: <input type="text" name="username"></p>
    <p>Password: <input type="password" name="password"></p>
    <p><input type="submit" name="login" value="Login"></p>
  </form>
</body>
</html>