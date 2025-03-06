<?php
  include("logindb.php");
  $sql = "SELECT titolo,isbn from libri";
  $ret = pg_query($db, $sql);
  while ($row = pg_fetch_assoc($ret)){
      $titolo= $row['titolo'];
      $isbn= $row['isbn'];
     echo "<li><a href='VisualizzaLibro.php?libro=$isbn'>'$titolo'</a></li>";
   }
 ?>
