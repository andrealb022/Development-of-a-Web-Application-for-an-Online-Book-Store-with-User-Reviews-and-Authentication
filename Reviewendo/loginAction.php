<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Gruppo04">
    <meta name="keywords" content="login,username,password,accesso,registrazione,utente,reviewendo,recensioni,reimposta password">
    <meta name="description" content="Pagina di login o registrazione">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="loginStyle.css">
    <link rel="icon" href="media/LogoIcon.png" type="image/png">
  </head>
<body>
  <?php

  include("logindb.php");

  $nickname=$_POST['Nickname'];
  $password=$_POST['Password'];

  $sql="select count(*) as corrispondenza from utenti where nickname = '$nickname'";
  $ret=pg_query($db,$sql);
  $row=pg_fetch_assoc($ret);
  $num=$row['corrispondenza'];

  if($num == 1){
    $sql="select passwd from utenti where nickname = '$nickname'";
    $ret=pg_query($db,$sql);
    $row=pg_fetch_assoc($ret);
    $hashedPwd=$row['passwd'];
      if(password_verify ($password , $hashedPwd)){
        session_start();
        setcookie('session_id', session_id(),time()+(60*60*7),'/');
        $_SESSION['nickname']=$nickname;
        header('Location: HomePage.php');
        exit();
      }else{
        echo "<div class='errore'>
          <h1 style= 'text-align: center;'><b>ERRORE</b></h1>
          <p style= 'text-align: center;'>Password errata!</p>
          <p style= 'text-align: center;'><a href='login.php?' id='qui'>RIPROVA.</a></p>
        </div>
        ";
      }
  }else{
    echo "<div class='errore'>
      <h1 style= 'text-align: center;'><b>ERRORE</b></h1>
      <p style= 'text-align: center;'>Nickname errato!</p>
      <p style= 'text-align: center;'><a href='login.php?' id='qui'>RIPROVA.</a></p>
    </div>
    ";
  }
?>
</body>
</html>
