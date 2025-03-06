<?php
  #inizializzo dati Sessione
  $nick=$_SESSION['nickname'];
  if(isset($_GET['visualizzaRec'])){
    $param="grid";
  }
  else {
    $param="none";
  }
  echo"
  <h1 id=RecTit style = 'display: $param;'>Le mie recensioni</h1>
  <div id='mierecensioni' style = 'display: $param;'>

  ";
  include("logindb.php");
  #trovo i dati dell'utente attraverso una query al db
  $sql = "SELECT nome,contenuto,r.voto,data_inserimento,titolo,copertina, isbn from recensioni r,libri l where libro=ISBN and utente ='$nick'";
  $ris = pg_query($db, $sql);
  while($row = pg_fetch_assoc($ris)){
    $nome = $row['nome'];
    $contenuto = $row['contenuto'];
    $data = $row['data_inserimento'];
    $voto = $row['voto'];
    $copertina = $row['copertina'];
    $titolo = $row['titolo'];
    $isbn = $row['isbn'];
    echo"<div class='VisualizzaLibro'><a href='VisualizzaLibro.php?libro=$isbn'>
        <img src='$copertina' width='180' height='280'></a>
        <br><br>
        <a href='VisualizzaLibro.php?libro=$isbn'><input type='button' value='Modifica Recensione'/></a>
        <br><br>
        <a href='eliminaRec.php?nick=$nick&libro=$isbn' onclick='checkerRec()'><input type='button' value='Elimina Recensione'/></a>
    </div>
    <div id=RecCont>
      <p><b>$titolo</b></p>
      <p style='width:400px; word-wrap: break-word;'>$nome &nbsp $voto <i class='fa-solid fa-star'></i><br>
         $contenuto</p>
      <p>Inserito il $data<br></p>
    </div>

    ";
}
  echo "
  </div>";
  ?>
