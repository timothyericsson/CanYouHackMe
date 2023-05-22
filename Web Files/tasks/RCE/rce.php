<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $command = $_POST['command'];
    $domain = $_POST['domain'];
    $output = shell_exec($command . ' ' . escapeshellarg($domain));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>RCE Challenge - Remote Code Execution</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        select, input[type="text"], input[type="submit"], .home-button {
            padding: 8px 16px;
            background-color: #888888;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        select:hover, input[type="text"]:hover, input[type="submit"]:hover, .home-button:hover {
            background-color: #666666;
        }

        .home-button {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        h2 {
            margin-top: 20px;
        }

        pre {
            background-color: #f9f9f9;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <h1>RCE Challenge - Remote Code Execution</h1>

    <a href="/index.php" class="home-button">Home</a>

    <form method="POST">
        <label for="command">Select a command to execute:</label>
        <select id="command" name="command">
            <option value="ping -c 4">Ping</option>
            <option value="nslookup">Nslookup</option>
            <option value="whois">Whois</option>
        </select>

        <label for="domain">Enter a domain:</label>
        <input type="text" id="domain" name="domain" placeholder="Example: google.com">

        <input type="submit" value="Execute">
    </form>

    <?php if (isset($output)): ?>
        <h2>Command Output:</h2>
        <pre><?php echo htmlspecialchars($output); ?></pre>
    <?php endif; ?>
</body>
</html>
