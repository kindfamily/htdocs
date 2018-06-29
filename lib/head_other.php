<?php
require("../config/session.php");
require("../config/config.php");
require("../lib/db.php");


// 유지되는 세션값이 있다면 변수에 담기
if(isset($_SESSION['order_num']))
{
	$order_num = $_SESSION['order_num'];
}

if(isset($_SESSION['ck_id']))
{
	$id = $_SESSION['ck_id'];
}

$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$nav = '';
if(isset($user_name)) {
    $nav = $nav."<a class='w3-bar-item' style='color:white'>$user_name($user_type)</a><a href='./php/mypage.php' onclick='w3_close()' class='w3-bar-item' style='color:white'>마이페이지</a><a href='../login/php/logout.php' onclick='w3_close()' class='w3-bar-item' style='color:white'>LOGOUT</a>"; 
} else {
    $nav = $nav."<a href='../login/login.php' onclick='w3_close()' class='w3-bar-item' style='color:white'>LOGIN</a>"; 
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
<link rel="stylesheet" href="../css/style.css">

<link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">

<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js" ></script>
<script type="text/javascript" src="https://service.iamport.kr/js/iamport.payment-1.1.5.js"></script>

<style>
/* 반응형 테이블, 75 25% 레이아웃 */
  body {
    margin: 0;
  }

  .bar, .main, .main2{
    padding: 0 150px;
  }
  

  .row {
    display: -ms-flexbox; /* IE10 */
    display: flex;
    -ms-flex-wrap: wrap; /* IE10 */
    flex-wrap: wrap;
    margin: 0 -16px;
  }

  .col-25 {
    -ms-flex: 25%; /* IE10 */
    flex: 25%;
  }

  .col-50 {
    -ms-flex: 50%; /* IE10 */
    flex: 50%;
  }

  .col-75 {
    -ms-flex: 75%; /* IE10 */
    flex: 75%;
  }

  .col-25,
  .col-50,
  .col-75 {
    padding: 0 16px;
  }

  .container {
    background-color: #f2f2f2;
    padding: 5px 20px 15px 20px;
    border: 1px solid lightgrey;
    border-radius: 3px;
  }

  input[type=text] {
    width: 100%;
    margin-bottom: 20px;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 3px;
  }

  label {
    margin-bottom: 10px;
    display: block;
  }

  .icon-container {
    margin-bottom: 20px;
    padding: 7px 0;
    font-size: 24px;
  }

  .btn {
    background-color: #4CAF50;
    color: white;
    padding: 12px;
    margin: 10px 0;
    border: none;
    width: 100%;
    border-radius: 3px;
    cursor: pointer;
    font-size: 17px;
  }

  .btn:hover {
    /* background-color: #45a049; */
  }

  a {
    color: #2196F3;
    text-decoration: none;
  }

  hr {
    border: 1px solid lightgrey;
  }

  span.price {
    float: right;
    color: grey;
  }

/* 반응형 태이블 */
table, tr, td, th{
    border-top: 1px solid #CCC;
}

.number-table {
    font-size: 12px;
    width: 100%;
    border-collapse: collapse;
    /* border: 1px solid #CCC; */
    
    th,
    td {
        padding: 6px 10px;
        border-top: 1px solid #CCC;
        border-left: 1px solid #CCC;
        &:first-child {
          border-left: 0 none;
        }
    }
    th {
        text-align: center;
        font-weight: normal;
        background: #eee;
    }
    tfoot {
        th,
        td {
            border-top: 2px solid #ccc;
        }
    }
}

.table-cell {
    @for $i from 1 through 10 {
        &-1of#{$i} {
          width: percentage(1/$i);
        }
    }

    &-3of5 { width: 60%; }
    &-2of3 { width: 66.66%; }
    &-3of4 { width: 75%; }
    &-4of5 { width: 80%; }
    &-5of6 { width: 83.33%; }
}

  /* .readable-hidden {  
      position: absolute !important;
      height: 1px;
      width: 1px;
      overflow: hidden;
      clip: rect(1px 1px 1px 1px); // for IE6, IE7
      clip: rect(1px, 1px, 1px, 1px);
  } */

  /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
  @media (max-width: 800px) {
    .row {
      flex-direction: column-reverse;
    }
    .col-25 {
      margin-bottom: 20px;
    }
  }


/* scroll nav  */


#navbar {
  overflow: hidden;
  /* color: black; */
  background-color: white;
}

#navbar a {
  float: left;
  display: block;
  /* color: black; */
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

/* #navbar a:hover {
  background-color: #ddd;
  color: black;
} */

#navbar a.active {
  /* background-color: #4CAF50;
  color: white; */
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
  <div class="bar w3-bar w3-light-green w3-border col-container">
    <a id="mtitle" href="../index.php" class="w3-bar-item w3-wide" style="color:white">동네컴퓨터학원</a>

    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small" style="padding:6px;">
      <a href="../community.php" class="w3-bar-item" style="color:white"><i class="fa fa-user"></i>&nbsp;COMMUNITY</a>
  
        <!-- login mypage php -->
        <?=$nav?>
  
    </div>

    <a href="javascript:void(0)" class="w3-bar-item w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>
  </div>


<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
  <a href="../php/community.php" class="w3-bar-item w3-button"><i class="fa fa-user"></i>&nbsp;COMMUNITY</a>

    <!-- login mypage php -->
    <?=$nav?>

</nav>