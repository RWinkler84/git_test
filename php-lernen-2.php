<html>
  </head>
  </head>
<body>
<p>In der Datei besucher.txt steht:</p>
<?php
  $file = fopen("besucher.txt", "r");

  while ($inhalt = fgets($file)){
    echo "$inhalt<br>";
  }

  fclose($file);


?>
</body>
</html>