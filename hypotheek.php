<?php
	require('header.php');
	
	$prijs = "";
	if(isset($_GET["prijs"])) {
		$prijs = $_GET["prijs"];
	}
?>
<style>	
	.main-panel {
		margin-left: 5%;
		margin-right: 5%;
		width: 80%;
		line-height: 30px;
		font-size: 15px;
	}
	
	.left-panel {
		padding-right: 5%;
		padding-left: 5%;
		float: left;
		background-color:#FAFAFA;
		width:40%;
	}
	.right-panel {
		padding-right: 5%;
		padding-left: 5%;
		float: left;
		background-color:#FAFAFA;
		width:40%;
	}
	.bottom-panel {
		clear: both;
	}
	
	.line {
		margin-right: 10%;
		background-color: black;
		height: 2px;
	}
	
	#rekenen {
		display: block;
		margin: 0px auto;
		background-color: #FF6103;
		color: white;
		-moz-border-radius: 8px;
		-webkit-border-radius: 8px;
		border-radius: 8px;
		font-size: 20px;
	}
	
	#maand_hypotheek {
		margin-left: 35%;
	}
	
	input {
		border: 0px;
		background-color: #F2F2F2;
		color: black;
		height: 22px;
		-moz-border-radius: 2px;
		-webkit-border-radius: 2px;
		border-radius: 2px;		
	}
	
	
	
</style>

<div class="main-panel">
	<div class="left-panel">
		<h2>STAP 1.WAT KOST JE DROOMHUIS?</h2>
		<div class="left-panel">
			<label for="koopsom">Koopsom huis:</label>
			<br/>
			<label for="inschatting_kosten">Inschatting kosten koper:</label>
			<br/>
			<label for="bouwdepot">Bouwdepot:</label>
		</div>
		<div class="right-panel">
			<label>&euro; </label><input type="text" name="koopsom" id="koopsom" onkeypress="return isNumberKey(event)" onkeyup="addFields(event)" value="<?php echo $prijs;?>"/>
			<br/>
			<label>&euro; </label><input type="text" name="inschatting_kosten" id="inschatting_kosten" onkeypress="return isNumberKey(event)" disabled="disabled"/>
			<br/>
			<label>&euro; </label><input type="text" name="bouwdepot" id="bouwdepot" onkeypress="return isNumberKey(event)" onkeyup="addFields(event)"/>
			<br/>
			<div style="float:right; margin-right: 20%;">+</div>
		</div>
		<div class="bottom-panel">
			<div class="line"></div>
			<div class="left-panel">
				<label for="totaal">TOTAAL:</label>				
			</div>
			<div class="right-panel">
				<label>&euro; </label><input type="text" name="totaal" id="totaal" onkeypress="return isNumberKey(event)" onkeyup="addFields(event)" disabled="disabled"/>				
			</div>
			<br/>
			<br/>
		</div>
	</div>
	<div class="right-panel">
		<h2>STAP 2.WAT KAN IK LENEN?</h2>
		<div class="left-panel">
			<label for="bruto_jaarinkomen">Bruto jaarinkomen:</label>
			<br/>
			<label for="bruto_jaarinkomen_partner">Bruto jaarinkomen partner:</label>
			<br/>
			<label for="eigen_geld_overwaarde">Eigen geld / overwaarde:</label>
		</div>
		<div class="right-panel">
			<label>&euro; </label><input type="text" name="bruto_jaarinkomen" id="bruto_jaarinkomen" onkeypress="return isNumberKey(event)" onkeyup="addFields(event)"/>
			<br/>
			<label>&euro; </label><input type="text" name="bruto_jaarinkomen_partner" id="bruto_jaarinkomen_partner" onkeypress="return isNumberKey(event)" onkeyup="addFields(event)"/>
			<br/>
			<label>&euro; </label><input type="text" name="eigen_geld_overwaarde" id="eigen_geld_overwaarde" onkeypress="return isNumberKey(event)" onkeyup="addFields(event)"/>

		</div>
		<div class="bottom-panel">
			<br/>
			<button id="rekenen" onclick="bereken_hypotheek(event);">REKEN UIT</button>
			<br/>
		</div>		
	</div>
	<div id="last_bottom_panel" class="bottom-panel" hidden="hidden">
		<br/>	
		<label id="maand_hypotheek">Maandelijkse lasten: &euro; </label>
		<input id="maand_hypotheek2" type="text" disabled="disabled"></input>
	</div>
</div>


<script>	
	function isNumberKey(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}
	
	function addFields(evt) {
		var koopsom = document.getElementById("koopsom").value;
		var inschatting_kosten = 0;
		var bouwdepot = document.getElementById("bouwdepot").value;
		var totaal = 0;

		if(koopsom != "") {			
			totaal += parseInt(koopsom, 10);
			inschatting_kosten = (parseFloat(koopsom, 10) / 100) * 2;
			totaal += inschatting_kosten;
			document.getElementById("inschatting_kosten").value = inschatting_kosten;
		}
		if(bouwdepot != "") {
			totaal += parseFloat(bouwdepot);
		}
		document.getElementById("totaal").value = totaal;
	}
	
	function bereken_hypotheek(evt) {
		var bruto_jaarinkomen = document.getElementById("bruto_jaarinkomen").value;
		var bruto_jaarinkomen_partner = document.getElementById("bruto_jaarinkomen_partner").value;
		var eigen_geld_overwaarde = document.getElementById("eigen_geld_overwaarde").value;
		var totale_kosten = document.getElementById("totaal").value;
		
		var totale_hypotheek = totale_kosten - eigen_geld_overwaarde;
		var maand_hypotheek = (totale_hypotheek / 30)/12;
		document.getElementById("maand_hypotheek2").value = Number((maand_hypotheek).toFixed(2));
		document.getElementById("last_bottom_panel").hidden = false;
	}
</script>