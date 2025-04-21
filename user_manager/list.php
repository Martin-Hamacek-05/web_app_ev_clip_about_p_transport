<?php
session_start();
if($_SESSION["evd_zaber_hamacek"]!= true){
		echo "<script>window.location.replace('http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'))."/index.php');</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
<title id="demo">SPRÁVA UŽIVATELE</title>
<link rel="stylesheet" href="../styles/stylopis.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div class="container">
<header>
<h1 id="demoI">SPRÁVA UŽIVATELE</h1>
</header>

<nav>

	
	<button class="vstup phoneonly" onclick="podrob_zavr()">=
	</button>
	<button class="vstup" onclick="history.back()">ZPĚT</button>
	<div id="prvek" class="nezobrazitm">
	<?php if($_SESSION["isadmin"]==1){
	echo '<form action="newuser.php">
	<button class="vstup phoneonly">PŘIDAT UŽIVATELE
	</button>
	</form>
	</div>
	
	<form action="newuser.php">
	<button class="vstup nezobrazitm">PŘIDAT UŽIVATELE
	</button>
	</form>';}else{
		
	}?>
	
</nav>

<main>

<section class="one_section">
<span id="txtHint"></span>
</section>



</main>

</div>
<script src="../js/info.js"></script>
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
	xmlhttp.open("GET", '../other/users.php');
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