<?php
include("logindb.php");
if(isset($_GET['ordine'])){
  $param=$_GET['ordine'];
}
else {
  $param="titolo";
}
if(isset($_GET['genere'])){
  $genere=$_GET['genere'];
  echo"<h1 style = 'text-align: center;'>$genere</h1>";
  $sql ="SELECT titolo,copertina,ISBN,prezzo,voto,num_recensioni from libri where libri.genere = '$genere'";
}
else{
  $sql="SELECT titolo,copertina,ISBN,prezzo,voto,num_recensioni from libri order by $param";
}
$ret = pg_query($db, $sql);

//visualizzo i libri
echo'<div class="container">';
while ($row = pg_fetch_assoc($ret)){
   $titolo= $row['titolo'];
   $copertina= $row['copertina'];
   $ISBN= $row['isbn'];
   $prezzo= $row['prezzo'];
   $voto= $row['voto'];
   $num_recensioni= $row['num_recensioni'];
   echo "<div class='grid-item'><a href='VisualizzaLibro.php?libro=$ISBN'>
         <img src='$copertina' width='289' height='425'></a><br>
         <span><b>$titolo<br>$prezzo € &nbsp &nbsp &nbsp $voto <i class='fa-solid fa-star'></i> ($num_recensioni)</b></span></div>";
}
?>
