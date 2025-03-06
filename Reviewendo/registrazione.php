<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Gruppo04">
    <meta name="keywords" content="login,username,password,accesso,registrazione,utente,reviewendo,recensioni">
    <meta name="description" content="Pagina di login o registrazione">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="loginStyle.css">
    <link rel="icon" href="media/LogoIcon.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/lucida-handwriting-std">
  </head>
  <body>
    <?php

    include("logindb.php");

    $nome=$_POST['Nome'];
    $cognome=$_POST['Cognome'];
    $nickname=$_POST['Nickname'];
    $email=$_POST['Email'];
    $password=$_POST['Password'];
    $datanascita=$_POST['Datanascita'];
    $risposta=$_POST['Risposta'];

    $queryCheckNickname="select count(*) as errore from utenti where nickname = '$nickname'";
    $ret=pg_query($db,$queryCheckNickname);
    $row=pg_fetch_assoc($ret);
    $checkNum=$row['errore'];
    if($checkNum == 1){
      echo "<div class='errore'>
        <h1 style= 'text-align: center;'><b>ERRORE</b></h1>
        <p style= 'text-align: center;'>Il nickname: $nickname è già stato usato, provane un altro.</p>
        <p style= 'text-align: center;'>Effettua di nuovo la registrazione <a href='login.php?Registrazione=1' class='qui'>QUI.</a></p>
      </div>
      ";
      exit();
    }

    $queryCheckEmail="select count(*) as errore from utenti where mail = '$email'";
    $ret=pg_query($db,$queryCheckEmail);
    $row=pg_fetch_assoc($ret);
    $checkNum=$row['errore'];
    if($checkNum == 1){
      echo "<div class='errore'>
        <h1 style= 'text-align: center;'><b>ERRORE</b></h1>
        <p style= 'text-align: center;'>La mail: $email è già associata ad un account registrato</p>
        <p style= 'text-align: center;'>Effettua di nuovo la registrazione <a href='login.php?Registrazione=1' class='qui'>QUI.</a></p>
      </div>
      ";
      exit();
    }

    $hashedPwd=password_hash($password, PASSWORD_DEFAULT);
    $hashedAnswr=password_hash($risposta,PASSWORD_DEFAULT);

    $queryInsert="insert into utenti values('$nome','$cognome','$nickname','$email','$hashedPwd','$hashedAnswr','$datanascita')";
    $ret=pg_query($db,$queryInsert);
    if($ret){
      session_start();
      setcookie('session_id', session_id(),time()+(60*60*7),'/');
      $_SESSION['nickname']=$nickname;
      echo "<div class='errore'>
        <h1 style= 'text-align: center;'><b>REGISTRAZIONE RIUSCITA</b></h1>
        <p style= 'text-align: center;'>Benvenuto in Reviewendo $nickname!</p>
        <p style= 'text-align: center;'>Per iniziare a recensire i tuoi libri preferiti clicca <a href='HomePage.php?' class='qui'>QUI.</a></p>
      </div>
      ";
    }

     ?>
  </body>
</html>
