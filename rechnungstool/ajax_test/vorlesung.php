<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 

    $string = '. Und noch dazu sehr lesbar.';

echo <<<END
Das ist doch ein schöner Weg
HTML-Kram
einfach darzustellen{$string} <br>
END;
    
    // echo $string;

    echo <<<END
      a
     b
    c
\n
END;

    ?>
</body>
</html>