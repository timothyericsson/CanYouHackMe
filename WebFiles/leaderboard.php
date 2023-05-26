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
 /* button container div */
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
 /* Set the border and style for the table */
 table {
 border-collapse: collapse;
 margin: auto;
 box-shadow: 5px 5px 15px #000000;
 }
 /* table header */
 th {
 color: white;
 font-weight: bold;
 background-color: #007bff;
 padding: 15px;
 }
 /* table data */
 td {
 color: black;
 padding: 15px;
 border-bottom: 1px solid white;
 }
 </style>
</head>
<body>
 <h1>Leaderboard</h1>
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
 <div class="button-container">
 <!-- Create the buttons and set their onclick attributes -->
 <button class="button" onclick='location.href="index.php"'>Home</button>
 <button class="button" onclick='location.href="logout.php"'>Logout</button>
 </div>
</body>
</html>
