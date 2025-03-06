<?php
session_start();
?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Gruppo04">
    <meta name="keywords" content="libri, recensioni, rewiewendo,
                recensioni libri, bestseller, critica letteraria, libri consigliati,
                Horror, fantascienza, azione, thriller, avventura, umoristico, biografia">
    <meta name="description" content="In questo sito verranno pubblicate le recensioni di alcune categorie di libri">
    <link rel="icon" href="media/LogoIcon.png" type="image/png">
    <link rel="stylesheet" type="text/css" href="Struttura.css" media="screen">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/lucida-handwriting-std">
    <script src="search.js"></script>
    <title>Reviewendo</title>
    <style>
       .container{
           display: grid;
           grid-template-columns: repeat(auto-fill, minmax(306px,1fr));
           row-gap: 50px;
       }
       span{
           font-size: 30px;
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
        <a href="HomePage.php?ordine=voto DESC">I più graditi</a>
        <a href="HomePage.php?ordine=num_recensioni DESC">I più recensiti</a>
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
              <input type="text" id="mySearch"  onkeyup="myFunction()" placeholder="Search.." title="Che libro stai cercando?...">
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
        <p class="intro">In questo sito troverete molte utili recensioni su molti
          libri diversi, dai grandi classici alle hit del momento.
        </p>

				<main>
          <?php
          include("CaricaLibri.php");
          ?>
          </div>
				</main>

				<footer style="font-size: 17px;">
          <img src="media/unisa.png" alt="unisaLogo" style="float: right; width: 10%; height:10%;">
          <p><em>Realizzato dal Gruppo04, corso di Tecnologie Software per il Web(anno 2022/23).</em></p>
          <p>Università degli studi di Salerno.</p>
          <p><small>&copy; Tutti i diritti riservati.</small></p>
				</footer>
			</div>
		</div>

	</body>
</html>
