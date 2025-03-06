<?php
session_start();
include("logindb.php");
$nick=$_SESSION['nickname'];
$sql="DELETE from recensioni where utente='$nick'";
$ret = pg_query($db, $sql);
$sql="DELETE from utenti where nickname='$nick'";
$ret = pg_query($db, $sql);
header("location:  logout.php");
?>
