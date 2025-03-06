<?php
  #inizializzo dati Sessione
  $nick=$_SESSION['nickname'];
  if(isset($_GET['visualizzaRec'])){
    $param="none";
  }
  else {
    $param="block";
  }
  include("logindb.php");
  #trovo i dati dell'utente attraverso una query al db
  $sql = "SELECT nome, cognome,data_di_nascita,mail FROM utenti where utenti.nickname='$nick'";
  $ris = pg_query($db, $sql);
  $row = pg_fetch_assoc($ris);
  $nome = $row['nome'];
  $cognome = $row['cognome'];
  $datanascita = $row['data_di_nascita'];
  $dataITA = date("d-m-Y",strtotime($datanascita));
  $email = $row['mail'];
  #mostro i Dati
  echo "
  <div id='datipersonali' style = 'display: $param;'>
    <h2>Dati personali</h2>
    <div id=InformazioniUtente>
      <h3>Informazioni Utente</h3>
      <p><b>Nome</b>: $nome</p>
      <p><b>Cognome</b>: $cognome</p>
      <p><b>Data di nascita</b>: $dataITA</p>
    </div>
    <div id=InformazioniProfilo>
      <h3>Informazioni Profilo</h3>
      <p><b>E-mail</b>: $email</p>
      <p><b>Nickname</b>: $nick</p>
    </div>
  </div>
  ";

?>
