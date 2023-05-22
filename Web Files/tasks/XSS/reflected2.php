<!DOCTYPE html>
<html>
  <head>
    <title>XSS Example 2 (Sanitized)</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.9.1/showdown.min.js"></script>
  </head>
  <body>
    <h1>XSS Example 2 (Sanitized)</h1>
    <textarea id="input"></textarea>
    <button onclick="convertToMarkdown()">Convert</button>
    <div id="output"></div>

    <script>
      function sanitizeInput(input) {
        return input.replace(/</g, '&lt;').replace(/>/g, '&gt;');
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
