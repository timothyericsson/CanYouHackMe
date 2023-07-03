<!DOCTYPE html>
<html>
<head>
  <title>CanYouHack.Me</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* Styles for the header and navigation */
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 40px;
      background-color: lightblue;
      color: #fff;
    }

    nav {
      display: flex;
    }

    nav a {
      margin-right: 10px;
      color: #fff;
      text-decoration: none;
    }

    /* Rest of the styles */
    /* ... */

    /* Styles for the welcome section */
    .welcome {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      padding: 40px;
    }

    .challenges {
      flex: 1;
      margin-right: 50px;
    }

    .welcome p {
      margin-bottom: 20px;
    }

    /* Styles for the additional sections */
    .section {
      flex: 1;
      margin-left: 50px;
    }

    .section h2 {
      font-size: 24px;
      margin-bottom: 10px;
    }

    .section p {
      font-size: 16px;
      line-height: 1.5;
    }

    /* Styles for the footer */
    footer {
      padding: 20px;
      text-align: center;
      background-color: lightblue;
      color: #fff;
    }

    footer a {
      color: #fff;
    }

    /* Custom styles for challenge buttons */
    .challenges-list li a {
      display: inline-block;
      padding: 8px 12px;
      margin-bottom: 10px;
      background-color: lightgray;
      color: #000;
      text-decoration: none;
      border-radius: 5px;
      width: 25%; /* Reduce the width to approximately a quarter */
    }
  </style>
</head>
<body>
  <?php
    // Start the session
    session_start();
  ?>
  <header>
    <h1>CanYouHack.Me</h1>
    <nav>
      <a href="index.php">Home</a>
      <a href="leaderboard.php">Leaderboard</a>
      <?php
        // Check if the user is not logged in
        if (!isset($_SESSION["username"])) {
          // Show the login and register buttons
          echo "<a href=\"login.php\">Login</a>";
          echo "<a href=\"register.php\">Register</a>";
        } else {
          // Show the My Profile and logout buttons
          echo "<a href=\"profile.php\">My Profile</a>";
          echo "<a href=\"logout.php\">Logout</a>";
        }
      ?>
    </nav>
  </header>

  <br>
  
  <div class="container">
    <div class="welcome">
      <div class="challenges">
        <?php
          // Check if the user is not logged in
          if (!isset($_SESSION["username"])) {
            echo "<h2>You are not signed in.</h2>";
          } else {
            // Display the welcome message
            echo "<h2>Welcome, " . $_SESSION["username"] . "!</h2>";
          }
        ?>
        <p>Choose a challenge to test your hacking skills.</p>
        <ul class="challenges-list">
          <li><a href="/tasks/LFI/easy-lfi.php">LFI & Log Poison</a></li>
          <li><a href="/tasks/mysql/item.php">MySQL Injection</a></li>
          <li><a href="/tasks/mysql/two/index.php">MySQL Injection #2</a></li>
          <li><a href="/tasks/image2shell/upload.php">Image2Shell</a></li>
          <li><a href="/tasks/RCE/rce.php">Remote Code Execution</a></li>
          <li><a href="/tasks/CSRF/easy-csrf.php">Cross Site Request Forgery</a></li>
          <li><a href="/tasks/BruteForce/brute.php">Login BruteForce</a></li>
          <li><a href="/tasks/DirectoryTraversal.php">Directory Traversal</a></li>
          <li><a href="/tasks/BrokenAuthentication.php">Broken Authentication</a></li>
          <li><a href="/tasks/XSS/reflected.php?name=banana">XSS Introduction</a></li>
          <li><a href="/tasks/XSS/reflected2.php">XSS Evasion</a></li>
        </ul>
      </div>

      <div class="section">
        <section>
          <h2>Warning!</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </p>
        </section>

        <section>
          <h2>Disclaimer</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </p>
        </section>

        <section>
          <h2>General Instructions</h2>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </p>
        </section>
      </div>
    </div>
  </div>

  <footer>
    <p>Open Source Pentesting Training - <a href="https://github.com/timothyericsson/CanYouHackMe/" style="color: white;">CanYouHack.Me</a></p>
  </footer>
</body>
</html>
