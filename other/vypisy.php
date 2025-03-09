<?php
	class Vypisy{
	public function vypisvozidlosvyberem(string $servername, string $username, string $password, string $dbname,string $vstup){
		$porizeno = $_GET["porizeno"];
		$ozncnzaznam = $_GET["ozncnzaznam"];
		$idsvyberem = 0;
		$vyber = null;
		$conn = new mysqli($servername, $username, $password, $dbname);

		$sql = "select vozidlo.id as id, vozidlo.evidcislo as evc,kategorie.nazevkategorie as nzvktg,typvozidlo.nazevtypu as typ
				from vozidlo
				inner join kategorie on vozidlo.kategorie_id = kategorie.id
				inner join typvozidlo on vozidlo.typvozidlo_id = typvozidlo.id
				order by evc";
		
		$sqlII = "select vozidlo_id".$vstup." as vzdlidI from zaber where porizeno = '".$porizeno."' and ozncnzaznam='".$ozncnzaznam."' ;";
		
		$result = $conn->query($sql);
		$resultII = $conn->query($sqlII);
		
		if($resultII ->num_rows >0){
			while ($rowII = $resultII->fetch_assoc()){
				$idsvyberem = $rowII["vzdlidI"];
			}	
		}else{
			echo "";
		}
		
		if($result->num_rows >0){
			while ($row = $result->fetch_assoc()){
				if($row["id"] == $idsvyberem){
					echo "<option value=".$row["id"]." selected>".$row["evc"].", vozidlo: ".$row["nzvktg"].", typ: ".$row["typ"]."</option>";
				}else{
					echo "<option value=".$row["id"].">".$row["evc"].", vozidlo: ".$row["nzvktg"].", typ: ".$row["typ"]."</option>";
				}
				
			}	
		}
		$conn -> close();
		
	}
	
	public function vypisvozidlo(string $servername, string $username, string $password, string $dbname,string $vstup){
		$vyber = null;
		$conn = new mysqli($servername, $username, $password, $dbname);

		$sql = "select vehicle.id, vehicle.number_,subtype_mean_of_transport.name_ as subtype_mean_of_transport,mean_of_transport.name_ as mean_of_transport from vehicle\r\n    inner join mean_of_transport on vehicle.mean_of_transport_id = mean_of_transport.id\r\n    inner join subtype_mean_of_transport on vehicle.subtype_mean_of_transport_id = subtype_mean_of_transport.id order by number_";
		
		
		$result = $conn->query($sql);
		
		if($resultII ->num_rows >0){
			while ($rowII = $resultII->fetch_assoc()){
				$idsvyberem = $rowII["vzdlidI"];
			}	
		}else{
			echo "";
		}
		
		if($result->num_rows >0){
			while ($row = $result->fetch_assoc()){
					echo "<option value=".$row["id"].">".$row["number_"].", vozidlo: ".$row["mean_of_transport"].", typ: ".$row["subtype_mean_of_transport"]."</option>";
			}	
		}
		$conn -> close();
		
	}
	
	public function vypisformatysvyberem(string $servername, string $username, string $password, string $dbname){
		$porizeno = $_GET["id"];
		$idsvyberem = 0;
		$vyber = null;
		$conn = new mysqli($servername, $username, $password, $dbname);
		$sql = "select id, name_ from formats;";
		$sqlII = "select formats_id as formatid from clip where id = '".$porizeno."' ;";
		
		$result = $conn->query($sql);
		$resultII = $conn->query($sqlII);
		
		if($resultII ->num_rows >0){
			while ($rowII = $resultII->fetch_assoc()){
				$idsvyberem = $rowII["formatid"];
			}	
		}else{
			echo "";
		}

		if($result->num_rows >0){
			while ($row = $result->fetch_assoc()){
				if($row["id"] == $idsvyberem){
					echo "<option value=".$row["id"]." selected>".$row["name_"]."</option>";
					}else{
					echo "<option value=".$row["id"].">".$row["name_"]."</option>";
				}
				
			}	
		}else{
			echo "";
		}
		$conn -> close();
	}	
	
	public function vypisformaty(string $servername, string $username, string $password, string $dbname){
		$vyber = null;
		$conn = new mysqli($servername, $username, $password, $dbname);
		$sql = "select id, name_ from formats;";
		$sqlII = "select formats_id as formatid from clip;";
		
		$result = $conn->query($sql);
		$resultII = $conn->query($sqlII);
		
		if($resultII ->num_rows >0){
			while ($rowII = $resultII->fetch_assoc()){
				$idsvyberem = $rowII["formatid"];
			}	
		}else{
			echo "";
		}

		if($result->num_rows >0){
			while ($row = $result->fetch_assoc()){
					echo "<option value=".$row["id"].">".$row["name_"]."</option>";
				}	
				
		}else{
			echo "";
		}
		$conn -> close();
	}	
	
	public function vypislinkysvyberem(string $servername, string $username, string $password, string $dbname){
		$porizeno = $_GET["id"];
		$idsvyberem = 0;
		$vyber = null;
		$conn = new mysqli($servername, $username, $password, $dbname);
		$sql = "select id, number_line,name_line from line;";
		$sqlII = "select line_id as linkaid from clip where id = '".$porizeno."';";
		
		$result = $conn->query($sql);
		$resultII = $conn->query($sqlII);
		
		if($resultII ->num_rows >0){
			while ($rowII = $resultII->fetch_assoc()){
				$idsvyberem = $rowII["linkaid"];
			}	
		}else{
			echo "";
		}

		if($result->num_rows >0){
			while ($row = $result->fetch_assoc()){
				if($row["id"] == $idsvyberem){
					echo "<option value=".$row["id"]." selected>".$row["name_line"]."</option>";
					}else{
					echo "<option value=".$row["id"].">".$row["name_line"]."</option>";
				}
				
			}	
		}else{
			echo "";
		}
		$conn -> close();
	}	
	
	public function vypiszastavkysvyberem(string $servername, string $username, string $password, string $dbname){
		$porizeno = $_GET["id"];

		$idsvyberem = 0;
		$vyber = null;
		$conn = new mysqli($servername, $username, $password, $dbname);
		$sql = "select id, name_of_stop,platform,direction from stop_;";
		$sqlII = "select stop_id as zastid from clip where id = '".$porizeno."';";
		
		$result = $conn->query($sql);
		$resultII = $conn->query($sqlII);
		
		if($resultII ->num_rows >0){
			while ($rowII = $resultII->fetch_assoc()){
				$idsvyberem = $rowII["zastid"];
			}	
		}else{
			echo "";
		}
		
		$result = $conn->query($sql);
		
		if($result->num_rows >0){
			while ($row = $result->fetch_assoc()){
				if($row["id"] == $idsvyberem){
				echo "<option value=".$row["id"]." selected>".$row["name_of_stop"].", stanoviště: ".$row["platform"].", směr: ".$row["direction"]."</option>";
				}else{
				echo "<option value=".$row["id"].">".$row["name_of_stop"].", stanoviště: ".$row["platform"].", směr: ".$row["direction"]."</option>";
				}
			}	
		}
		$conn -> close();
	}
	
	public function vypiszastavky(string $servername, string $username, string $password, string $dbname){
		$vyber = null;
		$conn = new mysqli($servername, $username, $password, $dbname);
		$sql = "select id, name_of_stop,platform,direction from stop_ order by name_of_stop;";
		
		
		$result = $conn->query($sql);

		
		$result = $conn->query($sql);
		
		if($result->num_rows >0){
			while ($row = $result->fetch_assoc()){
				echo "<option value=".$row["id"].">".$row["name_of_stop"].", stanoviště: ".$row["platform"].", směr: ".$row["direction"]."</option>";
				
			}	
		}
		$conn -> close();
	}
	
	
	public function vypislinky(string $servername, string $username, string $password, string $dbname){

		$vyber = null;
		$conn = new mysqli($servername, $username, $password, $dbname);
		$sql = "select id, number_line,name_line from line;";
		
		$result = $conn->query($sql);
		
		if($result->num_rows >0){
			while ($row = $result->fetch_assoc()){
					echo "<option value=".$row["id"].">".$row["name_line"]."</option>";
			}
		}else{
			echo "";
		}
		$conn -> close();
	}
	}
	
	
?>