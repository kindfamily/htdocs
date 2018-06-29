<?php
require("../config/session.php");
require("../config/config.php");
require("../lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

// ck 글 id 값으로 item의 이름, 가격을 불러오기
$id = $_GET['id'];
$sql = "SELECT items.platform, items.title, items.path, items.fileName2, items.price, items.link, ck.id  FROM ck LEFT JOIN items ON ck.itemNum = items.id WHERE ck.id = '$id'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$items_name = $row['title'];
$items_price = $row['price'];
echo $items_name;
echo $items_price;


// 불러온 아이탬의 이름과 가격을 주문정보 테이블에 입력한다
$sql = "INSERT INTO order_info (items_title, items_total_price, ck_id) VALUES ('$items_name', '$items_price', '$id');";
$result = mysqli_query($conn,$sql); 
echo $sql;


$sql = "SELECT * FROM order_info WHERE ck_id = '$id'";
$result = mysqli_query($conn,$sql); 
$row = mysqli_fetch_array($result);

if($result === false){
    echo mysqli_error($conn);
}

$order_num = $row['id'];
echo $order_num;

// 주문 번호를 세션에 담아서 cart.php 파일로 보내기
// session_start();

$_SESSION['order_num'] = $row['id'];
$_SESSION['ck_id'] = $_GET['id'];

if(!isset($_SESSION['order_num']))
{
        header('Location: ../cart.php');
}
?>
<meta http-equiv='refresh' content='0;url=./cart.php'>



