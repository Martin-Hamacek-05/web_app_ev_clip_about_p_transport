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
<link rel="stylesheet" href="../../styles/stylopis.css">
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
</nav>
<main>
<section class="one_section">
<div class="vlevo">
<form method="post">
<?php

include("../../model/connection.php");
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
	echo "<tr><th class='podrobnostitab'>uživatelské jméno</th><td><input name='user_name' type='text' class='vstupIII'></td></tr>";
	echo "<tr><th class='podrobnostitab'>je admin</th><td><input name='is_admin' type='number' class='vstupIII'></td></tr>";
	echo "<tr><th class='podrobnostitab'>založeno</th><td><input name='zalozeno' type='date' class='vstupIII'></td></tr>";
	echo "<tr><th class='podrobnostitab'>email</th><td><input name='email' type='text' class='vstupIII'></td></tr>";
	echo "</td></tr>";
echo "</table>";
  


	}
} else {
  echo "0 results";
}
	$conn->close();



?>
<input class="vstup" name="update" type="submit" value="Vytvořit">
</form><br>
<?php
if(array_key_exists('update',$_POST)){

	$conn = new mysqli($servername, $username, $password, $dbname);
		$sql = "insert into author(login_name,is_admin,message,email,date_created,count_of_access,user_password) values ('".$_POST["user_name"]."',".$_POST["is_admin"].",'e','".$_POST["email"]."','".$_POST["zalozeno"]."',0,'default');";
		
		$result = $conn->query($sql);
		$conn->close();
		mkdir("../".$_POST["user_name"]);
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