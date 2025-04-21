<?php
session_start();
if($_SESSION["evd_zaber_hamacek"]!= true){
		echo "<script>window.location.replace('http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'))."/index.php');</script>";
}
?>
<?php
include("connection.php");

echo '<table id="tabulka" class="vypisdat">';
echo '<tr><th class="vypisdat">specifické číslo</th><th class="vypisdat">evidenční číslo</th><th class="vypisdat" >podtyp</th><th class="vypisdat">dopravce</th></tr>';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

	 $stmt = $conn->prepare('select vehicles_on_clip.id,vehicle.number_, subtype_mean_of_transport.name_ as subtype,clip.name_of_clip,owner_.name_ as owner_ from vehicles_on_clip    inner join vehicle on vehicles_on_clip.vehicle_id = vehicle.id   inner join subtype_mean_of_transport on vehicle.subtype_mean_of_transport_id = subtype_mean_of_transport.id    inner join clip on vehicles_on_clip.clip_id = clip.id    inner join owner_ on vehicle.owner_id = owner_.id where clip.id = ?');
	 $stmt->bind_param('s', $_GET["id"]);
	 $stmt->execute();
	 $result = $stmt->get_result();


if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr class='vypisdat'><td class='vypisdat'>".$row["id"]."</td><td>".$row["number_"]."</td><td class='vypisdat nezalomit'>".$row["subtype"]."</td><td class='vypisdat nezobrazitm'>".$row["owner_"]."</td></tr>";
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
