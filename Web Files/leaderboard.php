<?php
// connect to the database
$db = mysqli_connect("localhost", "root", "backpack10", "users");

// get the users with the most points
$sql = "SELECT username, points FROM security WHERE points >= 11 ORDER BY points DESC";
$result = mysqli_query($db, $sql);

// Create a container div for the buttons and set its position, width and height
// Adjust width +100px per extra button added
echo "<div style='position: absolute; top: 0; right: 0; width: 500px; height: 100px;'>";

// Create the buttons and set their margin and onclick attributes
echo "<button style='margin: 10px;' onclick='location.href=\"index.php\"'>Home</button>";
echo "<button style='margin: 10px;' onclick='location.href=\"logout.php\"'>Logout</button>";
echo "</div>";
?>

<!DOCTYPE html>
<html>
<head>
    <br>
  <title>Leaderboard Page</title>
</head>
<body>
  <h1>Leaderboard Page</h1>
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