<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="./styles/simple.css">
    <title>PHP-Kurs</title>
</head>
<body>
<pre><?php

var_dump($_GET);

?></pre>

<form action="05-formulare.php" method="GET">
    <input type="text" name="firstname" value="<?php if(!empty($_GET['firstname'])) echo $_GET['firstname']; ?>" />
    <input type="text" name="lastname" value="<?php if(!empty($_GET['lastname'])) echo $_GET['lastname']; ?>" />
    <input type="submit" value="Abschicken!" />

</form>

</body>
</html>