<?php
session_start();
if($_SESSION["evd_zaber_hamacek"]!= true){
		echo "<script>window.location.replace('http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'))."/index.php');</script>";
}
?>
<?php
include("connection.php");

echo '<table id="tabulka" class="vypisdat">';
echo '<tr><th class="vypisdat nezalomit" style="width:5%">záznam</th><th style="width:5%" class="vypisdat nezalomit" >pořízeno</th><th class="nezobrazitm vypisdat nezalomit">číslo nat. dne</th><th class="nezobrazitm vypisdat">název zastávky</th><th class="nezobrazitm vypisdat">směr</th><th class="vypisdat nezobrazitm">linka</th><th class="vypisdat zalomit" style="width:20%">vozidlo</th><th class="nezobrazitm vypisdat nezalomit">formát</th></tr>';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

	 $stmt = $conn->prepare('select * from info_from_clip_match_vehicles_ii where YEAR(created) = ?');
	 $stmt->bind_param('s', $_GET["podminka"]);
	 $stmt->execute();
	 $result = $stmt->get_result();


if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr class='vypisdat'><td><a href='podrob.php?id=".$row["id"]."'>".$row["name_of_clip"]."</a></td><td class='vypisdat nezalomit'>".$row["created"]."</td><td class='vypisdat nezobrazitm'>".$row["number_of_filming_day"]."</td><td class='vypisdat nezobrazitm'>".$row["name_of_stop"]."</td><td class='vypisdat nezobrazitm'>".$row["direction"]."</td><td class='vypisdat nezobrazitm' >".$row["name_line"]."</td>";	
	echo "<td class='vypisdat zalomit' style='width:20%'>".$row["number_of_vehicle"]."</td>";
	echo "<td class='vypisdat nezobrazitm nezalomit'>".$row["format_"]."</td></tr>";
  }
} else {
  echo "<tr></tr>";
}
echo "</table>"
/*
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td><a href='podrobnosti.php?id=".$row["id"]."'>".$row["ozncnzaznam"]."</a></td><td>".$row["porizeno"]."</td><td>".$row["cislonatdne"]."</td><td>".$row["nazevzastavky"]."</td><td>".$row["smer"]."</td><td>".$row["nazevlinky"]."</td><td>".$row["dopravpros"]." - ".$row["typ"]." (".$row["predni"].")</td><td>".$row["countvehicle"]."</td>";
	echo "</td><td>".$row["formatnazev"]."</td></tr>";
  }
} else {
  echo "0 results";
}*/
?>
