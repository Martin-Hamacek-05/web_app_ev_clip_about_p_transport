<?php
session_start();
if($_SESSION["evd_zaber_hamacek"]!= true){
		echo "<script>window.location.replace('http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'))."/index.php');</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
<title id="demo">SEM ZADEJTE NÁZEV</title>
<link rel="stylesheet" href="styles/stylopis.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- <script src="lib/urlparse.js"></script>-->
</head>


<body>

<div class="container">
<header>
<h1 id="demoI">SEM ZADEJTE NÁZEV</h1>
</header>

<script src="js/info.js"></script>

<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

<nav>
	<form action="list.php" method="GET">
	<button class="vstup">ZPĚT
	</button>
	</form>
	<form action="statistika_loaded.php" method="GET">
	<select class="vstup" name="procedura">
		<?php include("other/load_statistic.php");
		$statistic = new statistic;
		$statistic->procedure_load();
		?>
	</select>

	<select class="vstup" id="rok" name="parametr">
	<option value="---vyberte---" selected="selected">vyberte</option>;
	<?php 
	include("other/vypisroku.php");
	?>
	</select>
	<select class="vstup" name="graph">
	<option value="bar">sloupcový</option>
	<option value="marker">bodový</option>
	</select>
	<input type="submit" class="vstup" value="načíst"/>
	</form>
	<script>
	var e = document.getElementById("rok");
	//var value = e.value;
	var text = e.options[e.selectedIndex].text;
</script>	
</nav>
<main>
</main>
</div>
</body>
</html>