<?php
require('header.php');
require('connect.php');
require('queryBuilder.php');
?>
<?php
try{

  $detailStatement = $db->prepare($sqlDetailSelect);
  $detailStatement->execute();
  $result = $detailStatement->fetch(PDO::FETCH_ASSOC);

  ?>

<div id="main">
  <div id="details">
    <div id="adresgegevens">
      <div class="head"><?php echo $result['ADDRESS'];?></div>
      <div class="adres"><?php echo $result['PC']." ".$result['CITY'];?></div>
      <div class="prijs">€ <?php echo $result['vraagprijs']." ".$result['prijsnaam'];?></div>
    </div>

      <ul>
        <li><a href="detail.php?woid=<?php echo $_GET['woid'];?>" class="licht">Overzicht</a></li>
        <li><a href="omschrijving.php?woid=<?php echo $_GET['woid'];?>" class="licht">Omschrijving</a></li>
        <li><a href="kenmerken.php?woid=<?php echo $_GET['woid'];?>" class="active">Kenmerken</a></li>
        <li><a href="hypotheek.php?prijs=<?php echo $result['vraagprijs'];?>" class="licht">Hypotheek</a></li>
        <li><a href="afspraak.html" class="licht">Afspraak makelaar</a></li>
        <li><a href="specifiek.php" class="licht">Back</a></li>

      </ul>
      <div id="content">
        <table id="kenmerken">
          <tr><th colspan="2">Overdracht</th></tr>
          <tr><td class="kop">Prijs</td><td>€ <?php echo $result['vraagprijs']." ".$result['prijsnaam'];?></td></tr>
          <tr><td class="kop">Aangeboden sinds</td><td><?php echo $result['weeksPassed']." weken geleden";?></td></tr>
          <tr><td class="kop">Status</td><td><?php echo $result['statusWoning'];?></td></tr>
          <tr><td class="kop">Makelaar</td><td><?php echo $result['makelaarName'];?></td></tr>
          <tr><th colspan="2">Bouw</th></tr>
          <tr><td class="kop">Soort Woning</td><td><?php echo $result['typeWoning'].", ".$result['soortWoning'];?></td></tr>
          <tr><td class="kop">Type Woning</td><td><?php echo $result['soortObject'];?></td></tr>
          <tr><td class="kop">Soort Bouw</td><td><?php echo $result['soortBouw'];?></td></tr>
          <tr><td class="kop">Bouwjaar</td><td><?php echo $result['bouwJaar'];?></td></tr>
          <tr><th colspan="2">Locatie</th></tr>
          <tr><td class="kop">Plaats</td><td><?php echo $result['CITY'];?></td></tr>
          <tr><td class="kop">Adres</td><td><?php echo $result['ADDRESS'];?></td></tr>
          <tr><td class="kop">Postcode</td><td><?php echo $result['PC'];?></td></tr>
          <?php $selectLiggingStatement = $db->prepare($selectLiggingQuery);
          $selectLiggingStatement->execute(); ?>
          <tr><td class="kop">Ligging</td><td>
            <?php $liggingString = " ";
                  while($row = $selectLiggingStatement->fetch(PDO::FETCH_ASSOC)){
                      $liggingString .=  $row['ligging'].", ";

                    } echo substr($liggingString, 0, -2);
          ?></td></tr>
            <tr><th colspan="2">Oppervlakten</th></tr>
            <tr><td class="kop">Woonoppervlakte</td><td><?php echo $result['woonOppervlakte']." m";?><sup>2<sup></td></tr>
            <tr><td class="kop">Inhoud woning</td><td><?php echo $result['woonInhoud']." m";?><sup>3<sup></td></tr>
            <tr><td class="kop">Oppervlakte tuin</td><td><?php echo $result['tuinOppervlakte']." m";?><sup>2<sup></td></tr>
            <tr><td class="kop">Perceel oppervlakte</td><td><?php echo $result['perceelOppervlakte']." m";?><sup>2<sup></td></tr>
            <tr><th colspan="2">Kamers</th></tr>
            <tr><td class="kop">Aantal kamers</td><td><?php echo $result['aantalKamers'];?></td></tr>
            <tr><td class="kop">Aantal badkamers</td><td><?php echo $result['aantalBadkamers'];?></td></tr>
            <tr><td class="kop">Aantal woonlagen</td><td><?php echo $result['aantalWoonlagen'];?></td></tr>
        </table>

        <?php }catch(PDOException $e){
          print $e->getMessage();
        } ?>
      </div>
    </div>
  </div>
</body></html>
