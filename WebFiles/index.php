<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>CanYouHack.Me</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <h1>CanYouHack.Me</h1>
    <nav>
      <a href="index.php">Home</a>
      <a href="leaderboard.php">Leaderboard</a>
      <a href="profile.php">My Profile</a>
      <?php
      // Check if the user is logged in
      if (isset($_SESSION["username"])) {
        // Hide the login button
        echo "<a href=\"login.php\" style=\"display: none;\">Login</a>";
      } else {
        // Show the login button
        echo "<a href=\"login.php\">Login</a>";
      }
      ?>
      <?php
      // Check if the user is not logged in
      if (!isset($_SESSION["username"])) {
        // Hide the logout button
        echo "<a href=\"logout.php\" style=\"display: none;\">Logout</a>";
        // Show the register button
        echo "<a href=\"register.php\">Register</a>";
      } else {
        // Show the logout button
        echo "<a href=\"logout.php\">Logout</a>";
        // Hide the register button
        echo "<a href=\"register.php\" style=\"display: none;\">Register</a>";
      }
      ?>
    </nav>
  </header>
  <br>
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

  // Check if the user is already logged in
  if (isset($_SESSION["username"])) {
    // Display a welcome message
    echo "<div style='text-align: left;'>";
    echo "Welcome, " . $_SESSION["username"] . "! ";

    // Query the database for the user's points
    $sql = "SELECT points FROM security WHERE username = '" . $_SESSION["username"] . "'";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
      // Fetch the points as an associative array
      $row = mysqli_fetch_assoc($result);

      // Display the points
      echo "You have " . $row["points"] . " points. ";
    } else {
      // Display an error message
      echo "Error: " . mysqli_error($conn) . ". ";
    }
    echo "</div>";
  } else {
    // Display a message that says "You are not signed in."
    echo "<div style='text-align: left;'>";
    echo "You are not signed in.";
    echo "</div>";
  }
  ?>
  <br>
  <main>
    <section>
      <h2>Welcome</h2>
      <p>Choose a challenge to test your hacking skills.</p>
      <ul class="challenges">
        <li><a href="/tasks/LFI/easy-lfi.php">LFI</a></li>
        <li><a href="/tasks/mysql/item.php">MySQL</a></li>
        <li><a href="/tasks/XSS/reflected.php?name=banana">XSS Reflected</a></li>
        <li><a href="/tasks/XSS/reflected2.php">XSS Markdown Escaping</a></li>
        <li><a href="/tasks/image2shell/profile.php">Image2Shell</a></li>
        <li><a href="/tasks/RCE/rce.php">RCE</a></li>
        <li><a href="/tasks/CSRF/easy-csrf.php">CSRF</a></li>
        <li><a href="/tasks/BruteForce/brute.php">BruteForce</a></li>
        <li><a href="/tasks/DirectoryTraversal.php">Directory Traversal</a></li>
        <li><a href="/tasks/BrokenAuthentication.php">Broken Authentication</a></li>
      </ul>
    </section>
  </main>
  <footer>
    <p>Open Source Pentesting Training - CanYouHack.Me</p>
  </footer>
</body>
</html>

