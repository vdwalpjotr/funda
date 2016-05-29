<?php
require('header.php');
require('connect.php');
require('queryBuilder.php');
try{
  $omschrijvingStatement = $db->prepare($sqlDetailSelect);
  $omschrijvingStatement->execute();
  $result = $omschrijvingStatement->fetch(PDO::FETCH_ASSOC);
  ?>
  <div id="main">
    <div id="adresgegevens">
      <div class="head"><?php echo $result['ADDRESS'];?></div>
      <div class="adres"><?php echo $result['PC']." ".$result['CITY'];?></div>
      <div class="prijs">€ <?php echo $result['vraagprijs']." ".$result['prijsnaam'];?></div>
    </div>
    <div id="details">
      <ul>
        <li><a href="detail.php?woid=<?php echo $_GET['woid'];?>" class="licht">Overzicht</a></li>
        <li><a href="omschrijving.php?woid=<?php echo $_GET['woid'];?>" class="active">Omschrijving</a></li>
        <li><a href="kenmerken.php?woid=<?php echo $_GET['woid'];?>" class="licht">Kenmerken</a></li>
        <li><a href="hypotheek.php?prijs=<?php echo $result['vraagprijs'];?>" class="licht">Hypotheek</a></li>
        <li><a href="afspraak.html" class="licht">Afspraak makelaar</a></li>
        <li><a href="specifiek.php" class="licht">Back</a></li>

      </ul>

      <div id="content">

          <?php echo $result['omschrijvingLang'];?>
          <a href="kenmerken.php">Alle kenmerken van <?php echo $result['ADDRESS']; ?></a>
          <?php }catch(PDOException $e){
            print $e->getMessage();
          }?>

      </div>
    </div>
  </div>
</body></html>
