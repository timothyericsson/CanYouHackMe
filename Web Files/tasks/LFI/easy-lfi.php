<!DOCTYPE html>
<html>
<head>
  <title>Employee Training System</title>
  <style>
    body {
      background-color: #f2f2f2;
      font-family: Arial, sans-serif;
      margin: 20px;
    }

    h1 {
      color: #333;
      text-align: center;
    }

    .main-content {
      max-width: 800px;
      margin: 0 auto;
      background-color: #fff;
      border: 1px solid #ddd;
      padding: 20px;
      border-radius: 4px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .guide-container {
      margin-bottom: 20px;
    }

    .guide-container a {
      display: block;
      margin-bottom: 10px;
    }

    .guide-container button {
      padding: 8px 16px;
      background-color: #eee;
      color: #333;
      border: 1px solid #ccc;
      border-radius: 4px;
      cursor: pointer;
    }

    .home-button {
      padding: 10px 20px;
      background-color: #eee;
      color: #333;
      border: 1px solid #ccc;
      border-radius: 4px;
      cursor: pointer;
      position: absolute;
      top: 10px;
      right: 20px;
    }
  </style>
</head>
<body>
  <button class="home-button" onclick="location.href='/index.php'">Home</button>

  <div class="main-content">
    <h1>Welcome to our new employee training system</h1>
    <p>Please select the guide you would like to include on this page:</p>

    <div class="guide-container">
      <a href="easy-lfi.php?page=newhire.txt">
        <button>New Hire</button>
      </a>

      <a href="easy-lfi.php?page=peeling.txt">
        <button>Proper Peeling</button>
      </a>

      <a href="easy-lfi.php?page=machine.txt">
        <button>Machine Guide</button>
      </a>
    </div>

    <?php
    $file = $_GET['page'];
    require($file);
    ?>
  </div>
</body>
</html>
