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
<link rel="stylesheet" href="styles/stylopis.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- <script src="lib/urlparse.js"></script>-->
</head>


<body>

<div class="container">
<header>
<h1 id="demoI">SEM ZADEJTE NÁZEV</h1>
</header>

<!-- <script src="../js/info.js"></script>-->
<!-- <script src="lib/sorttable.js"></script>-->
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

<nav>
	<button class="vstup" onclick="history.back()">ZPĚT</button>
	<form method="POST">
	
	
	<input type="input" class="vstupIII" name="directory" value="sem zadejte název adresáře"/>
	
	<input type="submit" class="vstup" value="vytvořit adresář" name="create"/>
	<input type="submit" class="vstup" value="smazat adresář" name="delete"/>
	</form>
	<script>
	var e = document.getElementById("rok");
	//var value = e.value;
	var text = e.options[e.selectedIndex].text;
</script>	
</nav>
<main>
<section class="one_section">
<h1>Výpis adresářu uživatele <?php echo $_SESSION["name"];?></h1>
<div class="vlevo">
<?php
$dir = $_SESSION["name"];

// Sort in ascending order - this is default
$a = array_diff(scandir($dir), array('.', '..'));

foreach($a as $e){
	echo $e."<br>";
}

if(array_key_exists('delete',$_POST)){

	rmdir($_SESSION["name"]."\\".$_POST["directory"]."\\");
	header('Location: /TP-2-0/web_app_ev_clip_about_p_transport/edit_directories.php');
}

if(array_key_exists('create',$_POST)){

	mkdir($_SESSION["name"]."\\".$_POST["directory"]."\\");
	header('Location: /TP-2-0/web_app_ev_clip_about_p_transport/edit_directories.php');
}

?>

</div>
</section>
</main>
</div>
</body>
</html>