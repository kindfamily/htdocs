<?php
require("../../config/config.php");
require("../../lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
 
// if(!isset($_POST['user_id']) || !isset($_POST['user_pw'])) exit;
// if(!isset($_POST['user_name']) || !isset($_POST['user_type'])) exit;

// $filtered = array(
//         'user_id'=>mysqli_real_escape_string($conn, $_POST['user_id']),
//         'user_pw'=>mysqli_real_escape_string($conn, $_POST['user_pw']),
//         'user_name'=>mysqli_real_escape_string($conn, $_POST['user_name']),
//         'user_type'=>mysqli_real_escape_string($conn, $_POST['user_type']),
//         'user_likes'=>mysqli_real_escape_string($conn, $_POST['user_likes'])
// );

// $uqid = 'HI';
// $uqid = $_POST['uqid'];

// echo $uqid;
// exit;
 

$sql = "INSERT INTO user_n(uniqid) VALUES('{$_POST['id']}')";

echo $sql; 
// die();
// var_dump($sql);

$result = mysqli_query($conn,$sql); 
if($result === false){
    echo mysqli_error($conn);
}

?>
<!-- <meta http-equiv='refresh' content='0;url=index.php'> -->