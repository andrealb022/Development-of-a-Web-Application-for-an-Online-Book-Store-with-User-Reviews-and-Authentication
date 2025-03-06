<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Gruppo04">
    <meta name="description" content="Pagina di comunicazione con l'utente.">
    <link rel="icon" href="media/LogoIcon.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/lucida-handwriting-std">
    <title>Reviewendo</title>
    <style>

    body{
      background-color: darkcyan;
      justify-content: center;
      align-items: center;
      font-family: Arial,sens-serif;
      }

       #RecensioneInserita{
          margin-top: 150px;
          font-size: 50px;
          background-position: center;
          text-align: center;
       }
       a{
         color: white;
         text-decoration: none;
       }

       a:hover {
         color: cyan;
       }

    </style>
  </head>
  <body>

    <?php
        session_start();
        $nick=$_SESSION['nickname'];
        $libro=$_GET['libro'];
        $titolo=$_POST['titolo'];
        $contenuto=$_POST['contenuto'];
        $voto=$_POST['star'];
        include("logindb.php");
        $new_contenuto=str_replace("'","''",$contenuto); //in postgreSQL bisogna raddoppiare l'apice per non avere errori nella query
        $sql = "select count(*) from recensioni where libro='$libro' and utente='$nick'";
        $ret = pg_query($db, $sql);
        $row = pg_fetch_row($ret);
        if($row[0] == 1){
          $sql = "delete from recensioni where libro='$libro' and utente='$nick'";
          $ret = pg_query($db, $sql);
        }

        $sql = "insert into recensioni values('$libro','$nick','$titolo', '$new_contenuto', '$voto', current_timestamp)";
        $ret = pg_query($db, $sql);
        echo "<div id='RecensioneInserita'> <br>Grazie per aver lasciato la tua opinione!</br>
                 <p><a href='HomePage.php'>Torna alla Home</a></p>
                 <p><a href='VisualizzaLibro.php?libro=$libro'>Ritorna al libro</a></p>
                 <p><a href='AreaUtente.php?visualizzaRec=1'>Vai alle tue recensioni</a></p>
                 </div>";

     ?>

  </body>
</html>
