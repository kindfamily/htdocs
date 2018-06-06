<?php
require("../../config/session.php");
require("../../config/config.php");
require("../../lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$id = $_GET['id'];

$sql = "DELETE ck.*, userfiles.* FROM ck LEFT JOIN userfiles ON ck.id = userfiles.editorid WHERE ck.id='{$id}'";
$result = mysqli_query($conn, $sql);
if($result === false){
  echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
  error_log(mysqli_error($conn));
} else {
//   echo '삭제에 성공했습니다. <a href="../../php/community.php">돌아가기</a>';
}
?>
<meta http-equiv='refresh' content='0;url=../../php/mypage.php'>
