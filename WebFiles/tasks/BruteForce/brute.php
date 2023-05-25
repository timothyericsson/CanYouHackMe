<!DOCTYPE html>
<html>
<head>
    <title>Bruteforce Admin</title>
    <style>
        body {
            background-color: #f2f2f2;
            color: #333;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
            text-align: center;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .button {
            display: block;
            width: 96%;
            padding: 10px;
            margin-top: 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bruteforce Admin</h1>
        <?php
        // Check if the user is signed in as admin
        session_start();

        if (isset($_SESSION['username']) && $_SESSION['username'] === 'admin') {
            echo "<p>Congratulations! You're signed in as admin. Flag: 1ntrud3r</p>";
            // Do something fun for admin
        } else {
            echo "<p>Try to bruteforce the admin user on the login page for this website.</p>";
            echo "<p>For simplicity, your wordlist can be the first 10 strings inside <code>rockyou.txt</code>.</p>";
            echo "<p>This page displays a flag only for the admin user. </p>";
        }
        ?>

        <a class="button" href="/index.php">Home</a>
    </div>
</body>
</html>