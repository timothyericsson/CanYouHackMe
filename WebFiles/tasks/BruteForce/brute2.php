<!DOCTYPE html>
<html lang="en">
<!-- Note: The password is within the first hundred lines of rockyou.txt --> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Mike's Forums!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e6f7ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative; /* Added for positioning the button */
        }

        .login-container {
            background-color: white;
            padding: 40px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            width: 350px;
            max-width: 100%;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .login-form button {
            width: calc(100% - 20px);
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .login-form button:hover {
            background-color: #0056b3;
        }

        /* Style for the new button */
        .index-button {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px;
            background-color: #007bff; /* Light blue button */
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .index-button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form class="login-form" id="loginForm">
            <input type="text" id="username" placeholder="Username" required>
            <input type="password" id="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>

    <!-- New button to redirect to /index.php -->
    <button class="index-button" onclick="window.location.href='/index.php'">Go to Index</button>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();

            var username = document.getElementById('username').value;
            var password = document.getElementById('password').value;
            var encodedCredentials = btoa(username + ':' + password);

            var formData = new FormData();
            formData.append('login', encodedCredentials);

            fetch('', {
                method: 'POST',
                body: formData
            }).then(response => {
                if (response.redirected) {
                    window.location.href = response.url;
                }
            });
        });
    </script>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $login = $_POST["login"];
            $validCredentials = "bWlrZTp3aGF0ZXZlcg==";

            if ($login === $validCredentials) {
                header('Location: success_secret_page.html');
                exit();
            } else {
                header('Location: fail.html');
                exit();
            }
        }
    ?>
</body>
</html>
