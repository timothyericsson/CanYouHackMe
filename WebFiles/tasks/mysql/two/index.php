<!DOCTYPE html>
<html>
<head>
<title>Homepage</title>
<style>
    body {
      background-color: #f2f2f2;
      font-family: Arial, sans-serif;
      margin: 20px;
    }

    h1 {
      color: #333;
      text-align: center;
    }

    .main-content {
      max-width: 800px;
      margin: 0 auto;
      background-color: #fff;
      border: 1px solid #ddd;
      padding: 20px;
      border-radius: 4px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .guide-container {
      margin-bottom: 20px;
    }

    .guide-container a {
      display: block;
      margin-bottom: 10px;
    }

    .guide-container button {
      padding: 8px 16px;
      background-color: #eee;
      color: #333;
      border: 1px solid #ccc;
      border-radius: 4px;
      cursor: pointer;
    }

    .home-button {
      padding: 10px 20px;
      background-color: #eee;
      color: #333;
      border: 1px solid #ccc;
      border-radius: 4px;
      cursor: pointer;
      position: absolute;
      top: 10px;
      right: 20px;
    }

    .challenge-objective {
      font-size: 14px;
      margin-top: 20px;
      margin-bottom: 20px;
      color: #666;
      text-align: center;
    }
  </style>
</head>
<body>
<button class="home-button" onclick="location.href='/index.php'">CanYouHackMe Home</button>
<h2 class="challenge-objective">Challenge Objective: Find the flag inside the table 'users' by abusing this web application.</h2>
<h1>Gamer Phone Book!</h1>
<h2>Enter your Gamertag and find other players in the same country!</h2>
<br>
<form action="home.php" method="post">
<input type="text" name="name" placeholder="Gamertag">
<select name="country">
<option value="United States">United States</option>
<option value="Canada">Canada</option>
<option value="Australia">Australia</option>
<option value="Mexico">Mexico</option>
<option value="Brazil">Brazil</option>
<option value="Argentina">Argentina</option>
<option value="Colombia">Colombia</option>
<option value="Peru">Peru</option>
<option value="Chile">Chile</option>
</select>
<input type="submit" value="Submit">
</form>
</body>
</html>
