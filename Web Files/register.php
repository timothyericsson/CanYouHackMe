<?php
// connect to the database
$db = mysqli_connect("localhost", "root", "backpack10", "users");

// check if the form is submitted
if (isset($_POST["register"])) {
  // get the form data
  $username = $_POST["username"];
  $password = $_POST["password"];

  // validate the form data
  if (empty($username) || empty($password)) {
    // display an error message
    echo "Please fill in all the fields.";
  } else {
    // check if the username or email already exists
    $sql = "SELECT * FROM security WHERE username = '$username'";
    $result = mysqli_query($db, $sql);
    if (mysqli_num_rows($result) > 0) {
      // display an error message
      echo "The username or email is already taken.";
    } else {
      // insert the user into the database
      $sql = "INSERT INTO security (username, password) VALUES ('$username', '$password')";
      mysqli_query($db, $sql);
      // display a success message
      echo "You have registered successfully.";
      // redirect the user to the login page after three seconds
      header("Refresh: 2; URL=login.php");
    }
  }
}
// Create a container div for the buttons and set its position, width and height
// Adjust width +100px per extra button added
echo "<div style='position: absolute; top: 0; right: 0; width: 450px; height: 100px;'>";

// Create the buttons and set their margin and onclick attributes
echo "<button style='margin: 10px;' onclick='location.href=\"index.php\"'>Home</button>";
echo "<button style='margin: 10px;' onclick='location.href=\"login.php\"'>Login</button>";
echo "</div>";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register Page</title>
</head>
<body>
  <h1>Register Page</h1>
  <form method="post" action="register.php">
    <p>Username: <input type="text" name="username"></p>
    <p>Password: <input type="password" name="password"></p>
    <p><input type="submit" name="register" value="Register"></p>
  </form>
</body>
</html>