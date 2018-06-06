<?php
require("../../config/session.php");
require("../../config/config.php");
require("../../lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
	if(isset($_POST["btnSubmit"])){		
		$item_num = "0";
		$item_num = $item_num.$_POST['item_num'];

		$editor = $_POST['editor'];
		$title = $_POST['title'];

		$titleimg = $_FILES['maintitle'];
		$titleImgTmpName = $_FILES['maintitle']['tmp_name'];
		$titleImgName = $_FILES['maintitle']['name'];

		$fileDestination = 'Upload/'.$titleImgName;
        move_uploaded_file($titleImgTmpName, $fileDestination);

		$sql = "INSERT INTO ck(title, content, title_img_name, itemNum ) VALUES ('$title','$editor', '$titleImgName', '$item_num')";

		$result = mysqli_query($conn, $sql);

		// 에러 확인 1
		if($result === false){
			echo mysqli_error($conn);
			exit;
		}
	
		// 방금 업로드한 title 이미지 이름을 가지고 id 값을 $editorid 변수에 저장
		$sql = "SELECT * FROM ck WHERE title_img_name ='$titleImgName'";
		$result = mysqli_query($conn,$sql);

		// 에러 확인 2		
		if($result === false){
			echo mysqli_error($conn);
			exit;
		}

		$row = mysqli_fetch_assoc($result);
		$editorid = $row['id'];

		$errors = array();
		
		// $extension = array("jpeg","jpg","png","gif");
		
		// $bytes = 1024;
		// $allowedKB = 10000;
		// $totalBytes = $allowedKB * $bytes;
		

		// if(isset($_FILES["files"])==false)
		// {
		// 	echo "<b>Please, Select the files to upload!!!</b>";
		// 	return;
		// }
	
		
		
		// 다중파일 업로드 
		// foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name)
		// {
		// 	$uploadThisFile = true;
			
		// 	$file_name = $_FILES["files"]["name"][$key];
		// 	$file_tmp = $_FILES["files"]["tmp_name"][$key];
			
		// 	$ext = pathinfo($file_name,PATHINFO_EXTENSION);
			
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
			// 		$filename = basename($file_name,$ext);
			// 		$newFileName = $filename.$ext;				
			// 		move_uploaded_file($_FILES["files"]["tmp_name"][$key],"Upload/".$newFileName);
					
			// 		// 업로드 할때 editorid와 함께 file_name의 id 값도 함께 업로드 하기
			// 		$query = "INSERT INTO userfiles(FilePath, FileName, editorid) VALUES('Upload','$newFileName', '$editorid')";
			// 		$result = mysqli_query($conn, $query);

			// 		// 에러 확인 3		
			// 		if($result === false){
			// 			echo mysqli_error($conn);
			// 			exit;
			// 		}
					
			// 		$sql = "SELECT * FROM userfiles WHERE FileName ='$newFileName'";
			// 		$result = mysqli_query($conn,$sql);

			// 		// 에러 확인 4		
			// 		if($result === false){
			// 			echo mysqli_error($conn);
			// 			exit;
			// 		}
					
			// 		$row_filesID = mysqli_fetch_assoc($result);
			// 		// 방금 업로드한 파일의  id 값을 조회해서 변수에 담기
			// 		$filesID = $row_filesID['id'];
					
			// 		// items 테이블에 재료명과 $filesID의 값을 함께 업로드하기
			// 		$file_name = $_POST['file_name'];
			// 		$query = "INSERT INTO items(name, userfilesID) VALUES('$file_name[$num]','$filesID')";
			// 		$result = mysqli_query($conn, $query);
					
			// 		// 에러 확인 5
			// 		if($result === false){
			// 			echo mysqli_error($conn);
			// 			exit;
			// 		}
			// 		$num = $num + 1;
			// 		// userfiles의 id 값을 받아서 변수에 담기
			// 		// name 입력 값을 받아서 변수에 넣은 값을 userfiles의 id 값과 같은 변수(userfilesId)에 담는다
			// 		// insert를 활용해서 name의 값을 함께 넣는다


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