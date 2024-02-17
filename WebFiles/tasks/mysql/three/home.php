<button class="home-button" onclick="location.href='/tasks/mysql/two/index.php'">GamerFinder Home</button>
<br>
<br>
<?php


$name = $_POST['name'];
$country = $_POST['country'];

	// Check for blank entries
    if (empty($name) || empty($country)) {
        echo 'Please fill in all the fields.';
        exit;
      }

header('Location: newlist.php?location=' . $country);

$conn = new mysqli('localhost', 'root', 'backpack10', 'users');

if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

$sql = "INSERT INTO users (username, country) VALUES ('$name', '$country')";
$result = $conn->query($sql);

if ($result) {
  echo 'Homepage submission successful!';
} else {
  echo 'Homepage submission failed!';
}

$conn->close();
?>

