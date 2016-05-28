<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
require('connect.php');
require('searchresult.php');
session_start();
$sqlCount = "SELECT COUNT(*) as cnt FROM WO $woningQueryClause $straatnaamQueryClause $huisnummerQueryClause $toevoeginQueryClause $plaatsnaamQueryClause $postcodeQueryClause";
$sqlSelect = "SELECT wo.ADDRESS as ADDRESS,
wo.PC as PC,
wo.CITY as city,
det.WOON_OPPERVLAKTE as WOON_OPPERVLAKTE,
det.AantalKamers as aantal_kamers,
wo_ad.vraagprijs as vraagprijs,
mk.name as makelaar,
svp.name as prijsnaam
FROM WO
INNER JOIN wo_ad
ON wo_ad.WOID = wo.WOID
INNER JOIN wo_details as det
ON wo.WOID = det.WOID
INNER JOIN mkantoor as mk
ON wo.mkID = mk.mkID
INNER JOIN soortvraagprijs as svp
ON wo_ad.vraagprijs_soort = svp.ID
$woningQueryClause $straatnaamQueryClause $huisnummerQueryClause $toevoeginQueryClause $plaatsnaamQueryClause $postcodeQueryClause LIMIT 6 OFFSET ".$_SESSION['offset'];
try{
  $statement = $db->prepare($sqlCount);
  $statement->execute();
  while($count = $statement->fetch()){
    $cnt = $count['cnt'];
  }

}catch(PDOException $e){
  echo $e->getMessage;
}


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
      <li class="active">Woningaanbod</li>
      <li>Verkoop</li>
      <li>NVM Makelaars</li>
      <li>Gids</li>
      <li>Verhuizen</li>
      <li>My Funda</li>
    </ul>
  </div>

  <div id="nav">
    <ul>
      <li><a href="index.html" class="active">Koopwoningen</a></li>
      <li>Huurwoningen</li>
      <li>Nieuwbouwprojecten</li>
      <li>Recreatiewoningen</li>
      <li>Europa</li>
    </ul>
  </div>

  <div id="txt">
    <?php echo $cnt?> koopwoningen gevonden
  </div>

  <div id="main">

    <table>
      <tr>
        <td id="data" valign="top">
          <div class="head">Prijsklasse van/tot</div><br/>
          <div class="head">Soort object</div>
          <div class="content">
            <a href="#" class="licht">Data</a>
            <!-- DATA WEERGEVEN -->
          </div>

          <div class="head">Soort bouw</div>
          <div class="content">
            <a href="#" class="licht">Data</a>
            <!-- DATA WEERGEVEN -->
          </div>

          <div class="head">Aantal kamers</div>
          <div class="content">
            <a href="#" class="licht">Data</a>
            <!-- DATA WEERGEVEN -->
          </div>

          <div class="head">Woonoppervlakte</div>
          <div class="content">
            <a href="#" class="licht">Data</a>
            <!-- DATA WEERGEVEN -->
          </div>
        </td>
        <td valign="top">
          <?php


          try{
            $limitStatement = $db->prepare($sqlSelect);
            $limitStatement->execute();

            while($row = $limitStatement->fetch(PDO::FETCH_ASSOC)){          ?>


              <div class="huisdata">
                <div class="head"><a class="normal" href="detail.php"><?php echo $row['ADDRESS']; ?> </a></div><div class="prijs">€ <?php echo $row['vraagprijs']." ".$row['prijsnaam'];?></div><br/>
                <span class="adres"><?php echo $row['PC']." ".$row['plaatsnaam'];?><br/><?php echo $row['WOON_OPPERVLAKTE'];?> m<sup>2</sup> - <?php echo $row['aantal_kamers'];?> kamers</span><br/>
                <span><a class="makelaar" href="makelaar.php"><?php echo $row['makelaar'];?></a></span>
              </div>


              <?php
            }
          }catch(PDOException $d){
            print($e->getMessage());
          }
          ?>
            <div style="text-align: center;">
      <ul>
        <?php $pagCount = round($cnt / 6);

        if($pagCount > 20){
          $pagCount = 20;
        }
        for($i= 0; $i< $pagCount; $i++ ){ ?>
        <li><a href="./overzicht.php?offset=<?php echo $i*6;?>"><?php echo $i;?></a></li>
      <?php }?>
      </ul>
    </div>
  </td>
</tr>
</table>

  </div>



</body></html>
