<?php
// Get the user input from the URL
$name = $_GET['name'];

// Basic sanitization to remove script tags
$name = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $name);

// Display the sanitized user input
echo "<h1>Hello, " . $name . "!</h1>";
?>



