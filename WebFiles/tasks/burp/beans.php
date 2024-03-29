<?php
// Initialize the total number of beans
$total_beans = 78;

// Initialize an empty guess variable
$guess = '';

// Verify if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtain the guess from the form
    $guess = filter_input(INPUT_POST, 'guess', FILTER_VALIDATE_INT);

    // Verify the guess
    if ($guess === $total_beans) {
        // Redirect to winner.php if the guess is correct
        header("Location: winner.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bean Counter Game</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 2% 10%;
            padding: 1em 3em;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #007BFF;
            border-bottom: 2px solid #007BFF;
            padding-bottom: 0.5em;
        }

        p {
            margin-top: 1em;
        }

        .jar-image {
            width: 300px;
            display: block;
            margin: 1em auto;
        }

        .guess-form {
            margin-top: 1em;
        }

        .guess-form label {
            font-weight: bold;
        }

        .guess-form input[type="number"] {
            padding: 5px;
            margin: 10px 0;
            border: 1px solid #007BFF;
            border-radius: 5px;
            width: 100%;
        }

        .guess-form input[type="submit"] {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: auto;
            transition: background-color 0.3s;
        }

        .guess-form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            margin-top: 1em;
        }
    </style>
</head>
<body>
    <h1>Bean Counter Game</h1>
    <p>Can you guess how many beans are in the jar?</p>

    <img src="beans.png" alt="Jar of beans" class="jar-image">

    <form action="beans.php" method="post" class="guess-form">
        <label for="guess">Your Guess:</label>
        <input type="number" id="guess" name="guess" value="<?= htmlspecialchars($guess) ?>">
        <input type="submit" value="Submit">
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST" && $guess !== $total_beans) {
            echo "<p class='error'>Your guess was incorrect. Try again!</p>";
        }
    ?>
    <div style="margin-top: 2em;">
        <input type="button" value="home" style="padding: 10px 20px; background-color: #007BFF; color: #fff; border: none; border-radius: 5px; cursor: pointer;" onclick="window.location.href='/index.php'">
    </div>
</body>
</html>
