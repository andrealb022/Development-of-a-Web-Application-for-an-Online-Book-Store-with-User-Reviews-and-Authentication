<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Gruppo04">
    <meta name="keywords" content="login,username,password,accesso,registrazione,utente,reviewendo,recensioni, reimposta password">
    <meta name="description" content="Pagina di login o registrazione">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="loginStyle.css">
    <link rel="icon" href="media/LogoIcon.png" type="image/png">
    <script type="text/javascript">

        function mostraLogin() {
            var formRegistrazione = document.getElementById('registrazione');
            formRegistrazione.style.display="none";
            var formReimposta = document.getElementById('cambiapaswd');
            formReimposta.style.display="none";
            var formLogin = document.getElementById('login');
            formLogin.style.display="block";
        }


        function mostraRegistrazione() {
          var formLogin = document.getElementById('login');
          formLogin.style.display="none";
          var formReimposta = document.getElementById('cambiapaswd');
          formReimposta.style.display="none";
          var formRegistrazione = document.getElementById('registrazione');
          formRegistrazione.style.display="block";
          setupFlexRegistrazione();
        }

        function mostraReimposta() {
          var formLogin = document.getElementById('login');
          formLogin.style.display="none";
          var formRegistrazione = document.getElementById('registrazione');
          formRegistrazione.style.display="none";
          var formReimposta = document.getElementById('cambiapaswd');
          formReimposta.style.display="block";
          setupFlexPassword();
        }

        function setupFlexRegistrazione(){
          //Gets the divs containing passwords and checkboxes and makes them into flexboxes
          var pass1 = document.getElementById('pass');
          var pass2 = document.getElementById('pass2');
          pass1.style.display="flex";
          pass2.style.display="flex";
          pass1.style.marginLeft="12px";
          pass2.style.marginLeft="12px";
          pass1.style.flexFlow="row";
          pass2.style.flexFlow="row";
          pass1.style.alignItems="center";
          pass2.style.alignItems="center";
          //Gets the password inputs and sets their flex
          pass1 = document.getElementById('pwd');
          pass2 = document.getElementById('pwd2');
          pass1.style.flexGrow="0";
          pass1.style.flexShrink="1";
          pass1.style.flexBasis="90%";
          pass2.style.flexGrow="0";
          pass2.style.flexShrink="1";
          pass2.style.flexBasis="90%";
          //Gets the checkbox inputs and sets their flex
          pass1 = document.getElementById('ch');
          pass2 = document.getElementById('ch2');
          pass1.style.flexGrow="0";
          pass1.style.flexShrink="1";
          pass1.style.flexBasis="10%";
          pass2.style.flexGrow="0";
          pass2.style.flexShrink="1";
          pass2.style.flexBasis="10%";
        }

        function setupFlexPassword(){
          //Gets the divs containing passwords and checkboxes and makes them into flexboxes
          var pass1 = document.getElementById('npass');
          var pass2 = document.getElementById('npass2');
          pass1.style.display="flex";
          pass2.style.display="flex";
          pass1.style.marginLeft="12px";
          pass2.style.marginLeft="12px";
          pass1.style.flexFlow="row";
          pass2.style.flexFlow="row";
          pass1.style.alignItems="center";
          pass2.style.alignItems="center";
          //Gets the password inputs and sets their flex
          pass1 = document.getElementById('newpwd');
          pass2 = document.getElementById('newpwd2');
          pass1.style.flexGrow="0";
          pass1.style.flexShrink="1";
          pass1.style.flexBasis="90%";
          pass2.style.flexGrow="0";
          pass2.style.flexShrink="1";
          pass2.style.flexBasis="90%";
          //Gets the checkbox inputs and sets their flex
          pass1 = document.getElementById('nch');
          pass2 = document.getElementById('nch2');
          pass1.style.flexGrow="0";
          pass1.style.flexShrink="1";
          pass1.style.flexBasis="10%";
          pass2.style.flexGrow="0";
          pass2.style.flexShrink="1";
          pass2.style.flexBasis="10%";
        }

        function mostraPassword(nome) {
          var pwd = nome;
          if (pwd.type === "password") {
            pwd.type = "text";
          } else {
            pwd.type = "password";
          }
        }

        function validazioneFormReimposta(nomeForm){
          if (nomeForm.Password.value.length < 6){
            alert("Per questioni di sicurezza, la password deve essere lunga almeno 6 caratteri.");
            nomeForm.Password.focus();
            nomeForm.Password.select();
            return false;
          }

          if(!checkLiveInput(nomeForm.Password,15)){
            return false;
          }

          if(nomeForm.Password.value != nomeForm.Password2.value){
            alert("Le due password non corrispondono!");
            nomeForm.Password.focus();
            nomeForm.Password.select();
            return false;
          }
          return true;
        }

        function validazioneForm(nomeForm){

          if(!checkLiveInput(nomeForm.Nome,20)){
            return false;
          }
          if(!checkLiveInput(nomeForm.Cognome,20)){
            return false;
          }
          if(!checkLiveInput(nomeForm.Nickname,20)){
            return false;
          }
          if (nomeForm.Email.value.length > 40){
            alert("Il campo e-mail non può superare i 40 caratteri!");
            nomeForm.Email.focus();
            nomeForm.Email.select();
            return false;
          }
          if (nomeForm.Password.value.length < 6){
            alert("Per questioni di sicurezza, la password deve essere lunga almeno 6 caratteri.");
            nomeForm.Password.focus();
            nomeForm.Password.select();
            return false;
          }
          if(!checkLiveInput(nomeForm.Password,15)){
            return false;
          }

          if (nomeForm.Password.value != nomeForm.Password2.value) {
            alert("Le due password non corrispondono!");
            nomeForm.Password.focus();
            nomeForm.Password.select();
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


    </script>

  </head>

  <body>

    <header>

      <div class="menu">
        <a href="HomePage.php" id="homeLink">Home</a>
      </div>

    </header>
          <?php if(isset($_GET['Registrazione'])){
                  $visibilità_login="none";
                  $visibilità_reimposta="none";
                  $visibilità_reg="block";
                }
                else{
                  if(isset($_GET['Reimposta'])){
                    $visibilità_login="none";
                    $visibilità_reg="none";
                    $visibilità_reimposta="block";
                  }
                  else {
                    $visibilità_reg="none";
                    $visibilità_reimposta="none";
                    $visibilità_login="block";
                  }
                }
                echo" <form id ='login' action='loginAction.php' method='post' style = 'display: $visibilità_login;'>
                    <h1>LOGIN</h1>
                    <label for='Nickname'>Nickname:</label>
                    <input type='text' name='Nickname' placeholder='Inserisci il tuo nickname'>
                    <label for='Password'>Password:</label>
                    <input type='password' name='Password' placeholder='Inserisci la tua Password'>
                  <button type='Submit' class='loginButton'>Login</button>
                  <div class='text'>
                    <p><i>Non sei registrato?</i><a href='#' onclick='mostraRegistrazione()' id= 'registrati'>Registrati!</a></p>
                    <p><i>Hai dimenticato la password?</i><a href='#' id='Reimposta' onclick='mostraReimposta()'>Reimpostala qui.</a></p>
                  </div>
                </form>

                <form id ='cambiapaswd' action='reimpostaPassword.php' onsubmit='return validazioneFormReimposta(this);'  method='post' style = 'display: $visibilità_reimposta;'>
                    <h1>REIMPOSTA PASSWORD</h1>
                    <label for='Nickname'>Nickname:</label>
                    <input type='text'required name='Nickname' placeholder='Inserisci il tuo nickname'>
                    <label for='risposta'>Risposta di sicurezza:</label>
                    <input type='text' required name='risposta' placeholder='Qual è il tuo libro preferito?' title='Qual è il tuo libro preferito?'>
                    <label for='Password'>Nuova Password:</label>
                    <div id='npass'>
                    <input type='password'required name='Password' id='newpwd' onchange='checkLiveInput(this,15);' placeholder='Inserisci la tua password' title='La password deve essere lunga dai 6 ai 15 caratteri.'>
                    <input id='nch' type='checkbox' onclick='mostraPassword(newpwd)'>Mostra Password
                    </div>
                    <label for='Password2'>Reinserici la password:</label>
                    <div id='npass2'>
                    <input type='password'required name='Password2' id='newpwd2' placeholder='Reinserisci la tua password' title='Reinserire la password.'>
                    <input id='nch2' type='checkbox' onclick='mostraPassword(newpwd2)'>Mostra Password
                    </div>
                    <button type='Submit' class='loginButton'>Conferma</button>
                    <div class='text'>
                    <p><a href='#' id='indietro' onclick='mostraLogin()'>Indietro</a>
                  </div>
                </form>

                <form id ='registrazione' action='registrazione.php' onsubmit='return validazioneForm(this);' method='post' style = 'display: $visibilità_reg;'>
                  <h1>REGISTRAZIONE</h1>
                  <label for='Nome'>Nome:</label>
                  <input type='text' onchange='checkLiveInput(this,20);' name='Nome' placeholder='Inserisci il tuo nome' title='Max 20 caratteri. Non sono consentiti caratteri speciali.'>
                  <br>
                  <label for='Cognome'>Cognome:</label>
                  <input type='text' name='Cognome' onchange='checkLiveInput(this,20);' placeholder='Inserisci il tuo cognome' >
                  <br>
                  <label for='Nickname'>Nickname (*):</label>
                  <input type='text'required name='Nickname' onchange='checkLiveInput(this,20);' placeholder='Inserisci il tuo nickname' title='Max 20 caratteri. Non è possibile utilizzare un nickname già esistente.'>
                  <br>
                  <label for='Email'>E-mail (*):</label>
                  <input type='Email'required name='Email' placeholder='Inserisci la tua e-mail'>
                  <br>
                  <label for='Password'>Password (*):</label>
                  <div id='pass'>
                  <input type='password'required name='Password' id='pwd' onchange='checkLiveInput(this,15);' placeholder='Inserisci la tua password' title='La password deve essere lunga dai 6 ai 15 caratteri.'>
                  <input id='ch' type='checkbox' onclick='mostraPassword(pwd)'>Mostra Password
                  </div>
                  <br>
                  <label for='Password2'>Reinserici la password (*):</label>
                  <div id='pass2'>
                  <input type='password'required name='Password2' id='pwd2' placeholder='Reinserisci la tua password' title='Reinserire la password.'>
                  <input id='ch2' type='checkbox' onclick='mostraPassword(pwd2)'>Mostra Password
                  </div>
                  <br>
                  <label for='Risposta'>Risposta di sicurezza (*):</label>
                  <input type='text'required name='Risposta' onchange='checkLiveInput(this,50);' placeholder='Qual è il tuo libro preferito?' title='Qual è il tuo libro preferito? (Non sono consentiti oltre 50 caratteri e quelli speciali!)'>
                  <label for='Datanascita'>Data nascita (*):</label>
                  <input type='date' required name='Datanascita' placeholder='Inserisci la tua data di nascita'>
                  <br>
                  <button type='Submit'>Registrati</button>
                  <button type='reset'>Cancella</button>
                  <div class= 'text'><p><em>(*): Campi obbligatori</em></p>
                  <a href='#' id='indietro' onclick='mostraLogin()'>Indietro</a></div>
                </form>
                ";
           ?>
    </body>
</html>
