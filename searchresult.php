<?php
require('header.php');
require('functions.php');
$woningQueryClause;
if(!empty($_POST)){
  $woning = $_POST['woning'];
  $straatnaam = $_POST['straatnaam'];
  $huisnummer = $_POST['postcode'];
  $toevoeging = $_POST['toevoeging'];
  $plaatsnaam = $_POST['plaatsnaam'];
  echo $woning."<b r/>" ;
  echo $straatnaam . "<br />";
  echo $huisnummer . "<br />";
  echo $toevoeging . "<br />";
  echo $plaatsnaam . "<br />";
  print_r($_POST);
}
if(empty($woning)){
  $woningQueryClause = "SoortBouw = 1 OR SoortBouw =2 ";
}
elseif(strcmp($woning, "bestaand")){
  $woningQueryClause = "SoortBouw = 1 ";
}
elseif(strcmp($woning, "nieuwbouw")){
  $woningQueryClause = "SoortBouw = 2 ";
}

$statement = $db->prepare("SELECT * FROM WO WHERE $woningQueryClause limit 5");
$statement->execute();



?>
<a href="./specifiek.php"> Zoek voor ander resultaat</a>
</body></html>
