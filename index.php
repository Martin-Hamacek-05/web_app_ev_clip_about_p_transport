
<!DOCTYPE html>
<html>
<head>
<title id="demo">SEM ZADEJTE NÁZEV</title>
<link rel="icon" type="image/x-icon" href="styles/favicon.ico">
<link rel="stylesheet" href="styles/stylopis-old.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>

</script>
</head>
<body>
<span id="demoI" hidden></span>
<div class="nastred polozka">
<div><div class="obrazek"><img  src="test_banner.png"/></div>
<h1>zadejte přihlašovací údaje</h1>

<form method="post">
jméno<br>
<input type="text" class="vstupIII" name="name"><br>heslo<br>
<input type="password" class="vstupIII" name="password"><br><br>
<input class="button" type="submit" value="Přihlásit se" name="login">
</form>
<p class="popisek">Stránka běží na systému: EVIDENCE ZÁBĚRŮ O MHD S VYUŽITÍM RELAČNÍ DATABÁZE - MARTIN HAMACEK	 <br>spravuje: <span id="zapati"></span></p></div>
</div>
<?php
if(array_key_exists('login',$_POST)){
	session_start();
	
	include("other/connection.php");
	$conn = new mysqli($servername, $username, $password, $dbname);
	$sql = "select * from author where login_name='".$_POST['name']."'and user_password='".$_POST['password']."';";
		$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$_SESSION["name"] = $row['login_name'];
					$_SESSION["isadmin"] = $row['is_admin'];
					$_SESSION["evd_zaber_hamacek"] = true;
						echo "<script>window.location.replace('http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'))."/list.php');</script>";
				} 
				
			} else {
					echo "<script>window.location.replace('http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'))."/index.php');</script>";
			}
		$conn->close();
	
		echo "<script>window.location.replace('http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'))."/list.php');</script>";
}
?>
<script src="../js/info.js"></script>
</body>
</html>