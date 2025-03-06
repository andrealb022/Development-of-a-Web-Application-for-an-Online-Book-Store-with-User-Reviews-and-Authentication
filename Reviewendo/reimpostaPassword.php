<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Gruppo04">
    <meta name="keywords" content="login,username,password,accesso,registrazione,utente,reviewendo,recensioni,reimposta password">
    <meta name="description" content="Pagina per reimpostare la password">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="loginStyle.css">
    <link rel="icon" href="media/LogoIcon.png" type="image/png">
  </head>
  <body>
    <?php
    include("logindb.php");
    $nickname=$_POST['Nickname'];
    $risposta=$_POST['risposta'];
    $newpswd=$_POST['Password'];

    $sql="select count(*) as corrispondenza from utenti where nickname = '$nickname'";
    $ret=pg_query($db,$sql);
    $row=pg_fetch_assoc($ret);
    $num=$row['corrispondenza'];

    if($num == 1){
      $sql="select risposta from utenti where nickname = '$nickname'";
      $ret=pg_query($db,$sql);
      $row=pg_fetch_assoc($ret);
      $hashedRisposta=$row['risposta'];
        if(password_verify ($risposta, $hashedRisposta)){
          $hashedNewPwd=password_hash($newpswd,PASSWORD_DEFAULT);
          $sql="update utenti set passwd = '$hashedNewPwd' where nickname = '$nickname'";
          pg_query($db,$sql);
          session_start();
          setcookie('session_id', session_id(),time()+(60*60*7),'/');
          $_SESSION['nickname']=$nickname;
          echo "<div class='errore'>
            <h1 style= 'text-align: center;'><b>Bentornato, $nickname!</b></h1>
            <p style= 'text-align: center;'><em>La password è stata aggiornata con successo!</em></p>
            <p style= 'text-align: center;'><a href='HomePage.php' id='ritorno'>Vai alla Home Page del sito</a></p>
          </div>
          ";
          exit();
        }
        else{echo "<div class='errore'>
          <h1 style= 'text-align: center;'><b>ERRORE</b></h1>
          <p style= 'text-align: center;'>La risposta di sicurezza non è corretta.</p>
          <p style= 'text-align: center;'><a href='login.php?Reimposta=1' id='ritorno'>Riprova.</a></p>
        </div>
        ";
        exit();
      }
    }
    else {
      echo "<div class='errore'>
        <h1 style= 'text-align: center;'><b>ERRORE</b></h1>
        <p style= 'text-align: center;'>Il nickname: $nickname non è associato a nessun utente registrato.</p>
        <p style= 'text-align: center;'><a href='login.php?Reimposta=1' id='ritorno'>Riprova.</a></p>
      </div>
      ";
      exit();
    }
     ?>
  </body>
</html>
