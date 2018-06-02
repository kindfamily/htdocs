<?php
require("./config/session.php");
require("./config/config.php");
require("./lib/db.php");

$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$nav = '';
if(isset($user_name)) {
    $nav = $nav."<a class='w3-bar-item w3-button'>$user_name($user_type)</a><a href='./php/mypage.php' onclick='w3_close()' class='w3-bar-item w3-button'>마이페이지</a><a href='../login/php/logout.php' onclick='w3_close()' class='w3-bar-item w3-button'>LOGOUT</a>"; 
} else {
    $nav = $nav."<a href='../login/login.php' onclick='w3_close()' class='w3-bar-item w3-button'>LOGIN</a>"; 
}
?>

<!DOCTYPE html>
<html>
<title>동네컴퓨터학원</title>


<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- (1) LoginWithNaverId Javscript SDK -->
<script type="text/javascript" src="https://static.nid.naver.com/js/naveridlogin_js_sdk_2.0.0.js" charset="utf-8"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link href="https://fonts.googleapis.com/css?family=Black+Han+Sans:400" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="./css/style.css">
<style>
/* scroll nav  */
body {
  margin: 0;
  /* font-size: 28px; */
}

#navbar {
  overflow: hidden;
  color: black;
  background-color: white;
}

#navbar a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

#navbar a:hover {
  background-color: #ddd;
  color: black;
}

#navbar a.active {
  background-color: #4CAF50;
  color: white;
}

.content {
  padding: 16px;
}

.sticky {
  position: fixed;
  top: 3.4rem;
  width: 100%;
}

.sticky + .content {
  padding-top: 60px;
}

@media(max-width:591px){
  #title{
      font-size: 3rem; 
  }
  .sticky {
    position: fixed;
    top: 2.5rem;
    width: 100%;
  }
}
</style>
</head>

<body>
<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-border col-container" id="myNavbar">
    <a id="mtitle" href="../index.php" class="w3-bar-item w3-button w3-wide w3-hover-white">동네컴퓨터학원</a>

    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small" style="padding:6px;">
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