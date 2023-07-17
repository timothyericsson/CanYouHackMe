<!DOCTYPE html>
<html>
<head>
  <title>Directory Traversal Example</title>
  <style>
    body {
      background-color: #f2f2f2;
      color: #333333;
      font-family: Arial, sans-serif;
    }
    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }
    .button {
      float: right;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Directory Traversal</h2>
    <p>
      Directory traversal, also known as path traversal, is a security flaw that happens when a website doesn't properly control the files and directories users can access.
      It allows attackers to go beyond the intended boundaries and view sensitive files.
      For example, if a website lets users download files by specifying a path, a lack of proper checks could let users navigate to files outside of what they should be able to see.
      This can lead to exposure of confidential information like user data or important system files.
    </p>
    <p>
      There is an example of directory traversal on this website. Can you find it?
    </p>
    <a href="/index.php" class="button">CanYouHack.Me</a>
  </div>
</body>
</html>
