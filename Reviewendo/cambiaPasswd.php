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
    #inizializzo dati Sessione
    include("logindb.php");
    session_start();
    $nickname=$_SESSION['nickname'];
    $sql="select passwd from utenti where nickname = '$nickname'";
    $ret=pg_query($db,$sql);
    $row=pg_fetch_assoc($ret);
    $hashedPwd=$row['passwd'];
    $oldpwd=$_POST['oldPassword'];
      if(password_verify ($oldpwd , $hashedPwd)){
          $newpwd=$_POST['newPassword'];
          $hashedNewPwd=password_hash($newpwd,PASSWORD_DEFAULT);
          $sql="update utenti set passwd = '$hashedNewPwd' where nickname = '$nickname'";
          pg_query($db,$sql);
          echo "<div class='errore'>
            <h1 style= 'text-align: center;'><b>Bentornato, $nickname!</b></h1>
            <p style= 'text-align: center;'><em>La password è stata aggiornata con successo!</em></p>
            <p style= 'text-align: center;'><a href='AreaUtente.php' id='ritorno'>Torna all'area utente.</a></p>
          </div>
          ";
      }else{
        echo "<div class='errore'>
          <h1 style= 'text-align: center;'><b>ERRORE</b></h1>
          <p style= 'text-align: center;'>La password vecchia inserita è errata.</p>
          <p style= 'text-align: center;'><a href='AreaUtente.php' id='ritorno'>Torna all'area utente.</a></p>
        </div>
        ";
      }

  ?>
</body>
</html>
