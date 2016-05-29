<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
require('connect.php');
require('queryBuilder.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>Funda</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <link rel="stylesheet" href="style.css" type="text/css"/>
</head>

<body>

<div id="logo">
  <img src="img/funda-logo-hp.gif" id="toplogo" alt="toplogo"/>
</div>


<div id="balk">
  <ul>
    <li class="active">Woningaanbod</a></li>
    <li>Verkoop</li>
    <li>NVM Makelaars</li>
    <li>Gids</li>
    <li>Verhuizen</li>
    <li>My Funda</li>
  </ul>
</div>
<?php
try{

$detailStatement = $db->prepare($sqlDetailSelect);
$detailStatement->execute();
$result = $detailStatement->fetch(PDO::FETCH_ASSOC);
?>
<div id="main">
  <div id="adresgegevens">
    <div class="head"><?php echo $result['ADDRESS'];?></div>
    <div class="adres"><?php echo $result['PC']." ".$result['CITY'];?></div>
    <div class="prijs">€ <?php echo $result['vraagprijs']." ".$result['prijsnaam'];?></div>
  </div>

  <div id="details">
    <ul>
      <li><a href="detail.html" class="active">Overzicht</a></li>
      <li><a href="omschrijving.html" class="licht">Omschrijving</a></li>
      <li><a href="kenmerken.html" class="licht">Kenmerken</a></li>
      <li><a href="hypotheek.html" class="licht">Hypotheek</a></li>
      <li><a href="afspraak.html" class="licht">Afspraak makelaar</a></li>

    </ul>

    <div id="content">
      <div><?php echo $result['omschrijving']."....";?><a href="omschrijving.php?woid=<?php echo $_GET['woid']?>">Volledige omschrijving</a></div>


      <table id="kenmerken">
        <tr><th colspan="2">Kenmerken</th></tr>

        <tr><td class="kop">Soort appartement</td><td>Gallerij</td></tr>
        <tr><td class="kop">Soort appartement</td><td>Gallerij</td></tr>
        <tr><td class="kop">Soort appartement</td><td>Gallerij</td></tr>
        <tr><td class="kop">Soort appartement</td><td>Gallerij</td></tr>
        <tr><td class="kop">Soort appartement</td><td>Gallerij</td></tr>
      </table>
      <a href="kenmerken.php?woid=<?php echo $_GET['woid']?>">Alle kenmerken</a>
<?php }catch(PDOException $e){
  print $e->getMessage();
} ?>
    </div>
  </div>
</div>


</body></html>
