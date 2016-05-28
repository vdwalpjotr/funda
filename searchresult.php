<?php
//Initial clauses, this way you can add them to a query without disrupting it if the clause is empty.
session_start();
$woningQueryClause      = " ";
$straatnaamQueryClause  = " ";
$huisnummerQueryClause  = " ";
$toevoeginQueryClause   = " ";
$plaatsnaamQueryClause  = " ";
$postcodeQueryClause    = " ";
$soortWoningQuery = " ";
if($_SESSION['CLAUSES']['soortObject'] == null){
  $_SESSION['CLAUSES']['soortObject'] = 1;
}
if(!empty($_SESSION['CLAUSES']['soortObject']) && ($_GET['soortObject'] != null)){
  $_SESSION['CLAUSES']['soortObject'] = $_GET['soortObject'];
}
if($_SESSION['offset'] == null){
  $_SESSION['offset'] = 0;
}
if((!empty($_SESSION['offset']) || $_SESSION['offset'] == 0) && ($_GET['offset'] != null)){
  $_SESSION['offset'] = $_GET['offset'];
}
if($_SESSION['lowerPrice'] == null){
  $_SESSION['lowerPrice'] = 0;
}
if((!empty($_SESSION['lowerPrice']) || $_SESSION['lowerPrice'] == 0) && ($_GET['lowerPrice'] != null)){
  $_SESSION['lowerPrice'] = $_GET['lowerPrice'];
}

if($_SESSION['CLAUSES']['aantalKamers'] == null){
  $_SESSION['CLAUSES']['aantalKamers'] = 1;
}
if((!empty($_SESSION['CLAUSES']['aantalKamers'])) && ($_GET['aantalKamers'] != null)){
  $_SESSION['CLAUSES']['aantalKamers'] = $_GET['aantalKamers'];
}

if($_SESSION['maxPrice'] == null){
  $_SESSION['maxPrice'] = 2000000;
}
if((!empty($_SESSION['maxPrice']) && ($_GET['maxPrice'] != null))){
  $_SESSION['maxPrice'] = $_GET['maxPrice'];
}

if(empty($_SESSION['CLAUSES']['soortBouw'])){
  $_SESSION['CLAUSES']['soortBouw'] = "SoortBouw = 1";
}

if(!empty($_SESSION['CLAUSES']['soortBouw']) && $_GET['soortBouw'] != null){
  $_SESSION['CLAUSES']['soortBouw'] = "SoortBouw = " . $_GET['soortBouw'];

}
if(!empty($_POST)){
  $woning     = $_POST['woning'];
  $straatnaam = $_POST['straatnaam'];
  $huisnummer = $_POST['postcode'];
  $toevoeging = $_POST['toevoeging'];
  $plaatsnaam = $_POST['plaatsnaam'];
  $postcode   = $_POST['postcode'];
  $_SESSION['POST'] = $_POST;
  if($woning == 1){
    $_SESSION['CLAUSES']['soortBouw'] = "SoortBouw = 1 ";
  }
  if($woning == 2){
    $_SESSION['CLAUSES']['soortBouw'] = "SoortBouw = 2 ";
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
