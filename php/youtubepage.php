<?php
require("../config/session.php");
require("../config/config.php");
require("../lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$id = $_GET['id'];
$sql = "SELECT * FROM ck WHERE id='".$id."'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if($result === false){
        echo mysqli_error($conn);
        exit;
}


$user_info = '';
if(isset($user_name)) {
    $user_info = $user_info."$user_name($user_type)"; 
} else {
    $user_info = $user_info.""; 
}

$update = '';
$delete = '';
if($user_type === '관리자') {
    $update = $update."<a href='../editor/samples/update.php?id=".$row['id']."' class='w3-button w3-white w3-border w3-round-large'>관리자권한수정</a>";
    $delete = $delete."<a href='../editor/samples/delete.php?id=".$row['id']."' class='w3-button w3-white w3-border w3-round-large'>관리자권한삭제</a>";  
} else {
    $update = $update.""; 
    $delete = $delete.""; 
}

?>

<!DOCTYPE html>
<html>
<title>동네컴퓨터학원</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="../css/fontello.css">

<script type="text/javascript" src="https://service.iamport.kr/js/iamport.payment-1.1.5.js"></script>

<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif;}
.w3-sidebar {
  z-index: 3;
  width: 250px;
  top: 43px;
  bottom: 0;
  height: inherit;
}

/* 태이블 반응형 */
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

.readable-hidden {  
    position: absolute !important;
    height: 1px;
    width: 1px;
    overflow: hidden;
    clip: rect(1px 1px 1px 1px); // for IE6, IE7
    clip: rect(1px, 1px, 1px, 1px);
}

/* 유튜브 반응형 */
.youtubeWrap {
  position: relative;
  width: 100%;
  padding-bottom: 56.25%;
}
.youtubeWrap iframe {
  position: absolute;
  width: 100%;
  height: 100%;
}

</style>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-theme w3-top w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-right w3-hide-large w3-hover-white w3-large w3-theme-l1" href="./community.php" onclick="w3_open()"><i class="fa fa-bars"></i></a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white"></a>
    <a href="../php/community.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">전체보기</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">스토리</a>
    <!-- <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">소스코드</a> -->
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">재료</a>
    <span class="w3-bar-item w3-right w3-hide-small"><?=$user_info?></span>
    <!-- <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Clients</a> -->
    <!-- <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Partners</a> -->
  </div>
</div>

<!-- Sidebar -->
<!-- <nav class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
    <i class="fa fa-remove"></i>
  </a>
  <h4 class="w3-bar-item"><b>Menu</b></h4>

  <a href="../php/community.php" class="w3-bar-item w3-button w3-hover-black">전체보기</a>
  <a href="#" class="w3-bar-item w3-button w3-hover-black">스토리</a>
  <a href="#" class="w3-bar-item w3-button w3-hover-black">소스코드</a>
  <a href="#" class="w3-bar-item w3-button w3-hover-black">재료</a>
</nav> -->

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:200px; margin-right: 200px;">
  <div class="w3-row w3-padding-64">
    <h2 class="w3-center w3-border-bottom"><?=$row['title']?>(<?=$row['id']?>)</h2>
    <h6 class="w3-center">jungwonbong</h6>
    <h6 class="w3-center">2018.04.29</h6>
    <div class="w3-twothird w3-container">
      <?php
        echo '<img src="../PHPMySqlFileUpload/samples/Upload/'.($row['title_img_name']).'" alt="Norway" style="width:100%" class="w3-hover-opacity"><h3 id="video">설명</h3><p>'.($row['content']).'</p>';
      ?>
      
      <!-- 반응형 youtube 테두리  -->
      <!-- <div class="youtubeWrap"><iframe width="100%" height="400px" src="https://www.youtube.com/embed/Rrm8AeYEcFY" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div> -->
    </div>
    <div class="w3-third w3-container">
      <div class="w3-padding-large w3-padding-24" >
      <h3>개요</h3>
      <p class="w3-border-bottom"></p>
      <p>리틀비츠 coding kit 을 활용해서 간단한 튜토리얼 프로젝트 진행</p>
      <a href="https://www.amazon.com/littleBits-680-0010-Education-Code-Kit/dp/B06XCL5S6D/ref=sr_1_1_sspa?ie=UTF8&qid=1525961162&sr=8-1-spons&keywords=littlebits+code+kit&psc=1" class="w3-button w3-white w3-border w3-round-large">제품구매링크</a>
      
      <?=$update?>
      <?=$delete?>
      <!-- <ul>
        <li><a href="#video">비디오</a></li>
        <li>설명</li>
        <li>소스코드</li>
        <li>부품구매</li>
        <li>댓글</li>
      </ul> -->
      
      </div>
      <!-- <div class="w3-border w3-padding-large w3-padding-24 w3-center">AD</div> -->
    </div>
  </div>

  <!-- <div class="w3-row w3-padding-64">
    <div class="w3-twothird w3-container">
      <h1 class="w3-text-teal">소스</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum
        dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div class="w3-third w3-container">
      <div class="w3-border w3-padding-large w3-padding-24 w3-center">AD</div>
      <div class="w3-border w3-padding-large w3-padding-24 w3-center">AD</div>
    </div>
  </div> -->


  
  
  
    <div class="w3-twothird w3-container">
        <table class="number-table w3-center" style="margin-bottom: 5rem">
            <thead>
                <tr>
                    <th scope="col">플랫폼</th>
                    <th scope="col">이름</th>
                    <th scope="col">사진</th>
                    <th scope="col">가격</th>
                    <th scope="col">링크</th>
                </tr>
            </thead>
                  <?php

                    $sql = "SELECT * FROM ck LEFT JOIN items ON ck.itemNum = items.id WHERE ck.id = '$id'";

                    $result = mysqli_query($conn, $sql);

                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)){
                    echo '
                    <tbody>
                        <tr>
                          <td>'.$row['platform'].'</td>
                          <td>'.$row['name'].'</td>
                          <td><img src="../'.$row['path'].'/'.$row['fileName'].'" style="width:8rem" alt=""></td>
                          <td>'.$row['price'].'$</td>
                          <td><a href="'.$row['price'].'"><button class="w3-button w3-white w3-border"><i class="fa fa-bars"></i></button></a></td>
                    </tbody>
                    
                    ';
                    }
                  ?> 
        </table>
    </div>
    <!-- <div class="w3-third w3-container">
      <p class="w3-border w3-padding-large w3-padding-32 w3-center">AD</p>
      <p class="w3-border w3-padding-large w3-padding-64 w3-center">AD</p>
    </div> -->

  <!-- Pagination -->
  <!-- <div class="w3-center w3-padding-32"> -->
    <div class="w3-bar">
      <!-- <a class="w3-button w3-black" href="#">1</a>
      <a class="w3-button w3-hover-black" href="#">2</a>
      <a class="w3-button w3-hover-black" href="#">3</a>
      <a class="w3-button w3-hover-black" href="#">4</a>
      <a class="w3-button w3-hover-black" href="#">5</a>
      <a class="w3-button w3-hover-black" href="#">»</a> -->
    </div>
</div>

<footer id="myFooter">
<div class="w3-container w3-dark-grey w3-padding-32">
    <div class="w3-row">
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-green">Demographic</h5>
        <p>Language</p>
        <p>Country</p>
        <p>City</p>
      </div>
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-red">System</h5>
        <p>Browser</p>
        <p>OS</p>
        <p>More</p>
      </div>
      <div class="w3-container w3-third">
        <h5 class="w3-bottombar w3-border-orange">Target</h5>
        <p>Users</p>
        <p>Active</p>
        <p>Geo</p>
        <p>Interests</p>
      </div>
    </div>
</footer>
<script>

$(document).ready(function(){
    $("button").click(function(){
        var num = $("#test").val();
        num = ++num; 
        $("#test").val(num);
    });
});

// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
    } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
    }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
    overlayBg.style.display = "none";
}
</script>

</body>
</html>
