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
 if ($flag == "apple" || $flag == "b4nana" || $flag == "p0tato" || $flag == "tr4v3rs4l" || $flag == "br0kenupload" || $flag == "inj3cti0n" || $flag == "c00lk1d" || $flag == "1ntrud3r") {
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
} else {
 // redirect to the login page
 header("Location: login.php");
}


?>
<!DOCTYPE html>
<html>
<head>
 <title>Flag Page</title>
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
 <div style="text-align: center;">
 <br>
 <h1>Flag Page</h1>
 <p>Welcome, <?php echo $username; ?>. Your current points are: <?php echo $points; ?>.</p>
 <form method="post" action="flag.php">
 <p>Enter a flag: <input type="text" name="flag"></p>
 <p><input type="submit" name="submit" value="Submit"></p>
 </form>
 </div>
 <div class="button-container">
 <!-- attributes -->
 <button class="button" onclick='location.href="index.php"'>Home</button>
 <button class="button" onclick='location.href="profile.php"'>Profile</button>
 </div>
</body>
</html>
