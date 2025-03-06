<?php

include("logindb.php");
$nick=$_GET['nick'];
$isbn=$_GET['libro'];
$sql="DELETE from recensioni where utente='$nick' and libro='$isbn'";
$ret=pg_query($db, $sql);
header("location: AreaUtente.php?visualizzaRec=1");

 ?>
