<html>
  </head>
  </head>
<body>
<form method="get" action="php-lernen.php">
  <div>
    <input type="email" id="email" name="email">
    <label for="email">E-Mail-Adresse</label>
  </div>
  <div>
    <input type="text" id="name" name="name">
    <label for="name">Name</label>
  </div>
  <div>
    <button type="submit">Speichern</button>
  </div>
</form>


<?php
$file = fopen("besucher.txt", "a");

fwrite($file, $_GET['name']);
fwrite($file,' | ');
fwrite($file, $_GET['email']);

fclose($file);

?>
</body>
</html>