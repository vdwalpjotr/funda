<?php
require('header.php');
require('connect.php');
require('queryBuilder.php');
try{
$omschrijvingStatement = $db->prepare($sqlOmschrijving);
$omschrijvingStatement->execute();
$result = $omschrijvingStatement->fetch(PDO::FETCH_ASSOC);
?>

<div style="border: solid gray 1px; width: 600px; padding: 6px; margin-left: 30px;">
<?php echo $result['omschrijving'];?>
<a href="kenmerken.php">Alle kenmerken van <?php echo $result['ADDRESS']; ?></a>
<?php }catch(PDOException $e){
  print $e->getMessage();
}?>
</div>

</body></html>
