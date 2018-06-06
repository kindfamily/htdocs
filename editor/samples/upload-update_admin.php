<?php
// php ini 파일의 설정을 에러코드를 보도록 하게 하는 코드
ini_set("display_errors","1");

require("../../config/session.php");
require("../../config/config.php");
require("../../lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
	
// update.php 에서 넘어온값
$id = $_POST['editorid'];
$editor = $_POST['editor'];
$title = $_POST['title'];

	if(isset($_POST["btnSubmit"])){		
		if(isset($_FILES['maintitle'])){
			var_dump($_FILES['maintitle']);
			$titleimg = $_FILES['maintitle'];
			$titleImgTmpName = $_FILES['maintitle']['tmp_name'];
			$titleImgName = $_FILES['maintitle']['name'];	
			$fileDestination = 'Upload/'.$titleImgName;
			move_uploaded_file($titleImgTmpName, $fileDestination);
		} else {
			$sql = "SELECT title_img_name FROM ck WHERE ck.id='$id'";
			print_r($sql);
			exit;
			$titleImgName = mysqli_query($conn, $sql);
			echo '넘어온 파일 없음';
			print_r($titleImgName);
			exit;
		}

		$sql = "UPDATE ck SET title='$title', content='$editor', title_img_name='$titleImgName' WHERE id='$id';";
		$result = mysqli_query($conn, $sql);

		if($result === false){
			echo mysqli_error($conn);
		}

		
		
		$errors = array();
		
		$extension = array("jpeg","jpg","png","gif");
		
		$bytes = 1024;
		$allowedKB = 100000;
		$totalBytes = $allowedKB * $bytes;
		

		// if(isset($_FILES["files"])==false)
		// {
		// 	echo "<b>Please, Select the files to upload!!!</b>";
		// 	return;
		// }

		
		// foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name)
		// {
		// 	$uploadThisFile = true;

		// 	$file_name=$_FILES["files"]["name"][$key];
		// 	$file_tmp=$_FILES["files"]["tmp_name"][$key];
			
		// 	$ext=pathinfo($file_name,PATHINFO_EXTENSION);

			// if(!in_array(strtolower($ext),$extension))
			// {
			// 	array_push($errors, "File type is invalid. Name:- ".$file_name);
			// 	$uploadThisFile = false;
			// }				
			
			// if($_FILES["files"]["size"][$key] > $totalBytes){
			// 	array_push($errors, "File size must be less than 10000KB. Name:- ".$file_name);
			// 	$uploadThisFile = false;
			// }
			
			// if(file_exists("Upload/".$_FILES["files"]["name"][$key]))
			// {
			// 	array_push($errors, "File is already exist. Name:- ". $file_name);
			// 	$uploadThisFile = false;
			// }
			
		// 	if($uploadThisFile){
				
		// 		if(isset($_FILES['files'])){
		// 			$filename=basename($file_name,$ext);
		// 			$newFileName=$filename.$ext;				
		// 			move_uploaded_file($_FILES["files"]["tmp_name"][$key],"Upload/".$newFileName);
		// 		}else {
		// 			$sql = "SELECT * FROM ck LEFT JOIN userfiles ON ck.id = userfiles.editorid WHERE ck.id='{$id}'";
		// 			$newFileName = $row['FileName'];	
		// 		}

				
		// 		// $sql = "UPDATE userfiles SET FilePath='Upload', FileName='$newFileName', editorid='$editorid' WHERE id='$id';";
		// 		$sql = "UPDATE userfiles SET FilePath='Upload', FileName='$newFileName', editorid='$editorid'";

		// 		// $sql = "INSERT INTO userfiles(FilePath, FileName, editorid) VALUES('Upload','$newFileName', '$editorid')";
				
		// 		$result = mysqli_query($conn, $sql);			
		// 		if($result === false){
		// 			echo mysqli_error($conn);
		// 			die($result);
		// 		}
		// 	}
		// }
		
		mysqli_close($conn);
		
		$count = count($errors);
		
		if($count != 0){
			foreach($errors as $error){
				echo $error."<br/>";
			}
		}		
	}
?>
<meta http-equiv='refresh' content='0;url=../../php/mypage.php'>
