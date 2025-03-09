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
<script src="lib/urlparse.js"></script>
</head>


<body>

<div class="container">
<header>
<h1 id="demoI">SEM ZADEJTE NÁZEV</h1>
</header>

<script src="../../js/info.js"></script>

<nav>
	<button class="vstup" onclick="history.back()">ZPĚT</button>
	<a href="../edit_directories.php" class="vstup">SPRAVOVAT ADRESÁŘE</a>
	<a href="../user_manager/list.php" class="vstup">SPRAVOVAT UŽIVATELE</a>
</nav>
<main>
<section class="one_section">
<div class="vlevo">
<form method="post">
<?php
 
include("../other/connection.php");
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM author where login_name = '".$_SESSION["name"]."'";
$result = $conn->query($sql);
$dataI = "";
$dataII = "";

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

	
?>
<?php
	echo "<table class='podrobnostitab'>";
	echo "<tr><th class='podrobnostitab'>uživatelské jméno</th><td><input name='user_name' type='text' class='vstupIII' value='".$row["login_name"]."'></td></tr>";
	echo "<tr><th class='podrobnostitab'>heslo</th><td><input name='passwd' type='password' class='vstupIII' value='".$row["user_password"]."' disabled></td></tr>";
	echo "<tr><th class='podrobnostitab'>podrobnosti</th><td><input name='podrobnosti' type='text' class='vstupIII' value='".$row["message"]."'></td></tr>";
	echo "<tr><th class='podrobnostitab'>založeno</th><td><input name='zalozeno' type='date' class='vstupIII' value='".$row["date_created"]."' disabled></td></tr>";
	echo "<tr><th class='podrobnostitab'>počet přístupů</th><td><input name='pocetpristup' type='number' class='vstupIII' value=".$row["count_of_access"]." disabled></td></tr>";
	echo "<tr><th class='podrobnostitab'>email</th><td><input name='email' type='text' class='vstupIII' value=".$row["email"]." disabled></td></tr>";
	echo "</td></tr>";
echo "</table>";
  


	}
} else {
  echo "0 results";
}
	$conn->close();



?>
<input class="vstup" name="update" type="submit" value="Uložit">
<input class="vstup" name="delete" type="submit" value="Smazat">
</form><br>
<?php
if(array_key_exists('update',$_POST)){

	$conn = new mysqli($servername, $username, $password, $dbname);
		$sql = "update author set message = '".$_POST['podrobnosti']."' where login_name='".$_SESSION["name"]."';";
		
		$result = $conn->query($sql);
		$conn->close();
		echo "Uloženo";
}

if(array_key_exists('delete',$_POST)&&$_SESSION["isadmin"]=1){

	$conn = new mysqli($servername, $username, $password, $dbname);
		$sql = "delete from author where login_name = '".$_POST['user_name']."';";
		
		$result = $conn->query($sql);
		$conn->close();
		rmdir("../".$_POST["user_name"]);
		echo "Uloženo";
}

?>


</div>
</section>
<!-- <div class="polozka">Stránku provozuje: <span id="zapati">SEM ZADEJTE TEXT</span><hr>Stránka běží na systému: EVIDENCE ZÁBĚRŮ O MHD S VYUŽITÍM RELAČNÍ DATABÁZE - MARTIN HAMACEK</div>-->
</main>
</div>



</body>
</html>