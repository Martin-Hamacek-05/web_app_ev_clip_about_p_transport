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
<link rel="stylesheet" href="styles/stylopis_for_printer.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- <script src="lib/urlparse.js"></script>-->
</head>


<body>

<div class="container">
<header>
<h1 id="demoI">SEM ZADEJTE NÁZEV</h1>
</header>

<script src="js/info.js"></script>
<!-- <script src="lib/sorttable.js"></script>-->
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

<nav>
<form action="statistika.php" method="GET">
	<button class="vstup hidden-print">ZPĚT
	</button>
</nav>
<main>
<section class="vyrez ">
<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include("other/connection.php");

?>
<div class="polozka" id="procedury"> 

<script>
function odkaz(rok){
var a = document.getElementById('procedury').getElementsByTagName('a'),
length = a.length;

for(var i=0; i< length; i++){
	var neww = String(a[i]);
	
    a[i].href = neww.replace(/---vyberte---/g, rok)
}
}
</script>

<?php include("other/load_statistic.php"); ?>

<table class='vypisdat_II' style="width:100%"id="data">
<?php 
$statisticII = new statistic;
echo $statisticII->headers($_GET["procedura"]);?>
<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//connect to database

// Create connection
	$connection = new mysqli($servername, $username, $password, $dbname);
	$query = "CALL ".$_GET["procedura"]." (?)";
    $stmt = $connection->prepare($query);
	$rok= $_GET["parametr"];//"---vyberte---";
    $stmt->bind_param('s', $rok);
    $stmt->execute();
	$result = $stmt->get_result();
	
		$statistic = new statistic();
	

	while ($row = mysqli_fetch_array($result)){   
		

		switch($_GET["procedura"]){
			case $statistic->procedure_convertor()[0]:
				echo "<tr class='vypisdat_II'><td class='vypisdat_II' >".$row[0] ."</td><td class='vypisdat_II'>". $row[1]."</td></tr>"; 
			break;

			case $statistic->procedure_convertor()[1]:
				echo "<tr class='vypisdat_II'><td class='vypisdat_II'>".$row[0] ."</td><td class='vypisdat_II'>". $row[1]."</td></tr>"; 
			break;

			case $statistic->procedure_convertor()[2]:
				echo "<tr class='vypisdat_II'><td class='vypisdat_II'>".$row[0] ."</td><td class='vypisdat_II'>". $row[1]."</td></tr>"; 
			break;
			
			case $statistic->procedure_convertor()[3]:
				echo "<tr class='vypisdat_II'><td class='vypisdat_II'>".$row[0] ."</td><td class='vypisdat_II'>". $row[1]."</td></tr>"; 
			break;

			case $statistic->procedure_convertor()[4]:
				echo "<tr class='vypisdat_II'><td class='vypisdat_II'>".$row[0] ."</td><td class='vypisdat_II'>". $row[1]."</td></tr>"; 
			break;

			case $statistic->procedure_convertor()[5]:
				echo "<tr class='vypisdat_II'><td class='vypisdat_II'>".$row[0] ."</td><td class='vypisdat_II'>". $row[1]."</td><td class='vypisdat_II'>". $row[2]."</td></tr>"; 
			break;
			
			case $statistic->procedure_convertor()[6]:
				echo "<tr class='vypisdat_II'><td class='vypisdat_II'>".$row[0] ."</td><td class='vypisdat_II'>". $row[1]."</td><td class='vypisdat_II'>". $row[2]."</td></tr>"; 
			break;

			case $statistic->procedure_convertor()[7]:
				echo "<tr class='vypisdat_II'><td class='vypisdat_II'>".$row[0] ."</td><td class='vypisdat_II'>". $row[1]."</td><td class='vypisdat_II'>". $row[2]."</td><td class='vypisdat_II'>". $row[3]."</td></tr>"; 
			break;


			default:
				echo "neplatná statistika<br>";

		}
	   
	}

?>
</table>

</section>
<section class="two_section_part_I">

</span>



<div id="myPlot" style="max-width:99%"class="upevnit posubobjpos"></div></div>

<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
//connect to database


// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);
	$query = "CALL ".$_GET["procedura"]." (?)";
    $stmt = $connection->prepare($query);
	$rok= $_GET["parametr"];//"---vyberte---";
    $stmt->bind_param('s', $rok);
    $stmt->execute();
	$result = $stmt->get_result();

	$popisek = array();
	$hodnoty = array();
	while ($row = mysqli_fetch_array($result)){   
		$popisek[] = $row[0];
		$hodnoty[] = $row[1];
	}

?>

<script>
<?php
echo 'const xArray = [';

for($x = 0; $x < count($popisek);$x++) {
  if($x != count($popisek) - 1){
		echo '"('.$popisek[$x].')", ';
	}else{
		echo '"('.$popisek[$x].')"';
	}
}

echo '];';


echo 'const yArray = [';
for($y = 0; $y < count($hodnoty);$y++) {
  if($y != count($hodnoty) - 1){
		echo '"'.$hodnoty[$y].'", ';
	}else{
		echo '"'.$hodnoty[$y].'"';
	}
}
echo '];';
?>
const data = [{
  x:xArray,
  y:yArray,
  type: "<?php echo $_GET["graph"];?>",
 
  orientation:"v",/*mode:"markers",*/
  marker: {color:"rgba(0, 53, 102,0.8)",size: 10}
  
}];

const layout = {
	<?php
	if($_GET["parametr"]=="---vyberte---"){
			echo 'title:"'.$_GET["procedura"].'"';
	}else{
		echo 'title:"'.$_GET["procedura"].' za rok'.$_GET["parametr"].'"';
	}
	
	?>
	,paper_bgcolor: "rgba(0,0,0,0)",plot_bgcolor: "rgba(0,0,0,0)",font: {
    family: 'Segoe UI',
    size: 11,
    color: '#FFFFFF'
  },autosize: true, height: 800,margin: {
    l: 50,
    r: 50,
    b: 200,
    t: 100,
    pad: 20
  },yaxis: {fixedrange: true,"gridcolor": "rgba(255,255,255,0.25)"},
        xaxis : {fixedrange: true,"gridcolor": "rgba(255,255,255,0.25)"}};
		var config = {responsive: true}

Plotly.newPlot("myPlot", data, layout,config);

</script>

</section>
<!-- <div class="polozka">Stránku provozuje: <span id="zapati">SEM ZADEJTE TEXT</span><hr>Stránka běží na systému: EVIDENCE ZÁBĚRŮ O MHD S VYUŽITÍM RELAČNÍ DATABÁZE - MARTIN HAMACEK</div>-->
</main>
</div>



</body>
</html>