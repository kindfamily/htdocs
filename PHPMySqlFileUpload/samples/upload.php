<?php

require("../../config/config.php");
require("../../lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);





	if(isset($_POST["btnSubmit"])){		
		
		$editor = $_POST['editor'];

		$title = $_POST['title'];

		$titleimg = $_FILES['maintitle'];
		$titleImgTmpName = $_FILES['maintitle']['tmp_name'];
		$titleImgName = $_FILES['maintitle']['name'];

		$fileDestination = 'Upload/'.$titleImgName;
        move_uploaded_file($titleImgTmpName, $fileDestination);

		$sql = "INSERT INTO ck(title, content, title_img_name ) VALUES ('$title','$editor', '$titleImgName')";
		echo $sql;

		$result = mysqli_query($conn, $sql);

		
		$sql = "SELECT * FROM ck WHERE title_img_name ='$titleImgName'";
		$result = mysqli_query($conn,$sql);

		if($result === false){
			echo mysqli_error($conn);
		}

		$row = mysqli_fetch_assoc($result);

		$editorid = $row['id'];

		echo $editorid;

		while($row = mysqli_fetch_assoc($result)){
			echo '<p>'.$row['id'].'</p>';
		}
		



		if($result === false){
			echo mysqli_error($conn);
		}
		
		$errors = array();
		
		$extension = array("jpeg","jpg","png","gif");
		
		$bytes = 1024;
		$allowedKB = 10000;
		$totalBytes = $allowedKB * $bytes;
		

		if(isset($_FILES["files"])==false)
		{
			echo "<b>Please, Select the files to upload!!!</b>";
			return;
		}

		
		foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name)
		{
			$uploadThisFile = true;

			$file_name=$_FILES["files"]["name"][$key];
			$file_tmp=$_FILES["files"]["tmp_name"][$key];
			
			$ext=pathinfo($file_name,PATHINFO_EXTENSION);

			if(!in_array(strtolower($ext),$extension))
			{
				array_push($errors, "File type is invalid. Name:- ".$file_name);
				$uploadThisFile = false;
			}				
			
			if($_FILES["files"]["size"][$key] > $totalBytes){
				array_push($errors, "File size must be less than 10000KB. Name:- ".$file_name);
				$uploadThisFile = false;
			}
			
			if(file_exists("Upload/".$_FILES["files"]["name"][$key]))
			{
				array_push($errors, "File is already exist. Name:- ". $file_name);
				$uploadThisFile = false;
			}
			
			if($uploadThisFile){
				$filename=basename($file_name,$ext);
				$newFileName=$filename.$ext;				
				move_uploaded_file($_FILES["files"]["tmp_name"][$key],"Upload/".$newFileName);
				
				$query = "INSERT INTO userfiles(FilePath, FileName, editorid) VALUES('Upload','$newFileName', '$editorid')";
				echo $query;
				
				$result = mysqli_query($conn, $query);			
				if($result === false){
					echo mysqli_error($conn);
				}

			}
		}
		
		mysqli_close($conn);
		
		$count = count($errors);
		
		if($count != 0){
			foreach($errors as $error){
				echo $error."<br/>";
			}
		}		
	}
?>