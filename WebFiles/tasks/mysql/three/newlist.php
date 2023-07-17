<style>
    body {
      background-color: #f8f9fa;
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 20px;
      color: #343a40;
    }

    h1 {
      color: #495057;
      text-align: center;
      font-weight: 300;
      margin-bottom: 20px;
    }

    .main-content {
      max-width: 800px;
      margin: 0 auto;
      background-color: #fff;
      border: 1px solid #dee2e6;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
      margin-top: 20px;
      padding: 30px;
    }

    .guide-container {
      margin-bottom: 30px;
    }

    .guide-container a {
      display: block;
      margin-bottom: 15px;
      color: #007bff;
      text-decoration: none;
    }

    .guide-container button {
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border: 1px solid #007bff;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .guide-container button:hover {
      background-color: #0056b3;
    }

    .home-button {
      padding: 10px 20px;
      background-color: #6c757d;
      color: #fff;
      border: 1px solid #6c757d;
      border-radius: 5px;
      cursor: pointer;
      position: absolute;
      top: 20px;
      right: 20px;
      transition: background-color 0.3s ease;
    }

    .home-button:hover {
      background-color: #5a6268;
    }
</style>

<button class="home-button" onclick="location.href='/tasks/mysql/three/index.php'">GamerFinder Home</button>


<?php

$country = $_GET['location'];

$conn = new mysqli('localhost', 'root', 'backpack10', 'users');

if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

// Using a prepared statement
$stmt = $conn->prepare("SELECT * FROM users WHERE country=?");

// Binding parameters to the prepared statement
$stmt->bind_param('s', $country);

// Executing the statement
$stmt->execute();

// Getting the result
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  echo '<h1>Users in the same country</h1>';
  while ($row = $result->fetch_assoc()) {
    echo '<li>' . htmlspecialchars($row['username']) . '</li>';
  }
} else {
  echo '<h1>No users in the same country</h1>';
}

$stmt->close();
$conn->close();
?>
