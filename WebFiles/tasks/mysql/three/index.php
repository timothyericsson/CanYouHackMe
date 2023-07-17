<!DOCTYPE html>
<html>
<head>
<title>Homepage</title>
<style>
    body {
      background-color: #f8f9fa;
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 20px;
      color: #343a40;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background-image: url('https://source.unsplash.com/random');
      background-repeat: no-repeat;
      background-size: cover;
    }

    .container {
      background-color: rgba(255, 255, 255, 0.8);
      border-radius: 5px;
      padding: 20px;
      width: 60%;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }

    h1, h2 {
      color: #495057;
      text-align: center;
      font-weight: 300;
      margin-bottom: 20px;
    }

    form {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    input, select {
      margin: 10px 0;
      padding: 10px;
      width: 80%;
      border-radius: 5px;
      border: 1px solid #dee2e6;
    }

    .home-button {
      padding: 10px 20px;
      background-color: #6c757d;
      color: #fff;
      border: 1px solid #6c757d;
      border-radius: 5px;
      cursor: pointer;
      position: fixed;
      bottom: 20px;
      right: 20px;
      transition: background-color 0.3s ease;
    }

    .home-button:hover {
      background-color: #5a6268;
    }
</style>
</head>
<body>
<button class="home-button" onclick="location.href='/index.php'">CanYouHackMe Home</button>

<div class="container">
  <h1>Gamer Phone Book!</h1>
  <h2>Enter your Gamertag and find other players in the same country!</h2>
  <h2>Challenge Objective: Find the flag inside the table 'users' by abusing this web application.</h2>
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
</div>

</body>
</html>
