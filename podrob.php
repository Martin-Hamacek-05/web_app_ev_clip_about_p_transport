<?php
session_start();
if($_SESSION["evd_zaber_hamacek"]!= true){
	header('Location: /TP-2-0/view/index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<title id="demo">SEM ZADEJTE NÁZEV</title>
<link rel="stylesheet" href="../styles/stylopis.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- <script src="lib/urlparse.js"></script>-->
</head>


<body>

<div class="container">
<header>
<h1 id="demoI">SEM ZADEJTE NÁZEV</h1>
</header>

<!-- <script src="../js/info.js"></script>-->

<nav>
<form action="list.php">
	<button class="vstup">ZPĚT
	</button>
	</form>
</nav>
<main>
<section>
<div class="vlevo">
<form method="post">
<?php
include("../model/spravazaber.php");
include("../model/connection.php");

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM clip where id = '".$_GET['id']."'";
$result = $conn->query($sql);
$dataI = "";
$dataII = "";

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

	

	echo "<table class='podrobnostitab'>";
	echo "<tr><th class='podrobnostitab'>Název</th><td><input name='ozncnzaznam' type='text' class='vstupIII' value='".$row["name_of_clip"]."'></td></tr>";
	echo "<tr><th class='podrobnostitab'>Pořízeno</th><td><input name='datump' type='date' class='vstupIII' value='".$row["created"]."'></td></tr>";
	echo "<tr><th class='podrobnostitab'>Číslo natáčecího dne</th><td><input name='cslntdn' type='number' class='vstupIII' value=".$row["number_of_filming_day"]."></td></tr>";
	echo "<tr><th class='podrobnostitab'>Pořadí</th><td><input name='poradi' type='number' class='vstupIII' value=".$row["order_on_the_line"]."></td></tr>";
	echo "<tr><th class='podrobnostitab'>Přijezd 0/odjezd 1</th><td><input name='prjodj' type='number' class='vstupIII' value=".$row["arrive_or_depart"]."></td></tr>";
	echo "<tr><th class='podrobnostitab'>Formát záznamu</th><td>";?>
	<select class='vstup' name='formats'>
<?php
include("../model/vypisy.php");
$vypisysvybr = new Vypisy();
$vypisysvybr -> vypisformatysvyberem($servername,$username,$password,$dbname);
?>	
</select>
	<?php
	echo"</td></tr>";
	
	
	echo "<tr><th class='podrobnostitab'>Název zastávky</th><td>";
	?>
	<select class='vstup' name='zastavka'>
	<?php
	
	$vypisysvybr -> vypiszastavkysvyberem($servername,$username,$password,$dbname);
	?>	
	</select>
	<?php
	echo "</td></tr>";
	echo "<tr><th class='podrobnostitab'>Linka</th><td>";?>
	<select class='vstup' name='linka'>
	<?php
	
	$vypisysvybr -> vypislinkysvyberem($servername,$username,$password,$dbname);
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
	<input class="vstup" name="add_vehicle_on_list" type="submit" value="Přidat vozidlo na seznam"/>
	
  







<span id="txtHint"></span>
<input class="vstupIII" name="delete_vehicle_on_list_i" type="text"/><input class="vstup" name="delete_vehicle_on_list" type="submit" value="Smazat vozidlo ze seznam"/>
</td></tr>
</table>
<input class="vstup" name="update" type="submit" value="Upravit záznam">
<input class="vstup" name="delete" type="submit" value="Smazat záznam">
</form><br>
<?php
if(array_key_exists('update',$_POST)){
	$pridat = new Spravazaznamprozaber();
	$pridat -> upravit($servername,$username,$password,$dbname);
}

if(array_key_exists('delete',$_POST)){
	$pridat = new Spravazaznamprozaber();
	$pridat -> Smazat($servername,$username,$password,$dbname);
}

if(array_key_exists('add_vehicle_on_list',$_POST)){
	$pridat = new Spravazaznamprozaber();
	$pridat -> Pridat_vozidlo($servername,$username,$password,$dbname);
}

if(array_key_exists('delete_vehicle_on_list',$_POST)){
	$pridat = new Spravazaznamprozaber();
	$pridat -> Smazat_vozidlo($servername,$username,$password,$dbname);
}


?>


</div>
</section>
<section class="two_section_part_I">
<?php
	echo "<input type='text' id='id_'/ value='".$row["id"]."' hidden>";
    echo "<h1>Záběr: ".$row["name_of_clip"]."</h1>";
	echo "<video style='width:100%;' controls>";
	echo "<source src='".$row['file_url']."/".$dataI.".mp4' type='video/mp4'>";
	echo "Your browser does not support the video tag.";
	echo "</video>";
	}
} else {
  echo "0 results";
}
	$conn->close();
?>

</section>
<!-- <div class="polozka">Stránku provozuje: <span id="zapati">SEM ZADEJTE TEXT</span><hr>Stránka běží na systému: EVIDENCE ZÁBĚRŮ O MHD S VYUŽITÍM RELAČNÍ DATABÁZE - MARTIN HAMACEK</div>-->
</main>
</div>

<script>

/*var x = document.getElementById("podrobnost");
		x.style.display = "none";*/
	setInterval(funkce, 1000);
	function funkce(){
		
		
		try {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
	xmlhttp.open("GET", '../model/podrob_vehicle_on_clip.php?id='+document.getElementById('id_').value);
    xmlhttp.send();
		}catch(err) {
			console.log(err.message);
	  document.getElementById("txtHint").innerHTML = err.message;
	}
	}

	
	function podrob_zavr(){
		var x = document.getElementById("prvek");
		if(x.style.display === "flex"){
		x.style.display = "none";
		}else{
		x.style.display = "flex";
		}
		
	}
	
	
	window.onload = funkce(0);
</script>


</body>
</html>