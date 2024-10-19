<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="styles.css" rel="stylesheet">
</head>
<body>
  <?php require 'template_engine.php' ?>

  <!-- Start of site content -->
  <?php 
      include 'menu.php';

      include 'main.php';

      echo getSite();

      include 'footer.php'; 
  ?>
</body>
</html>