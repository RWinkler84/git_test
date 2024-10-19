<?php

function getSite()
{
  if (isset($_GET) && !empty($_GET)) {

    $placeholder = [
      'name' => $_GET['name'],
      'profession' => $_GET['profession']
    ];

    $siteContent = fillPlaceholder($placeholder);
      
  } else {

    $placeholder = [];
    $siteContent = "";
  
  }

  return $siteContent;
}


function fillPlaceholder($placeholder)
{

  $site = file_get_contents('test.html');

  foreach ($placeholder as $key => $value) {
    $placeholderString = '{' . $key . '}';
    $site = str_replace($placeholderString, $value, $site);
  }

  return $site;
}
