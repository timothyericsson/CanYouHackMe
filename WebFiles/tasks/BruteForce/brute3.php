<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFCCCB;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
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
            background-color: #FFCCCB;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Style for the home button */
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

        .login-form button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            margin-bottom: 10px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form class="login-form" id="loginForm">
            <div class="error-message" id="errorMessage"></div>
            <input type="text" id="username" placeholder="Username" required>
            <input type="password" id="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>

<button class="index-button" onclick="window.location.href='/index.php'">Go to Index</button>
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var errorMessage = document.getElementById('errorMessage');
            errorMessage.style.display = 'none';

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
                } else {
                    errorMessage.textContent = 'Login failed. Please try again.';
                    errorMessage.style.display = 'block';
                }
            });
        });
    </script>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $decodedLogin = base64_decode($_POST["login"]);
            list($username, $password) = explode(':', $decodedLogin);
            $correctPassword = "hello123"; // Replace with actual password

            if ($username === "zeb") {
                if ($password === $correctPassword) {
                    header('Location: success_again.html');
                    exit();
                } else {
                    echo "<script>document.getElementById('errorMessage').textContent = 'Incorrect password.'; document.getElementById('errorMessage').style.display = 'block';</script>";
                }
            } else {
                header('Location: denied.html');
                exit();
            }
        }
    ?>
</body>
</html>