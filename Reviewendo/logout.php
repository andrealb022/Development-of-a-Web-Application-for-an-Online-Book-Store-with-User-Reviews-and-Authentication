<?php
  /* attiva la sessione */
  session_start();
  session_destroy();
  if (isset($_COOKIE['session_id'])) {
    setcookie('session_id','',time()-3600,'/');
  }
  header("Location: HomePage.php");
  exit();
 ?>
