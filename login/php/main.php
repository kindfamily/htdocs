<!DOCTYPE html>
<meta charset="utf-8" />
<?php
session_start();
if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
	echo "<meta http-equiv='refresh' content='0;url=login.php'>";
	exit;
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_type = $_SESSION['user_type'];

echo "<p>안녕하세요. $user_name($user_id)님</p>";
echo "<p>회원님의 등급은 $user_type 입니다</p>";
echo "<p><a href='logout.php'>로그아웃</a></p>";

switch ($user_type) {
    case "회원":
        echo "Your favorite color is red!";
        break;
    case "교사":
        echo "Your favorite color is blue!";
        break;
    case "판매자":
        echo "Your favorite color is green!";
        break;
    default:
        echo "Your favorite color is neither red, blue, nor green!";
}
?>