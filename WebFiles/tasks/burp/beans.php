<input type="button" value="home" onclick="window.location.href='/index.php'">
<?php
    // Initialize the total number of beans
    $total_beans = 115;

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
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        h1 {
            color: #007BFF;  // Light Blue Color
        }

        .jar-image {
            width: 300px;
            height: auto;
        }

        .guess-form input[type="number"] {
            padding: 5px;
            margin: 10px 0;
            border: 1px solid #007BFF;
        }

        .guess-form input[type="submit"] {
            padding: 5px 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .guess-form input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Bean Counter Game</h1>

    <p>Can you guess how many beans are in the jar?</p>

    <!-- Display an image with controlled size using a class -->
    <img src="beans.png" alt="Jar of beans" class="jar-image">

    <form action="beans.php" method="post" class="guess-form">
        <label for="guess">Your Guess:</label>
        <input type="number" id="guess" name="guess" value="<?= htmlspecialchars($guess) ?>"><br>
        <input type="submit" value="Submit">
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST" && $guess !== $total_beans) {
            echo "<p style=\"color: red;\">Your guess was incorrect. Try again!</p>";
        }
    ?>
</body>
</html>
