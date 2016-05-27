<?php
//Initial clauses, this way you can add them to a query without disrupting it if the clause is empty.
$woningQueryClause      = " ";
$straatnaamQueryClause  = " ";
$huisnummerQueryClause  = " ";
$toevoeginQueryClause   = " ";
$plaatsnaamQueryClause  = " ";
$postcodeQueryClause    = " ";

if(!empty($_POST)){
  $woning     = $_POST['woning'];
  $straatnaam = $_POST['straatnaam'];
  $huisnummer = $_POST['postcode'];
  $toevoeging = $_POST['toevoeging'];
  $plaatsnaam = $_POST['plaatsnaam'];
  $postcode   = $_POST['postcode'];
  print_r($_POST);
}
if(empty($woning)){
  $woningQueryClause = "SoortBouw = 1 OR SoortBouw =2 ";
}
elseif(strcmp($woning, "nieuwbouw")){
  $woningQueryClause = "SoortBouw = 1 ";
}
elseif(strcmp($woning, "bestaand")){
  $woningQueryClause = "SoortBouw = 2 ";
}
if(!empty($_POST['straatnaam'])){
  $straatnaamQueryClause = "AND Address LIKE '%".$_POST['straatnaam']."%' ";
}
if(!empty($_POST['huisnummer'])){
  $huisnummerQueryClause = "AND Address LIKE '%".$_POST['huisnummer']."%' ";
}
if(!empty($_POST['toevoeging'])){
  $toevoeginQueryClause = "AND Address LIKE '%".$_POST['toevoeging']."' ";
}
if(!empty($_POST['plaatsnaam'])){
  $plaatsnaamQueryClause = "AND plaatsnaam ='".$_POST['plaatsnaam']."'";
}
if(!empty($_POST['postcode'])){
  $postcodeTemp = trim($_POST['postcode']);
  $postcodeNumbers = substr($postcodeTemp, 0, 4);
  $postcodeLetters = trim(substr($postcodeTemp, 4));
  $postcode = $postcodeNumbers . " " . $postcodeLetters;
  $postcodeQueryClause = "AND PC LIKE '%$postcode%'";
}

 ?>
