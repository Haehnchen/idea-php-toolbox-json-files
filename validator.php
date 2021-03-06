<?php

$it2 = new RecursiveDirectoryIterator(__DIR__);
$it2 = new RecursiveIteratorIterator($it2); 
$files = new RegexIterator($it2, '/\.json$/i');

$invalid = [];

foreach ($files as $name => $_){
    if (null === $content = json_decode(file_get_contents($name), true)) {
      $invalid[] = substr($name, strlen(__DIR__) + 1);
      continue;
    }

    if (!isset($content['registrar']) && !isset($content['providers'])) {
      $invalid[] = substr($name, strlen(__DIR__) + 1);    
    }
}

if (count($invalid) > 0) {
  echo 'Invalid json files found: ' . implode(', ', $invalid);
  exit(1);
}