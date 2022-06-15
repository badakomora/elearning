<?php
session_start();
    include "conn.php";	
		$file = $_FILES['file'];

		
		

		$fileName = $_FILES['file']['name'];
		$fileTmpName = $_FILES['file']['tmp_name'];
		$fileSize = $_FILES['file']['size'];
		$fileError = $_FILES['file']['error'];
		$fileType = $_FILES['file']['type'];

		$files = "";
		$pos = 0;
		foreach ($_FILES['file']['name'] as $value) {
			
			$fileName = $_FILES['file']['name'][$pos];
			$fileTmpName = $_FILES['file']['tmp_name'][$pos];
			$fileSize = $_FILES['file']['size'][$pos];
			$fileError = $_FILES['file']['error'][$pos];
			$fileType = $_FILES['file']['type'][$pos];

			$fileExt = explode('.', $_FILES['file']['name'][$pos]);
			$fileActualExt = strtolower(end($fileExt));

			$allowde = array('jpg','jpeg','png','pdf','txt');

			if (in_array($fileActualExt, $allowde)) {
				if ($fileError === 0) {
					if($fileSize < 6000000){
						$fileNameNew = uniqid('', true).".".$fileActualExt;
						$fileDestination = "slides/".$fileNameNew;
						move_uploaded_file($fileTmpName, $fileDestination);

						if($pos == 0){
							$files = $fileDestination;
						}else{
							$files .= ",".$fileDestination;
						}
					}else{
					}
				}else{
				}
			}else{
			}

			$pos++;
		}

		$insert_sql = "INSERT INTO boxes(box) VALUES('".$files."')";
		mysqli_query($con, $insert_sql) or die("database error: ". mysqli_error($con));
    
?>



