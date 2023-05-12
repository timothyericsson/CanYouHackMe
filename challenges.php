<?php
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
?>

todo... for now try these values as flags. You should not be able to reuse them
<br>
<br>
apple
<br>
banana
<br>
potato
