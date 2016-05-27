<?php
require('header.php');
require('functions.php');

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

$statement = $db->prepare("SELECT * FROM")


?>
<a href="./specifiek.php"> Zoek voor ander resultaat</a>
</body></html>
