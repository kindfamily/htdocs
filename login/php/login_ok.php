<?php
require("../../config/config.php");
require("../../lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

if(!isset($_POST['user_id']) || !isset($_POST['user_pw'])) exit;

$filtered = array(
        'user_id'=>mysqli_real_escape_string($conn, $_POST['user_id']),
        'user_pw'=>mysqli_real_escape_string($conn, $_POST['user_pw']),
);

 


$sql = "SELECT * FROM user LEFT JOIN user_type ON user.m_type = user_type.id WHERE m_id='{$filtered['user_id']}' and m_pw='{$filtered['user_pw']}'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if($result === false){
        echo mysqli_error($conn);
        exit;
}

session_start();

$_SESSION['user_id'] = $row['m_id'];
$_SESSION['user_name'] = $row['m_name'];
$_SESSION['user_type'] = $row['type'];


if(!isset($_SESSION['user_id']))
{
        header('Location: ../signin.php');
}
if($_SESSION['user_type'] === '관리자'){
        header('Location: ../../php/mypage.php');
}
if($_SESSION['user_type'] === '일반회원'){
        header('Location: ../../php/community.php');
}
if($_SESSION['user_type'] === '네이버'){
        header('Location: ../../php/community.php');
}
if($_SESSION['user_type'] === '페이스북'){
        header('Location: ../../php/community.php');
}
if($_SESSION['user_type'] === '구글'){
        header('Location: ../../php/community.php');
}
if($_SESSION['user_type'] === '카카오'){
        header('Location: ../../php/community.php');
}
if($_SESSION['user_type'] === '깃헙'){
        header('Location: ../../php/community.php');
}

?>


<meta http-equiv='refresh' content='0;url=../../index.php'>