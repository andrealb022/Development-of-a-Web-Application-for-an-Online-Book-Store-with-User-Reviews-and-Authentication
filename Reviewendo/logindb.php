<?php
  $host = 'localhost';
  $port = '5432';
  $db = 'tsw';
  $username = 'www';
  $password = 'tsw2023';
  $connection_string = "host=$host dbname=$db port=$port user=$username password=$password";
  $db = pg_connect($connection_string) or die('Impossibile connetersi al database: ' .pg_last_error());
?>
