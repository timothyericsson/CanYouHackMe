<?php
// connect to the database
$db = mysqli_connect("localhost", "root", "backpack10", "users");

// get the users with the most points
$sql = "SELECT username, points FROM security WHERE points >= 11 ORDER BY points DESC";
$result = mysqli_query($db, $sql);
?>
<!DOCTYPE html>
<html>
<head>
 <title>Leaderboard</title>
 <!-- Style -->
 <style>
 /* bg  */
 body {
  background-color: lightblue;
  font-family: Verdana;
 }
 /* h1 */
 h1 {
  color: white;
  font-family: Arial;
 }
 /* container div */
 .container {
  position: absolute;
  top: 0;
  right: 0;
  width: 500px;
  height: 100px;
 }
 /* buttons */
 .button {
  margin: 10px;
 }
 /* Set the border */
 table {
  border: 2px solid white;
  padding: 10px;
  text-align: center;
 }
 /* table header */
 th {
  color: white;
  font-weight: bold;
 }
 </style>
</head>
<body>
 <h1>Leaderboard</h1>
 <div class="container">
 <!-- Create the buttons and set their onclick attributes -->
 <button class="button" onclick='location.href="index.php"'>Home</button>
 <button class="button" onclick='location.href="logout.php"'>Logout</button>
 </div>
 <table>
 <tr>
 <th>Rank</th>
 <th>Username</th>
 <th>Points</th>
 </tr>
 <?php
 // initialize the rank variable
 $rank = 1;
 // loop through the result set and display the users
 while ($row = mysqli_fetch_assoc($result)) {
 // get the username and points from the row
 $username = $row["username"];
 $points = $row["points"];
 // display the rank, username and points in a table row
 echo "<tr>";
 echo "<td>$rank</td>";
 echo "<td>$username</td>";
 echo "<td>$points</td>";
 echo "</tr>";
 // increment the rank by 1
 $rank++;
 }
 ?>
 </table>
</body>
</html>
