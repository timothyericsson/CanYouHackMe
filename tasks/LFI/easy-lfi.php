Welcome to our new employee training system. Please select the guide you would like to include on this page.

<br>
<br>
<br>
<br>

<a href="easy-lfi.php?page=newhire.txt">
  <button>New Hire</button>
</a>

<br>
<br>

<a href="easy-lfi.php?page=peeling.txt">
  <button>Proper peeling</button>
</a>

<br>
<br>
<a href="easy-lfi.php?page=machine.txt">
  <button>Machine Guide</button>
</a>

<br>
<br>
<?php
$file = $_GET['page'];
require($file);
?>
