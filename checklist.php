<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Skills Page</title>
  <style>
    /* Style the form */
    form {
      margin: 20px;
      padding: 20px;
      border: 1px solid black;
    }

    /* Style the fieldsets */
    fieldset {
      margin: 10px;
      padding: 10px;
      border: 1px solid gray;
    }

    /* Style the legends */
    legend {
      font-weight: bold;
    }

    /* Style the labels */
    label {
      display: inline-block;
      width: 150px;
    }
  </style>
</head>
<body>




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

  // Start the session
  session_start();

  // Check if the user is already logged in
  if (isset($_SESSION["username"])) {
    // Get the username from the session
    $username = $_SESSION["username"];

    // Check if the form was submitted
    if (isset($_POST["submit"])) {
      // Get the values of the checkboxes from the $_POST array
      $web = isset($_POST["web"]) ? $_POST["web"] : array();
      $linux = isset($_POST["linux"]) ? $_POST["linux"] : array();
      $windows = isset($_POST["windows"]) ? $_POST["windows"] : array();
      $activedirectory = isset($_POST["activedirectory"]) ? $_POST["activedirectory"] : array();

      // Join the values of each skill category into a comma-separated string
      $web_skills = implode(",", $web);
      $linux_skills = implode(",", $linux);
      $windows_skills = implode(",", $windows);
      $activedirectory_skills = implode(",", $activedirectory);

      // Create an SQL statement that will insert or update the user's skills in the database
      $sql = "INSERT INTO skills (username, web, linux, windows, activedirectory) VALUES ('$username', '$web_skills', '$linux_skills', '$windows_skills', '$activedirectory_skills') ON DUPLICATE KEY UPDATE web = '$web_skills', linux = '$linux_skills', windows = '$windows_skills', activedirectory = '$activedirectory_skills'";

      // Execute the SQL statement and check for errors
      if ($conn->query($sql) === TRUE) {
        echo "<p>Your skills have been saved.</p>";
      } else {
        echo "<p>Error: " . $conn->error . "</p>";
      }
    }

    // Create an SQL statement that will select the user's skills from the database
    $sql = "SELECT web, linux, windows, activedirectory FROM skills WHERE username = '$username'";

    // Execute the SQL statement and check for errors
    if ($result = $conn->query($sql)) {
      // Fetch the skills as an associative array
      $row = $result->fetch_assoc();

      // Split the comma-separated strings into arrays
      $web_skills = explode(",", $row["web"]);
      $linux_skills = explode(",", $row["linux"]);
      $windows_skills = explode(",", $row["windows"]);
      $activedirectory_skills = explode(",", $row["activedirectory"]);
          } else {
            // Set the skills arrays to empty arrays
            $web_skills = array();
            $linux_skills = array();
            $windows_skills = array();
            $activedirectory_skills = array();
          }
      
          // Close the database connection
          $conn->close();
        } else {
          // Redirect the user to the login page
          header("Location: login.php");
          exit();
        }
        ?>





  <!-- Create a form that contains the checkboxes -->
  <form method="post" action="skills.php">
    <!-- Create a section for Web skills -->
    <fieldset>
      <legend>Web</legend>
      <!-- Create a checkbox for HTML -->
      <label for="html">HTML</label>
      <input type="checkbox" id="html" name="web[]" value="html"><br>
      <!-- Create a checkbox for CSS -->
      <label for="css">CSS</label>
      <input type="checkbox" id="css" name="web[]" value="css"><br>
      <!-- Create a checkbox for JavaScript -->
      <label for="javascript">JavaScript</label>
      <input type="checkbox" id="javascript" name="web[]" value="javascript"><br>
      <!-- Create a checkbox for PHP -->
      <label for="php">PHP</label>
      <input type="checkbox" id="php" name="web[]" value="php"><br>
    </fieldset>

    <!-- Create a section for Linux skills -->
    <fieldset>
      <legend>Linux</legend>
      <!-- Create a checkbox for Bash -->
      <label for="bash">Bash</label>
      <input type="checkbox" id="bash" name="linux[]" value="bash"><br>
      <!-- Create a checkbox for Python -->
      <label for="python">Python</label>
      <input type="checkbox" id="python" name="linux[]" value="python"><br>
      <!-- Create a checkbox for Perl -->
      <label for="perl">Perl</label>
      <input type="checkbox" id="perl" name="linux[]" value="perl"><br>
      <!-- Create a checkbox for C -->
      <label for="c">C</label>
    <input type="checkbox" id="c" name="linux[]" value="c"><br>
    </fieldset>

    <!-- Create a section for Windows skills -->
    <fieldset>
      <legend>Windows</legend>
      <!-- Create a checkbox for PowerShell -->
      <label for="powershell">PowerShell</label>
      <input type="checkbox" id="powershell" name="windows[]" value="powershell"><br>
      <!-- Create a checkbox for C# -->
      <label for="csharp">C#</label>
      <input type="checkbox" id="csharp" name="windows[]" value="csharp"><br>
      <!-- Create a checkbox for VB.NET -->
      <label for="vbnet">VB.NET</label>
      <input type="checkbox" id="vbnet" name="windows[]" value="vbnet"><br>
      <!-- Create a checkbox for ASP.NET -->
      <label for="aspnet">ASP.NET</label>
      <input type="checkbox" id="aspnet" name="windows[]" value="aspnet"><br>
    </fieldset>

    <!-- Create a section for ActiveDirectory skills -->
    <fieldset>
      <legend>ActiveDirectory</legend>
      <!-- Create a checkbox for LDAP -->
      <label for="ldap">LDAP</label>
      <input type="checkbox" id="ldap" name="activedirectory[]" value="ldap"><br>
      <!-- Create a checkbox for Kerberos -->
      <label for="kerberos">Kerberos</label>
      <input type="checkbox" id="kerberos" name="activedirectory[]" value="kerberos"><br>
      <!-- Create a checkbox for Group Policy -->
      <label for="gpo">Group Policy</label>
      <input type="checkbox" id="gpo" name="activedirectory[]" value="gpo"><br>
      <!-- Create a checkbox for DNS -->
      <label for="dns">DNS</label>
      <input type="checkbox" id="dns" name="activedirectory[]" value="dns"><br>
    </fieldset>

    <!-- Create a submit button -->
    <input type="submit" name="submit" value="Submit">
  </form>
</body>
</html>

