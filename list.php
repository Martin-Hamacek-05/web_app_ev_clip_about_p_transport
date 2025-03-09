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
<link rel="stylesheet" href="styles/stylopis_for_printer.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div class="container">
<header>
<h1 id="demoI">SEM ZADEJTE NÁZEV</h1>
</header>

<nav>

<label for="fname" class="hidden-print">Zobrazit za rok</label>
	
<select class="vstup hidden-print" id="rok" name="roky">

	<?php 
	include("../model/vypisroku.php");
	?>
	</select>
	<button class="vstup phoneonly hidden-print" onclick="podrob_zavr()">=
	</button>
	
	<div id="prvek" class="nezobrazitm hidden-print">
	<form action="new_record.php">
	<button class="vstup phoneonly">PŘIDAT ZÁZNAM
	</button>
	</form>
	<!-- <form action="filtr.php">
	<button class="vstup nezobrazitm phoneonly">FILTR
	</button>
	</form> -->
	<form action="statistika.php">
	<button class="vstup nezobrazitm phoneonly hidden-print">STATISTIKA
	</button>
	</form>
	<form action="user_manager/edituser.php">
	<button class="vstup phoneonly hidden-print"><?php echo $_SESSION["name"] ?></button>
	</form>
	
	<form action="personalizace/personalizace.php">
	<button class="vstup phoneonly hidden-print">Přispůsobení</button>
	</form>
	
	<form method="post">
	<input type="submit" class="vstup phoneonly hidden-print" name="odhlaseni" value="odhlasit">
	</form>
	
	</div>
	
	<form action="new_record.php">
	<button class="vstup nezobrazitm hidden-print">PŘIDAT ZÁZNAM
	</button>
	</form>
	<!--<form action="filtr.php">
	<button class="vstup nezobrazitm">FILTR
	</button>
	</form>-->
	<form action="statistika.php">
	<button class="vstup nezobrazitm hidden-print">STATISTIKA
	</button>
	</form>
	<form action="user_manager/edituser.php">
	<button class="vstup onright nezobrazitm hidden-print"><?php echo $_SESSION["name"] ?></button>
	</form>
	
	<form action="personalizace/personalizace.php">
	<button class="vstup onright nezobrazitm hidden-print">Přispůsobení</button>
	</form>
	
	<form method="post">
	<input type="submit" class="vstup onright nezobrazitm hidden-print" name="odhlaseni" value="odhlasit">
	</form>
	
</nav>

<main>

<section class="one_section">
<span id="txtHint"></span>
</section>

<?php

if(array_key_exists('odhlaseni',$_POST)){
	$_SESSION["evd_zaber_hamacek"]= false;
	session_unset();
	session_destroy();
	header('Location: /TP-2-0/web_app_ev_clip_about_p_transport/index.php');
}
?>

</main>

</div>
<script src="../js/info.js"></script>
<script>
	/*var x = document.getElementById("podrobnost");
		x.style.display = "none";*/
	setInterval(funkce, 1000);
	function funkce(){
		
		var e = document.getElementById("rok");
		var text = e.options[e.selectedIndex].text;
		try {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
	xmlhttp.open("GET", 'other/zabery.php?podminka='+text);
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