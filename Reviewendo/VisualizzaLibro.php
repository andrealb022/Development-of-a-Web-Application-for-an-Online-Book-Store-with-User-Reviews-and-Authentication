<?php session_start(); ?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Gruppo04">
    <meta name="keywords" content="libri, recensioni, rewiewendo,
                recensioni libri, bestseller, critica letteraria, libri consigliati,
                Horror, fantascienza, azione, thriller, avventura, umoristico, biografia,recensioni">
    <meta name="description" content="Pagina per visualizzare il libro,aggiungere e vedere le recensioni.">
    <link rel="stylesheet" type="text/css" href="Struttura.css" media="screen">
    <title>Reviewendo</title>
    <link rel="stylesheet" href="stars.css">
    <link rel="icon" href="media/LogoIcon.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/lucida-handwriting-std">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
   <script src="script.js" defer></script>
   <script src="search.js"></script>
   <script type="text/javascript">
   function validazioneForm(nomeForm){
    /* DEFER: Questo attributo booleano è impostato per indicare a un browser che lo script
     deve essere eseguito dopo che il documento è stato analizzato, ma prima di attivare
     DOMContentLoaded.*/
     if(!checkLiveInput(nomeForm.titolo,20)){
       return false;
     }
     if(!checkLiveInput(nomeForm.contenuto,500)){
       return false;
     }

     var star1 = document.getElementById('star_1');
     var star2 = document.getElementById('star_2');
     var star3 = document.getElementById('star_3');
     var star4 = document.getElementById('star_4');
     var star5 = document.getElementById('star_5');
     if(!(star1.checked || star2.checked || star3.checked || star4.checked || star5.checked )){
       alert("Dare una valutazione da 1 a 5 stelle per pubblicare la recensione!");
       return false;
     }
     return true;
   }

   function checkLiveInput(input,maxLength){

     if (input.value.length > maxLength){
       alert("Questo campo non può superare i "+ maxLength + " caratteri!");
       input.focus();
       input.select();
       return false;
     }
     return true;
   }

   </script>
   <style>

      form{
       font-size: 25px;
      }

      input[type="text"]{
        padding: 10px 70px 10px;
        width:200px;
      }

      textarea{
        padding: 10px 100px 40px;
      }

      .contenuti{
          font-size: 25px;

       }

      .box2{
        border-left: solid;
        border-right: solid;
        border-width: 4px;
        border-color: darkcyan;
      }

      .box2, .box3, .box5{
          padding-left: 3px;
       }

       .box4, input, dl, textarea, span{
         margin-left: 50px;
       }

       .container{
          display: grid;
          grid-template-columns: 30% 25% 45%;
          border-bottom: solid;
          border-color: darkcyan;
          border-width: 4px;
       }

       input[type="radio"]{
         display: none;
       }
       input[type="submit"]{
         padding: 5px 30px 5px;
         margin-left: 90px;
       }

       #recensioni{
         display: grid;
         grid-template-columns: 1fr 1fr;
         grid-template-rows: auto;
         grid-row-gap: 20px;
       }

       .consigliati{

         display: grid;
         grid-template-columns: 1fr 1fr 1fr 1fr;
         grid-template-rows: auto;
       }

      h3{
        padding-left: 10px;
        border-top: solid;
        border-color: darkcyan;
        border-width: 4px;
      }



  </style>

  </head>
  <body>

    <div id="leftBar">
      <a href="HomePage.php"><img src="media/logo.png" alt="logo" style="width: 95%; margin-top: 20px;"></a>
			<div class="sidebar">
        <a href="HomePage.php">Alfabetico</a>
        <button class="dropdown-btn">Genere
          <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
          <a href="HomePage.php?ordine=genere">Tutti i libri per genere</a>
          <a href="HomePage.php?genere=Avventura">Avventura</a>
          <a href="HomePage.php?genere=Azione">Azione</a>
          <a href="HomePage.php?genere=Biografia">Biografia</a>
          <a href="HomePage.php?genere=Fantascienza">Fantascienza</a>
          <a href="HomePage.php?genere=Fantasy">Fantasy</a>
          <a href="HomePage.php?genere=Horror">Horror</a>
          <a href="HomePage.php?genere=Thriller">Thriller</a>
          <a href="HomePage.php?genere=Umoristico">Umoristico</a>
        </div>
        <script>
          var dropdown = document.getElementsByClassName("dropdown-btn");
          var i;
          for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
              dropdownContent.style.display = "none";
            }else {
                  dropdownContent.style.display = "block";
                  }
                });
              }
          </script>
        <a href="HomePage.php">I più votati</a>
        <a href="HomePage.php">I più recensiti</a>
        <a href="HomePage.php?ordine=anno DESC">Ultime uscite</a>
        <a href="HomePage.php?ordine=prezzo DESC">I più costosi</a>
        <a href="HomePage.php?ordine=prezzo">I meno costosi</a>
      </div>
		</div>

		<div id="rightBar">

      <header>
				<div class="titoli">
          <h1>Reviewendo</h1>
          <h2>Il tuo sito di recensioni libresche</h2>
        </div>

        <div class="menu">
          <a href="HomePage.php" id="homeLink">Home</a>



          <div class="ricerca">
              <input type="text" id="mySearch" onclick="Mostra()" onkeyup="myFunction()" placeholder="Search.." title="Che libro stai cercando?...">
                  <ul id="myMenu">
                     <?php include("search.php") ?>
                  </ul>
          </div>




          <div class="pulsante">
            <?php
            if(!isset($_COOKIE['session_id']) || $_COOKIE['session_id'] !== session_id()){
              echo'<a href="login.php" id="loginLink" style="padding-top:30px;">Login o Registrati</a>';
            }
            else {
              echo '<a href="AreaUtente.php" style="width: 40px;height: 40px;" title="Area utente"><img src="media/user.png" style="width:100%;height:100%;"></a>';
              echo'<a href="logout.php" style="padding-top:30px;">Logout</a>';
            }
            ?>
          </div>
        </div>
			</header>

			<div class="contenuti">
         <div class="container">
                <?php
                    $libro=$_GET['libro'];
                 ?>

                  <?php

                      include("logindb.php");
                      $sql = "SELECT * from libri where ISBN='$libro' ";
                      $ret = pg_query($db, $sql);
                      $row = pg_fetch_assoc($ret);
                      $titolo= $row['titolo'];
                      $copertina= $row['copertina'];
                      $genere= $row['genere'];
                      $descrizione= $row['descrizione'];
                      $pagine= $row['pagine'];
                      $autore= $row['autore'];
                      $editore= $row['editore'];
                      $anno= $row['anno'];
                      $prezzo= $row['prezzo'];
                      $voto= $row['voto'];
                      $isbn= $row['isbn'];
                      ?>

                      <div class="box" >
                          <img src=<?php echo " '$copertina' "; ?>  width="100%" height="100%">
                      </div>

                  <?php
                  ##Stampo tutte le informazioni relative al libro
                         echo "<div class='box2'>
                              <b>Titolo</b>: $titolo<br>
                              <b>Categoria</b>: $genere<br>
                              <b>Autore</b>: $autore<br>
                              <b>Editore</b>: $editore<br>
                              <b>Anno di pubblicazione</b>: $anno<br>
                              <b>Prezzo</b>: $prezzo €<br>
                              <b>Numero pagine</b>: $pagine<br>
                              <b>Media valutazioni</b>: $voto <i class='fa-solid fa-star'></i></div>";


                  ?>

              <div class='box3'><b>Trama</b>: <?php echo "$descrizione"; ?></div>

          </div>

               <?php
                    if(!isset($_COOKIE['session_id']) || $_COOKIE['session_id'] !== session_id()){
                        echo "<p class='box4'><em>Hai gi&aacute letto questo libro? <b>Accedi al nostro sito e lascia una recensione!</b></em>
                             <span class='pulsante'>
                                <a href='login.php'>Login</a>
                             </span>";

                    }else{
                          echo "<p class='box4'><em>Hai gi&aacute letto questo libro? <b>Lascia una recensione!</b></em>
                                <form method='POST'  target='_self' action='Recensione.php?libro=$libro' onsubmit='return validazioneForm(this);'>
                                    <b><span>La tua recensione:</span></b><br>
                                    <input type='text' name='titolo' placeholder='Inserisci titolo (Max 20 char)' title='Inserisci titolo (Max 20 char)' onchange='checkLiveInput(this,20);'><br>
                                    <textarea required cols='100' row='15' type='text' name='contenuto' placeholder='Inserisci contenuto (Max 500 char)' title='Inserisci contenuto (Max 500 char)' onchange='checkLiveInput(this,500);'></textarea>
                                    <div class='rating-box'>
                                      <div class='stars'>
                                          <ul>
                                              <li><input  type='radio' id='star_1' name='star' value='1'><label for='star_1'><i class='fa-solid fa-star'></i></label></li>
                                              <li><input  type='radio' id='star_2' name='star' value='2'><label for='star_2'><i class='fa-solid fa-star'></i></label></li>
                                              <li><input  type='radio' id='star_3' name='star' value='3'><label for='star_3'><i class='fa-solid fa-star'></i></label></li>
                                              <li><input  type='radio' id='star_4' name='star' value='4'><label for='star_4'><i class='fa-solid fa-star'></i></label></li>
                                              <li><input  type='radio' id='star_5' name='star' value='5'><label for='star_5'><i class='fa-solid fa-star'></i></label></li>
                                          </ul>
                                       </div>
                                     </div>
                                            <input type='submit' value='Pubblica recensione'>
                           </form>";
                         }
               ?>
           </p>

           <?php
            ##Lista di tutte le recensioni lasciate dagli utenti
            $sql= "SELECT count(*) from recensioni where libro= '$libro'";
            $ret = pg_query($db, $sql);
            $row = pg_fetch_row($ret);
            if($row[0] == 0){
                echo "<p>Al momento non ci sono ancora recensioni su questo libro...<b>un motivo in piu per leggerlo!</b></p>";
            }else{
                echo "<p><h3>Lista di tutte le recensioni rilasciate dagli utenti</h3><ul id='recensioni'>";
                $sql = "SELECT nickname, r.nome, contenuto, voto, data_inserimento
                from utenti u,recensioni r
                where utente=nickname and libro= '$libro' ";
                $ret = pg_query($db, $sql);
                while ($row = pg_fetch_assoc($ret)) {
                      $nickname= $row['nickname'];
                      $nome= $row['nome'];
                      $contenuto= $row['contenuto'];
                      $voto= $row['voto'];
                      $data= $row['data_inserimento'];

                      echo "<li><b style= 'color: darkcyan;'>$nickname</b> in data $data <br>
                            <b>Valutazione</b>: $voto <i class='fa-solid fa-star'></i> <br>
                            <b>Titolo</b>: $nome
                            <div style='width: 75%; word-wrap: break-word;'><b>Descrizione</b>: $contenuto</div></li>";
                      }
                      echo"</ul></p>";
                    }


                  echo "<h3>Potrebbero interessarti anche:</h3><div class='consigliati'>";
                  $sql="SELECT copertina, titolo, isbn from libri where genere='$genere' and isbn<>'$isbn'";
                  $ret= pg_query($db,$sql);
                   while ($row = pg_fetch_assoc($ret)){
                       $titolo= $row['titolo'];
                       $copertina= $row['copertina'];
                       $isbn= $row['isbn'];
                       echo "<div style= 'padding:10px;'><a href='VisualizzaLibro.php?libro=$isbn'><img src='$copertina' width=200px height=300px></a><br><b>$titolo<b></div>";
                   }

          echo"</div>";
           ?>






				<footer style="font-size: 17px;">
          <img src="media/unisa.png" alt="unisaLogo" style="float: right; width: 100px; height:100px;">
          <p><em>Realizzato dal Gruppo04, corso di Tecnologie Software per il Web(anno 2022/23).</em></p>
          <p>Università degli studi di Salerno.</p>
          <p><small>&copy; Tutti i diritti riservati.</small></p>
				</footer>
			</div>
		</div>

	</body>
</html>
