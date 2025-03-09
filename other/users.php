<?php
session_start();
if($_SESSION["evd_zaber_hamacek"]!= true){
	header('Location: /TP-2-0/view/index.php');
}
?>
<?php
include("connection.php");
if($_SESSION["isadmin"]==1){
echo '<table id="tabulka" class="vypisdat">';
echo '<tr><th class="vypisdat nezalomit" style="width:5%">uživatelské jmeno</th><th style="width:5%" class="vypisdat nezalomit" >role</th><th class="nezobrazitm vypisdat nezalomit">zpráva</th><th class="nezobrazitm vypisdat">email</th><th class="nezobrazitm vypisdat">datum vytvořeni</th><th class="vypisdat nezobrazitm">počet přístupu</th></tr>';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

	 $stmt = $conn->prepare('select login_name,is_admin,message,email,date_created,count_of_access from author');
	 //$stmt->bind_param('s', $_GET["podminka"]);
	 $stmt->execute();
	 $result = $stmt->get_result();


if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr class='vypisdat'><td><a href='../user_manager/edituserII.php?login_name=".$row["login_name"]."'>".$row["login_name"]."</a></td><td class='vypisdat nezalomit'>".$row["is_admin"]."</td><td class='vypisdat nezobrazitm'>".$row["message"]."</td><td class='vypisdat nezobrazitm'>".$row["email"]."</td><td class='vypisdat nezobrazitm'>".$row["date_created"]."</td><td class='vypisdat nezobrazitm'>".$row["count_of_access"]."</td>";	
	echo "</tr>";
  }
} else {
  echo "<tr></tr>";
}
echo "</table>";
}else{
	echo "neoprávněný přístup";
}
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
