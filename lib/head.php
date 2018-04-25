<?php
session_start();

$timeout = 1 ; // Set timeout minutes 
$logout_redirect_url = "index.php" ; // Set logout URL 
$timeout = $timeout * 60 ; // Converts minutes to seconds 
if (isset( $_SESSION [ 'start_time' ])) { 
  $elapsed_time = time () - $_SESSION [ 'start_time' ]; 
  if ( $elapsed_time >= $timeout ) { 
    session_destroy (); 
    header ( "Location: $logout_redirect_url" ); 
  } 
} 
$_SESSION [ 'start_time' ] = time (); 


if(isset($_SESSION['user_id']))
{
    $user_id = $_SESSION['user_id'];
}

if(isset($_SESSION['user_name']))
{
   $user_name = $_SESSION['user_name'];
}

if(isset($_SESSION['user_type']))
{
    $user_type = $_SESSION['user_type'];
}



$nav = '';
if(isset($user_name)) {
    $nav = $nav."<a class='w3-bar-item w3-button'>$user_name($user_type)</a><a href='./php/mypagefirst.php' onclick='w3_close()' class='w3-bar-item w3-button'>마이페이지</a><a href='../login/php/logout.php' onclick='w3_close()' class='w3-bar-item w3-button'>LOGOUT</a>"; 
} else {
    $nav = $nav."<a href='../login/login.php' onclick='w3_close()' class='w3-bar-item w3-button'>LOGIN</a>"; 
}

?>

<!DOCTYPE html>
<html>
<title>동네컴퓨터학원</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- (1) LoginWithNaverId Javscript SDK -->
<script type="text/javascript" src="https://static.nid.naver.com/js/naveridlogin_js_sdk_2.0.0.js" charset="utf-8"></script>


<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link href="https://fonts.googleapis.com/css?family=Black+Han+Sans:400" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./css/style.css">
<body scroll="no">
<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-card" id="myNavbar">
    <a href="../index.php" class="w3-bar-item w3-button w3-wide" style="padding: 0 1rem; font-size: 2.2rem; font-family: 'Black Han Sans', sans-serif;">동네컴퓨터학원</a>

    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small">
      <a href="../php/community.php" class="w3-bar-item w3-button"><i class="fa fa-user"></i>&nbsp;COMMUNITY</a>
  
        <!-- login mypage php -->
        <?=$nav?>
  
    </div>

    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
  <a href="../php/community.php" class="w3-bar-item w3-button"><i class="fa fa-user"></i>&nbsp;COMMUNITY</a>

    <!-- login mypage php -->
    <?=$nav?>

</nav>