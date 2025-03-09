<?php
session_start();
if($_SESSION["evd_zaber_hamacek"]!= true){
	header('Location: /TP-2-0/web_app_ev_clip_about_p_transport/index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<title id="demo">SEM ZADEJTE NÁZEV</title>
<link rel="stylesheet" href="../styles/stylopis.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div class="container">
<header>
<h1 id="demoI">SEM ZADEJTE NÁZEV</h1>
</header>

<nav>

	
	<button class="vstup phoneonly" onclick="podrob_zavr()">=
	</button>
	<button class="vstup" onclick="history.back()">ZPĚT</button>
	<div id="prvek" class="nezobrazitm">
	
	
</nav>

<main>

<section class="one_section">
<?php
include "personalization_class.php";
if($_SESSION["isadmin"]==1){
	
	$string = file_get_contents("../js/info.json");
	$json_a = json_decode($string);

	echo "<form method='POST'>";
	echo "<table class='podrobnostitab'>";
	echo "<tr><th class='podrobnostitab'>hlavička</th><td><input name='headerr' type='text' class='vstupIII' value='".$json_a->name."'></td></tr>";
	echo "<tr><th class='podrobnostitab'>provozovatel</th><td><input name='owner' type='text' class='vstupIII' value='".$json_a->owner."'></td></tr>";
	echo "<tr><th class='podrobnostitab'>banner</th><td><input name='banner' type='text' class='vstupIII' value='".$json_a->banner."'></td></tr>";
	echo "<tr><td><input name='send' type='submit' class='vstup' value='uložit'></td></tr>";
	echo "</table>";
	echo "</form>";
	
	if(array_key_exists('send',$_POST)){
		$personalization_class = new Personalization();
		$personalization_class->set_name($_POST['headerr']);
		$personalization_class->set_owner($_POST['owner']);
		$personalization_class->set_banner($_POST['banner']);
		file_put_contents('../js/info.json', json_encode($personalization_class,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
	}

	
}else{
	echo "neoprávnění přístup";
}
?>
</section>



</main>

</div>
<script src="../js/info.js"></script>
</body>
</html>