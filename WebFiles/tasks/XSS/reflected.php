<?php
// Get the user input from the URL
$name = $_GET['name'];

// Basic sanitization to remove script tags
$name = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $name);
?>
<!-- Display the sanitized user input with some styling -->
<div style='background-color: lightblue; padding: 20px; border-radius: 10px;'>
<h1 style='color: white; font-family: Arial;'>Hello, <?php echo $name; ?>!</h1>
<p style='color: black; font-family: Verdana;'>Script tags are blocked! </p>
<p style='color: black; font-family: Verdana;'>Try to trigger a javascript alert, there are no flags to find.</p>
<br>
<!-- Add some CSS to style the home button -->
<style>
.button {
  background-color: white;
  color: black;
  border: 2px solid lightblue;
  padding: 10px 20px;
  text-decoration: none;
}
.button:hover {
  background-color: lightblue;
  color: white;
}
</style>
<!-- Display the home button -->
<a class='button' href='/index.php'>Home</a>
</div>
