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
?>
<!DOCTYPE html>
<html>
<head>
 <title>Login</title>
 <!-- Add some CSS to style the page -->
 <style>
 /* Set the background color and font family for the body */
 body {
  background-color: lightblue;
  font-family: Verdana;
 }
 /* Set the color and font family for the h1 */
 h1 {
  color: white;
  font-family: Arial;
 }
 /* Set the position, width and height for the container div */
 .container {
  position: absolute;
  top: 0;
  right: 0;
  width: 500px;
  height: 100px;
 }
 /* Set the margin and onclick attributes for the buttons */
 .button {
  margin: 10px;
 }
 /* Set the position, width, height, margin, border and padding for the box div */
 .box {
  position: absolute;
  width: 400px;
  height: 200px;
  margin-left: -200px;
  margin-top: -150px;
  left: 50%;
  top: 50%;
  border: 2px solid white;
  padding: 20px;
 }
 </style>
</head>
<body>
 <div class="container">
 <!-- Create the buttons and set their onclick attributes -->
 <button class="button" onclick='location.href="index.php"'>Home</button>
 <button class="button" onclick='location.href="register.php"'>Register</button>
 </div>
 <div class="box">
 <!-- Display the title -->
 <h1>Login</h1>
 <!-- Create the form and set its method and action attributes -->
 <form method="post" action="login.php">
 <!-- Create the input fields and labels -->
 <p>Username: <input type="text" name="username"></p>
 <p>Password: <input type="password" name="password"></p>
 <!-- Create the submit button -->
 <p><input type="submit" name="login" value="Login"></p>
 </form>
 </div>
</body>
</html>
