<?php //Verifico se l'utente è autenticato
session_start();
if (!isset($_COOKIE['session_id']) || $_COOKIE['session_id'] !== session_id()) {
    // Reindirizza alla pagina di login
    header('Location: login.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Gruppo04">
    <meta name="keywords" content="libri, recensioni, rewiewendo,
                recensioni libri, bestseller, critica letteraria, libri consigliati,
                Horror, fantascienza, azione, thriller, avventura, umoristico, biografia, area utente, elimina profilo, logout">
    <meta name="description" content="In questa pagina l'utente potrà visualizzare le sue informazioni principali, effettuare un logout e eliminare il profilo">
    <link rel="stylesheet" type="text/css" href="Struttura.css" media="screen">
    <link rel="stylesheet" type="text/css" href="stileAU.css">
    <link rel="icon" href="media/LogoIcon.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/lucida-handwriting-std">
    <script src="search.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <title>Reviewendo</title>
    <script type="text/javascript">
        function mostraLeMieRecensioni() {
          var Formpasswd=document.getElementById('formPasswd');
          Formpasswd.style.display="none";
            var dati = document.getElementById('datipersonali');
            dati.style.display="none";
            var recensioni = document.getElementById('mierecensioni');
            recensioni.style.display="grid";
            var titolo = document.getElementById('RecTit');
            titolo.style.display="block";
        }


        function mostraIMieiDati() {
          var Formpasswd=document.getElementById('formPasswd');
          Formpasswd.style.display="none";
          var titolo = document.getElementById('RecTit');
          titolo.style.display="none";
          var recensioni = document.getElementById('mierecensioni');
          recensioni.style.display="none";
          var dati = document.getElementById('datipersonali');
          dati.style.display="block";
        }

        function checker(str){
          var result=confirm(str);
          if(result==false){
            event.preventDefault();
          }
        }

        function checkerRec(){
          var result=confirm("Sei sicuro di voler eliminare la recensione?");
          if(result==false){
            event.preventDefault();
          }
        }

        function mostraCambiaPasswd(){
          var titolo = document.getElementById('RecTit');
          titolo.style.display="none";
          var recensioni = document.getElementById('mierecensioni');
          recensioni.style.display="none";
          var dati = document.getElementById('datipersonali');
          dati.style.display="none";
          var Formpasswd=document.getElementById('formPasswd');
          Formpasswd.style.display="block";
        }

        function validazioneForm(nomeForm){
          if(!checkLiveInput(nomeForm.oldPassword,15)){
            return false;
          }

          if(!checkLiveInput(nomeForm.newPassword,15)){
            return false;
          }

          if(!checkLiveInput(nomeForm.newPassword2,15)){
            return false;
          }


          if(nomeForm.newPassword.value != nomeForm.newPassword2.value){
            alert("Le due password non corrispondono!");
            nomeForm.newPassword.focus();
            nomeForm.newPassword.select();
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

          if (input.value.length < 6){
            alert("Per questioni di sicurezza, la password deve essere lunga almeno 6 caratteri.");
            input.focus();
            input.select();
            return false;
          }

          return checkCaratteri(input);
        }

        function checkCaratteri(input){

          atPos = input.value.indexOf("@",0);
          if(atPos > -1) {
              alert("Non puoi inserire @.");
              input.focus();
              input.select();
              return false;
            }
              atPos = input.value.indexOf("\"",0);
              if(atPos > -1) {
                  alert("Non puoi inserire \".");
                  input.focus();
                  input.select();
                  return false;
                }
                atPos = input.value.indexOf("\'",0);
                if(atPos > -1) {
                    alert("Non puoi inserire \'.");
                    input.focus();
                    input.select();
                    return false;
                  }
          return true;
        }

        function mostraPassword(nome) {
          var pwd = nome;
          if (pwd.type === "password") {
            pwd.type = "text";
          } else {
            pwd.type = "password";
          }
        }

    </script>


  </head>
  <body>

		<div id="leftBar">
      <a href="HomePage.php"><img src="media/logo.png" alt="logo" style="width: 95%; margin-top: 20px;"></a>
			<div class="sidebar">
        <a href="#" onclick="mostraIMieiDati()">I miei dati</a>
        <a href="#" onclick="mostraLeMieRecensioni()">Le mie recensioni</a>
        <a href="#" onclick="mostraCambiaPasswd()">Cambia password</a>
        <a href="logout.php" onclick="checker('Sei sicuro di voler effettuare il Logout?')">Logout</a>
        <a href="deleteAccount.php" onclick="checker('Sei sicuro di voler eliminare il profilo definitivamente?')">Elimina profilo</a>
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
              echo'<a href="login.php" id="loginLink">Login</a>';
            }
            else {
              echo '<a href="AreaUtente.php" style="width: 40px;height: 40px;" title="Area utente"><img src="media/user.png" style="width:100%;height:100%;"></a>';
            }
            ?>
          </div>
        </div>
			</header>

			<div class="contenuti">
        <p class="intro">Area Utente
        </p>

				<main>
          <?php include("crea_tabella_dati.php");
                include("crea_tabella_recensioni.php");
              echo" <form id ='formPasswd' action='cambiaPasswd.php' onsubmit='return validazioneForm(this);'  method='post' style = 'display: none;'>
              <h1>CAMBIA PASSWORD</h1>

              <label for='Password'>Vecchia Password:</label>
              <div id='oldpass'>
              <input type='password'required name='oldPassword' id='oldpwd' onchange='checkLiveInput(this,15);' placeholder='Inserisci la tua password' title='La password deve essere lunga dai 6 ai 15 caratteri.'>
              <input id='nch' type='checkbox' onclick='mostraPassword(oldpwd)'>Mostra Password
              </div>
              <label for='Password2'>Inserisci la nuova password:</label>
              <div id='npass'>
              <input type='password'required name='newPassword' id='newpwd' onchange='checkLiveInput(this,15);' placeholder='Inserisci la nuova password' title='Inserire la password.'>
              <input id='nch2' type='checkbox' onclick='mostraPassword(newpwd)'>Mostra Password
              </div>
              <label for='Password2'>Reinserisci la nuova password:</label>
              <div id='npass2'>
              <input type='password'required name='newPassword2' id='newpwd2' onchange='checkLiveInput(this,15);' placeholder='Reinserisci la tua password' title='Reinserire la password.'>
              <input id='nch3' type='checkbox' onclick='mostraPassword(newpwd2)'>Mostra Password
              </div>
              <button type='Submit' class='loginButton'>Conferma</button>
          </form>
          " ?>
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
