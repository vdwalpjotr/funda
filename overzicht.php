<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
require('connect.php');
require('searchresult.php');
require('queryBuilder.php');
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
<?php print_r($_SESSION); ?>
    <table>
      <tr>
        <td id="data" valign="top">
          <div class="head">Prijsklasse van/tot</div>
          <form method="GET" action="./overzicht.php">
              <select name="lowerPrice" id="lowerPrice" onchange="this.form.submit()">
                <option value="0"       <?php if($_SESSION['lowerPrice'] == 0 ) { echo "selected"; } ?>>
                  €0,-</option>
                <option value="50000"   <?php if($_SESSION['lowerPrice'] == 50000 ) { echo "selected"; }?>>
                  €50.000,-</option>
                <option value="75000"   <?php if($_SESSION['lowerPrice'] == 75000 ) { echo "selected"; }?>>
                  €75.000,-</option>
                <option value="100000"  <?php if($_SESSION['lowerPrice'] == 100000 ) { echo "selected"; }?>>
                  €100.000,-</option>
                <option value="125000"  <?php if($_SESSION['lowerPrice'] == 125000 ) { echo "selected"; }?>>
                  €125.000,-</option>
                  <option value="250000"  <?php if($_SESSION['lowerPrice'] == 250000 ) { echo "selected"; }?>>
                    €250.000,-</option>
                    <option value="500000"  <?php if($_SESSION['lowerPrice'] == 500000 ) { echo "selected"; }?>>
                      €500.000,-</option>
              </select>
              <select name="maxPrice" id="maxPrice" onchange="this.form.submit()">
                <option value="50000"   <?php if($_SESSION['maxPrice'] == 50000 ) { echo "selected"; }?>>
                  €50.000,-</option>
                <option value="75000"   <?php if($_SESSION['maxPrice'] == 75000 ) { echo "selected"; }?>>
                  €75.000,-</option>
                <option value="100000"  <?php if($_SESSION['maxPrice'] == 100000 ) { echo "selected"; }?>>
                  €100.000,-</option>
                <option value="125000"  <?php if($_SESSION['maxPrice'] == 125000 ) { echo "selected"; }?>>
                  €125.000,-</option>
                  <option value="250000"  <?php if($_SESSION['maxPrice'] == 250000 ) { echo "selected"; }?>>
                    €250.000,-</option>
                    <option value="500000"  <?php if($_SESSION['maxPrice'] == 500000 ) { echo "selected"; }?>>
                      €500.000,-</option>
                      <option value="750000"  <?php if($_SESSION['maxPrice'] == 750000 ) { echo "selected"; }?>>
                        €750.000,-</option>
                        <option value="2000000"  <?php if($_SESSION['maxPrice'] == 2000000 ) { echo "selected"; }?>>
                          €2.000.000,-</option>
              </select>
          </form>
          <div class="head">Soort object</div>
          <div class="content">
            <form method="GET" action="./overzicht.php">
              <input type="radio" name="soortObject" value="1" onclick="this.form.submit()" <?php if($_SESSION['CLAUSES']['soortObject'] == 1){ echo "checked";}?>>Woonhuis <br />
              <input type="radio" name="soortObject" value="2" onclick="this.form.submit()" <?php if($_SESSION['CLAUSES']['soortObject'] == 2){ echo "checked";}?>>Appartement <br />
            </form>
          </div>

          <div class="head">Soort bouw</div>
          <div class="content">

            <form method="GET" action="./overzicht.php">
              <input type="radio" name="soortBouw" value="1" onclick="this.form.submit()" <?php if($_SESSION['CLAUSES']['soortBouw'][12] == 1){ echo "checked";}?>>Bestaand <br />
              <input type="radio" name="soortBouw" value="2" onclick="this.form.submit()" <?php if($_SESSION['CLAUSES']['soortBouw'][12] == 2){ echo "checked";}?>>Nieuwbouw <br />
            </form>
          </div>

          <div class="head">Aantal kamers</div>
          <div class="content">
            <a href="#" class="licht">Data</a>
            <form method="get" action="./overzicht.php">
              <select name="aantalKamers" id="aantalKamers" onchange="this.form.submit()">
                <option value="1" <?php if($_SESSION['CLAUSES']['aantalKamers'] == 1){ echo "selected";}?>>1+ Kamers</option>
                <option value="2" <?php if($_SESSION['CLAUSES']['aantalKamers'] == 2){ echo "selected";}?>>2+ Kamers</option>
                <option value="3" <?php if($_SESSION['CLAUSES']['aantalKamers'] == 3){ echo "selected";}?>>3+ Kamers</option>
                <option value="4" <?php if($_SESSION['CLAUSES']['aantalKamers'] == 4){ echo "selected";}?>>4+ Kamers</option>
                <option value="5" <?php if($_SESSION['CLAUSES']['aantalKamers'] == 5){ echo "selected";}?>>5+ Kamers</option>
              </select>
            </form>
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
