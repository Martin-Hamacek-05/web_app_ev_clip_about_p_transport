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
</head>


<body>

<div class="container">
<header>
<h1 id="demoI">SEM ZADEJTE NÁZEV</h1>
</header>


<script src="js/info.js"></script>

<nav>
<form action="list.php">
	<button class="vstup">ZPĚT
	</button>
	</form>
</nav>
<main>
<section class="one_section">
<div class="vlevo">
<form method="post" enctype="multipart/form-data">
<input type="file" class="button" name="fileToUpload" id="fileToUpload" onchange="showname()">
<?php
include("other/connection.php");
include("other/prefix.php");
echo "<table class='podrobnostitab'>";
	echo "<tr><th class='podrobnostitab'>Označení záznamu</th><td><input name='ozcnzaz' id='file_ozncn' type='input' class='vstupIII'></td></tr>";
	echo "<tr><th class='podrobnostitab'>Pořízeno</th><td><input name='datump' type='date' class='vstupIII'></td></tr>";
	echo "<tr><th class='podrobnostitab'>Číslo natáčecího dne</th><td><input name='cslntdn' type='number' class='vstupIII'></td></tr>";
	echo "<tr><th class='podrobnostitab'>Pořadí</th><td><input name='poradi' type='number' class='vstupIII'></td></tr>";
	echo "<tr><th class='podrobnostitab'>Adresář</th><td>";?>
	<select class='vstup' name='directory'>
	<?php
	$dir = $prefix;

	// Sort in ascending order - this is default
	$a = array_diff(scandir($dir), array('.', '..'));
	
	foreach ($a as $x) {
	  echo "<option value='$x'>$x</option>";
	}
	
	?>
	</select>
	
	<?php
	echo "</td></tr><tr><th class='podrobnostitab'>Přijezd 0/odjezd 1</th><td><input name='prjodj' type='number' class='vstupIII'></td></tr>";
	
	
	echo "<tr><th class='podrobnostitab'>Formát záznamu</th><td>";?>
	<select class='vstup' name='formats'>
<?php
include("other/vypisy.php");
include("other/spravazaber.php");
$vypisysvybr = new Vypisy();
$vypisysvybr -> vypisformaty($servername,$username,$password,$dbname);
?>	
</select>
	<?php
	echo"</td></tr>";
	
	;
	echo "<tr><th class='podrobnostitab'>Název zastávky</th><td>";
	?>
	<select class='vstup' name='zastavka'>
	<?php
	
	$vypisysvybr -> vypiszastavky($servername,$username,$password,$dbname);
	?>	
	</select>
	<?php
	echo "</td></tr>";
	echo "<tr><th class='podrobnostitab'>Linka</th><td>";?>
	<select class='vstup' name='linka'>
	<?php
	
	$vypisysvybr -> vypislinky($servername,$username,$password,$dbname);
	?>	
	</select>
	<?php
	echo "</td></tr>";
	echo "<tr><th class='podrobnostitab'>Vozidlo</th><td>";?>
	<select class='vstup' name='vozidlo' id= 'vozidlo'>
	<?php
	
	$vypisysvybr -> vypisvozidlo($servername,$username,$password,$dbname,"I");
	?>	
	</select>
	<?php


?>


<button class="vstup" type="button" onclick="abcd();">Přidat vozidlo na seznam</button><br>
<select class='vstup' id="on_vehicle" name="vehicle_list[]" size="8" multiple>
  </select>
</td></tr></table>

<br><input class="vstup" name="add" type="submit" value="Přidat záznam" >
</form>
<!-- <button  onclick="eqq()" >s </button>-->
<?php
if(array_key_exists('add',$_POST)){
	
	/*foreach ($_POST['vehicle_list'] as $subject) {
		echo '<li>'.$subject.'</li>';
	}*/
	
	$pridat = new Spravazaznamprozaber();
	$pridat -> pridat($servername,$username,$password,$dbname);
	 
}
?>


</div>
</section>


</main>
 

<script>


function abcd() {
  var x = document.getElementById("on_vehicle");	
  var option = document.createElement("option");//vozidlo
  option.text = e.options[e.selectedIndex].text;
  option.value = e.value;
  x.add(option);
  
	
  
};


function showname () {
      var name = document.getElementById('fileToUpload'); 
      document.getElementById('file_ozncn').value = name.files.item(0).name;
    };
	
var x = document.getElementById("on_vehicle");	
	var e = document.getElementById("vozidlo");

function eqq(){
	var optionsToSelect = ['One', 'three'];
var select = document.getElementById( 'on_vehicle' );

for ( var i = 0, l = select.options.length, o; i < l; i++ )
{
  o = select.options[i];
  if ( optionsToSelect.indexOf( o.text ) != -1 )
  {
    o.selected = true;
  }
}
	
}

</script>



<!-- <div class="polozka">Stránku provozuje: <span id="zapati">SEM ZADEJTE TEXT</span><hr>Stránka běží na systému: EVIDENCE ZÁBĚRŮ O MHD S VYUŽITÍM RELAČNÍ DATABÁZE - MARTIN HAMACEK</div>-->
</div>




</body>
</html>