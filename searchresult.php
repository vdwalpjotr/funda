<?php
//Initial clauses, this way you can add them to a query without disrupting it if the clause is empty.
session_start();
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
  $_SESSION['POST'] = $_POST;

  if(empty($woning)){
    $woningQueryClause = "SoortBouw = 1 OR SoortBouw =2 ";
  }
  elseif(strcmp($woning, "nieuwbouw")){
    $woningQueryClause = "SoortBouw = 1 ";
  }
  elseif(strcmp($woning, "bestaand")){
    $woningQueryClause = "SoortBouw = 2 ";
  }
  $_SESSION['CLAUSES']['woning'] = $woningQueryClause;
  if(!empty($_POST['straatnaam'])){
    $straatnaamQueryClause = "AND wo.Address LIKE '%".$_POST['straatnaam']."%' ";
  }
  if(!empty($_POST['huisnummer'])){
    $huisnummerQueryClause = "AND wo.Address LIKE '%".$_POST['huisnummer']."%' ";
  }
  if(!empty($_POST['toevoeging'])){
    $toevoeginQueryClause = "AND wo.Address LIKE '%".$_POST['toevoeging']."' ";
  }
  if(!empty($_POST['plaatsnaam'])){
    $plaatsnaamQueryClause = "AND wo.city ='".$_POST['plaatsnaam']."'";
  }
  if(!empty($_POST['postcode'])){
    $postcodeTemp = trim($_POST['postcode']);
    $postcodeNumbers = substr($postcodeTemp, 0, 4);
    $postcodeLetters = trim(substr($postcodeTemp, 4));
    $postcode = $postcodeNumbers . " " . $postcodeLetters;
    $postcodeQueryClause = "AND wo.PC LIKE '%$postcode%'";
  }
}
?>
