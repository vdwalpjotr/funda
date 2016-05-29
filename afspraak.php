<?php
	require('header.php');
	require('connect.php');
	
	if(isset($_POST['submit'])) {
	
		$insert_afspraak =	"INSERT INTO `funda`.`afspraak` ".
							"(`MKMDWID`, ".
							"`WOID`, ".
							"`afspraak_date_time`) ".
							"VALUES ( ".
							$_POST['medewerker_id'].", ".
							$_POST['woning_id'].", ".
							"STR_TO_DATE('".$_POST['afspraken-lijst']."', '%Y-%m-%d %H:%i:%s') ".
							");";
		
		try{
		  $statement = $db->prepare($insert_afspraak);
		  $statement->execute();
		}catch(PDOException $e){
		  echo $e->getMessage;
		}	
		?>
		
		<h3>Thank you for the reservation. Please have fun with fucking yourself on:</h3>
		<h4><?php echo $_POST['afspraken-lijst'];?></h4>
		
		<?php
		exit();
	}
	
	
	$woning_id = 15271;
	if(isset($_GET["woning_id"])) {
		$woning_id = $_GET["woning_id"];
	}
	
	$medewerker_id;
	
	$select_medewerker_id = 	"SELECT mkantoormdw.MKMDWID ".
								"FROM funda.wo ".
								"INNER JOIN funda.mkantoormdw ".
								"ON wo.MKID = mkantoormdw.MKID ".
								"WHERE wo.WOID = ".$woning_id.
								" LIMIT 1;";
	
	try{
	  $statement = $db->prepare($select_medewerker_id);
	  $statement->execute();
	  while($medewerker = $statement->fetch()){
		$medewerker_id = $medewerker['MKMDWID'];
		//echo "<br/>".$medewerker_id."<br/>";
	  }

	}catch(PDOException $e){
	  echo $e->getMessage;
	}
	//$medewerker_id = 738;
	
	$times = array("09:30:00", "10:00:00", "10:30:00", "11:00:00", "11:30:00", "12:00:00", "12:30:00", "13:00:00", "13:30:00", "14:00:00", "14:30:00", "15:00:00", "15:30:00", "16:00:00");
	$beschikbare_afspraken = array();
	
	$day = date("d");
	$month = date("m");
	$year = date("Y");
	
	$counter = 0;
	
	while(Count($beschikbare_afspraken) < 5) {
		$select_medewerker_afspraken = "SELECT Count(*) as count_afspraken ".
		"FROM funda.afspraak ".
		"WHERE afspraak.MKMDWID = ".$medewerker_id.
		" AND afspraak.afspraak_date_time = str_to_date('".$year."-".$month."-".$day." ".$times[$counter]."', '%Y-%m-%d %H:%i:%s');";
		
		$count_afspraken = 0;
		try{
		  $statement = $db->prepare($select_medewerker_afspraken);
		  $statement->execute();
		  while($afspraak = $statement->fetch()){
			$count_afspraken = $afspraak['count_afspraken'];
			//echo "<br/>".$count_afspraken."<br/>";
		 }
		}catch(PDOException $e){
		  echo $e->getMessage;
		}
		
		if($count_afspraken == 0) {
			array_push($beschikbare_afspraken, $year."-".$month."-".$day." ".$times[$counter]);
		}
		
		$counter++;
		if($counter >= 14) {
			$counter = 0;
			$day + 1;
		}
	}
	
	//print_r($beschikbare_afpsraken);	
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<h2>There are appointments left on the following moments to go fuck yourself:</h2>
	<select name="afspraken-lijst" id="afspraken-lijst">
	  <option selected="selected">Choose one</option>
	  <?php
		foreach($beschikbare_afspraken as $afspraak) { ?>
		  <option value="<?php echo $afspraak; ?>"><?php echo $afspraak;?></option>
	  <?php
		} ?>
	</select>
	<input type="hidden" name="medewerker_id" value="<?php echo $medewerker_id; ?>">
	<input type="hidden" name="woning_id" value="<?php echo $woning_id; ?>">
	<input type="submit" name="submit" value="Submit Form">
<form>