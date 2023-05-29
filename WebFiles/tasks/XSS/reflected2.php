<!DOCTYPE html>
<html>
  <head>
    <title>XSS Example 2 (Sanitized)</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.1/showdown.min.js"></script>
    <style>
      /* Add some style to your website */
      body {
        font-family: "Roboto", sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
      }

      h1 {
        color: #333333;
        text-align: center;
        margin-top: 20px;
      }

      textarea {
        width: 80%;
        height: 200px;
        margin: 20px auto;
        display: block;
        border: 1px solid #cccccc;
        padding: 10px;
        font-size: 16px;
      }

      button {
        width: 100px;
        height: 40px;
        margin: 10px auto;
        display: block;
        background-color: #0099ff;
        border: none;
        border-radius: 5px;
        color: white;
        font-size: 18px;
      }

      #output {
        width: 80%;
        margin: 20px auto;
        display: block;
        border: 1px solid #cccccc;
        padding: 10px;
      }

      img {
        width: 50px;
        height: 50px;
      }
    </style>
  </head>
  <body>
    <h1>XSS Example 2 (Sanitized)</h1>
    <textarea id="input"></textarea>
    <button onclick="convertToMarkdown()">Convert</button>
    <div id="output">
      <!-- Lower body text -->
      <p>This is a challenge to practice XSS, or cross-site scripting, which is a type of web security vulnerability that allows attackers to inject malicious code into web pages. XSS can be used to steal user data, hijack sessions, deface websites, or perform other malicious actions.</p> 
      <p>In this challenge, you can enter some text in the textarea and click the Convert button to see how it is rendered as HTML using a markdown converter. However, the input is sanitized before it is converted, which means that any HTML tags </p>
    </div>

    <script>
      function sanitizeInput(input) {
        return input.replace(/</g, '<').replace(/>/g, '>');
      }

      function convertToMarkdown() {
        var input = sanitizeInput(document.getElementById('input').value);
        var converter = new showdown.Converter();
        var html = converter.makeHtml(input);
        document.getElementById('output').innerHTML = html;
      }
    </script>
  </body>
</html>

<!--
  <!DOCTYPE html>
<html>
  <head>
    <title>XSS Example 2 (Sanitized)</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.1/showdown.min.js"></script>
    <style>
      /* Add some style to your website */
      body {
        font-family: "Roboto", sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
      }

      h1 {
        color: #333333;
        text-align: center;
        margin-top: 20px;
      }

      textarea {
        width: 80%;
        height: 200px;
        margin: 20px auto;
        display: block;
        border: 1px solid #cccccc;
        padding: 10px;
        font-size: 16px;
      }

      button {
        width: 100px;
        height: 40px;
        margin: 10px auto;
        display: block;
        background-color: #0099ff;
        border: none;
        border-radius: 5px;
        color: white;
        font-size: 18px;
      }

      #output {
        width: 80%;
        margin: 20px auto;
        display: block;
        border: 1px solid #cccccc;
        padding: 10px;
      }

      img {
        width: 50px;
        height: 50px;
      }
    </style>
  </head>
  <body>
    <h1>XSS Example 2 (Sanitized)</h1>
    <textarea id="input"></textarea>
    <button onclick="convertToMarkdown()">Convert</button>
    <div id="output">
      <p>This is a challenge to practice XSS, or cross-site scripting, which is a type of web security vulnerability that allows attackers to inject malicious code into web pages. XSS can be used to steal user data, hijack sessions, deface websites, or perform other malicious actions.</p> 
      <p>In this challenge, you can enter some text in the textarea and click the Convert button to see how it is rendered as HTML using a markdown converter. However, the input is sanitized before it is converted, which means that any HTML tags </p>
    </div>

    <script>
      function sanitizeInput(input) {
        return input.replace(/</g, '<').replace(/>/g, '>');
      }

      function convertToMarkdown() {
        var input = sanitizeInput(document.getElementById('input').value);
        var converter = new showdown.Converter();
        var html = converter.makeHtml(input);
        document.getElementById('output').innerHTML = html;
      }
    </script>
  </body>
</html>
    