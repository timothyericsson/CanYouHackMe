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
  </style>
<button class="home-button" onclick="location.href='/tasks/mysql/two/index.php'">GamerFinder Home</button>

<?php

$country = $_GET['location'];

$conn = new mysqli('localhost', 'root', 'backpack10', 'users');

if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

$sql = "SELECT * FROM users WHERE country='$country'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo '<h1>Users in the same country</h1>';
  while ($row = $result->fetch_assoc()) {
    echo '<li>' . $row['username'] . '</li>';
  }
} else {
  echo '<h1>No users in the same country</h1>';
}

$conn->close();
?>