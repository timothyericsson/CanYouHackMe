<?php
// Get the item ID from the URL
$id = $_GET['id'];

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "backpack10";
$dbname = "users";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if an item ID is provided in the URL
if (isset($id)) {
  // Get the item details from the database
  $sql = "SELECT * FROM items WHERE id = $id";
  $result = mysqli_query($conn, $sql);

  // Check if the item exists
  if (mysqli_num_rows($result) > 0) {
    // Get the item row
    $row = mysqli_fetch_assoc($result);

    // Display the item details
    echo "<h2>Item Name: " . $row['name'] . "</h2>";
    echo "<p>Item Description: " . $row['description'] . "</p>";
    echo "<p>Price: $" . $row['price'] . "</p>";
    echo "<p>Rating: " . $row['rating'] . "</p>";
  }
}

// Get all items from the database
$sql = "SELECT * FROM items";
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {
  // Display the item buttons
  while ($row = mysqli_fetch_assoc($result)) {
    // Display the item button
    echo "<button class='item-button' onclick=\"location.href='item.php?id=" . $row['id'] . "'\">" . $row['name'] . "</button>&nbsp;";
  }
}

// Close the connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Item Details</title>
  <style>
    body {
      background-color: #f2f2f2;
      font-family: Arial, sans-serif;
      margin: 20px;
    }

    h2 {
      color: #333;
    }

    .item-button {
      padding: 10px 20px;
      background-color: #eee;
      color: #333;
      border: 1px solid #ccc;
      border-radius: 4px;
      cursor: pointer;
      margin-bottom: 10px;
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
      right: 10px;
    }
  </style>
</head>
<body>
  <button class="home-button" onclick="location.href='/index.php'">Home</button>
</body>
</html>
