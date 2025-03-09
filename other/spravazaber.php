<?php
	class Spravazaznamprozaber{
	public function pridat(string $servername, string $username, string $password, string $dbname){	
		$ozcn=$_POST['ozcnzaz'];
		$dtmp=$_POST['datump'];
		$cntd=$_POST['cslntdn'];
		$pjoj=$_POST['prjodj'];
		$poradii=$_POST['poradi'];
		$frmt=$_POST['formats'];
		$lnk=$_POST['linka'];
		$zstv=$_POST['zastavka'];
		$prnvzd=$_POST['vozidlo'];
		$vhonclip = $_POST['vehicle_list'];
		$conn = new mysqli($servername, $username, $password, $dbname);
		try{
		$conn->begin_Transaction();
		$sql = "INSERT into clip(name_of_clip,created,number_of_filming_day,arrive_or_depart,order_on_the_line,stop_id,line_id,formats_id,file_url,lenght_of_clip,count_of_vehicles_on_clip) VALUES ('$ozcn', '$dtmp' , $cntd, $pjoj, $poradii, $zstv, $lnk, $frmt,'".$_POST['directory']."',5,1);";
		$conn->query($sql);
		
		foreach ($vhonclip as $subject) {
			$sql = "INSERT into vehicles_on_clip(vehicle_id,clip_id) VALUES (".$subject.", (SELECT id from clip where name_of_clip='".$ozcn."' and created='".$dtmp."'));";
			$conn->query($sql);
		}
		
		$conn->commit();
		
		$uploadOk = 0;
		
		$target_dir = "E:\\";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
		  }
				
		
		header("Location: /TP/list.php");
		
		}catch(Exception $e){
			$conn->rollback();
			echo $e;
			echo $_POST['directory'];
		}
		$conn->close();

		// Check if file already exists
		
	}
	
	public function upravit (string $servername, string $username, string $password, string $dbname){	
		$ozncnzaznam_puvod = $_POST['ozncnzaznam_puvod'];
		$dtmp_puvod =$_POST['datump_puvod'];
		$ozncnzaznam=$_POST['ozncnzaznam'];
		$dtmp=$_POST['datump'];
		$cntd=$_POST['cslntdn'];
		$pjoj=$_POST['prjodj'];
		$poradii=$_POST['poradi'];
		$frmt=$_POST['formats'];
		$lnk=$_POST['linka'];
		$zstv=$_POST['zastavka'];
		$prnvzd=$_POST['vozidlo'];
		$countv = $_POST['countvehicle'];
		
		$conn = new mysqli($servername, $username, $password, $dbname);
		$sql = "update clip set name_of_clip = '".$ozncnzaznam."',created='".$dtmp."',number_of_filming_day=".$cntd.",arrive_or_depart=".$pjoj.",order_on_the_line=".$poradii.",stop_id=".$zstv.",line_id=".$lnk.",formats_id=".$frmt." where id = ".$ozncnzaznam_puvod.";";
		
		$result = $conn->query($sql);
		$conn->close();
		header("Location: /TP/list.php");
	}
	
	public function smazat(string $servername, string $username, string $password, string $dbname){
		$ozncnzaznam_puvod = $_GET['id'];

		$conn = new mysqli($servername, $username, $password, $dbname);
		
		try{
		$conn->begin_Transaction();
		$sql = "delete from vehicles_on_clip where clip_id = '".$ozncnzaznam_puvod."';";
		$result = $conn->query($sql);
		$sql = "delete from clip where id = '".$ozncnzaznam_puvod."';";
		$result = $conn->query($sql);
		$conn->commit();
		$conn->close();
		header("Location: /TP/list.php");
		}catch(Exception $e){
			$conn->rollback();
		}
	}
	
	public function Pridat_vozidlo(string $servername, string $username, string $password, string $dbname){	
		
		$prnvzd=$_POST['vozidlo'];
		$id = $_GET['id'];
		
		$conn = new mysqli($servername, $username, $password, $dbname);
		
		$sql = "INSERT into vehicles_on_clip(vehicle_id,clip_id)values(".$prnvzd.",".$id.");";
		$conn->query($sql);
		
		
		
		$conn->close();

	}
	
	public function Smazat_vozidlo(string $servername, string $username, string $password, string $dbname){	
		
		$id = $_POST['delete_vehicle_on_list_i'];
		
		$conn = new mysqli($servername, $username, $password, $dbname);
		
		$sql = "DELETE FROM vehicles_on_clip where id=".$id;
		$conn->query($sql);
		
		
		
		$conn->close();

	}
	
	
	
}
?>