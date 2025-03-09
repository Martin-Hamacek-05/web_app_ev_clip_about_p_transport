<?php
session_start();
if($_SESSION["evd_zaber_hamacek"]!= true){
	header('Location: /TP-2-0/web_app_ev_clip_about_p_transport/index.php');
}
?>
<?php 
	include("connection.php");

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "SELECT DISTINCT YEAR(created) as date_ FROM clip order by date_ desc";
	
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
		  echo '<option value="'.$row["date_"].'">'.$row["date_"].'</option>';
	  }
	}
?>