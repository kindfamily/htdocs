<?php
require("../../config/config.php");
require("../../lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);


$sql = "SELECT * FROM ck LIMIT 30";

$result = mysqli_query($conn, $sql);
// if(!isset($_POST['user_id']) || !isset($_POST['user_pw'])) exit;


if($result === false){
  echo mysqli_error($conn);
  exit;
}

?>

<!DOCTYPE html>
<!--
Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
-->
<html>
<head>
	<meta charset="utf-8">
	<title>CKEditor Sample</title>
	<script src="../ckeditor.js"></script>
	<script src="js/sample.js"></script>
	<link rel="stylesheet" href="css/samples.css">
	<link rel="stylesheet" href="toolbarconfigurator/lib/codemirror/neo.css">
</head>
<body>

	<form action="./insert.php" method="post">
		<textarea class="ckeditor" name="editor"></textarea>
		<input type="submit" value="전송">
	</form>

<?php
    while($row = mysqli_fetch_assoc($result)){
      echo '<p>'.$row['content'].'</p>';
    }
  ?>


</body>
</html>