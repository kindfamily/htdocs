<?php
$timeout = 1 ; // Set timeout minutes 
$logout_redirect_url = "index.php" ; // Set logout URL 
$timeout = $timeout * 3600 ; // Converts minutes to seconds 
if (isset( $_SESSION [ 'start_time' ])) { 
  $elapsed_time = time () - $_SESSION [ 'start_time' ]; 
  if ( $elapsed_time >= $timeout ) { 
    session_destroy (); 
    header ( "Location: $logout_redirect_url" ); 
  } 
} 
$_SESSION [ 'start_time' ] = time (); 

session_start();

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


require("../config/config.php");
require("../lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$sql = "SELECT * FROM user LEFT JOIN user_type ON user.m_type = user_type.id";
$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);

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



?>

<!DOCTYPE html>
<html>
<title>동네컴퓨터학원</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-left"><a href="../index.php" style="text-decoration:none">HOME</a></span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="../img/avatar2.png" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Welcome, <strong><?=$user_info?></strong></span><br>
      <!-- <a href="#" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a> -->
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="#" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-users fa-fw"></i>  Overview</a>
    <!-- <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i>  Views</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Traffic</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bullseye fa-fw"></i>  Geo</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-diamond fa-fw"></i>  Orders</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bell fa-fw"></i>  News</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bank fa-fw"></i>  General</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-history fa-fw"></i>  History</a>
    <a href="#" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Settings</a><br><br> -->
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
  </header>

  <div class="w3-row-padding w3-margin-bottom">
  <div class="w3-quarter">
      <div class="w3-container w3-orange w3-text-white w3-padding-16">
        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>
            <?=$num_rows?>
          </h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Users</h4>
      </div>
    </div>
   
   
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>0</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Messages</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-eye w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>0</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Views</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
        <div class="w3-right">
          <h3>0</h3>
        </div>
        <div class="w3-clear"></div>
        <h4>Shares</h4>
      </div>
    </div>
    
  </div>

  
  <hr>

  <div class="w3-container">
    <h5>가입자 현황(<?=$num_rows?>)</h5>
    <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
    <?php
      while($row = mysqli_fetch_assoc($result)){
        echo '<tr><td>'.($row['m_id']).'('.($row['m_name']).')</td><td>'.($row['type']).'</td></tr>';
      }
    ?>
    </table><br>
    <?php
      $sql = "SELECT * FROM ck";
      $result = mysqli_query($conn, $sql);
      $num_rows2 = mysqli_num_rows($result);
    ?>
    <h5>프로젝트 리스트(<?=$num_rows2?>)</h5>
    <a href="./community.php" style="text-decoration:none"><small>전체보기</small></a>
    <a href="../editor/samples/create_admin.php" style="text-decoration:none"><small>생성하기</small></a>
    <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">

  
     <?php
      


      while($row = mysqli_fetch_assoc($result)){
        $update = '';
        $delete = '';
        if($user_type === '관리자') {
            $update = $update."<a href='../editor/samples/update_admin.php?id=".$row['id']."' class='w3-button w3-white w3-border w3-round-large'>수정</a>";
            $delete = $delete."<a href='../editor/samples/delete_admin.php?id=".$row['id']."' class='w3-button w3-white w3-border w3-round-large'>삭제</a>";  
        } else {
            $update = $update.""; 
            $delete = $delete.""; 
        }

        echo '<tr><td>'.($row['title']).'</td><td>'.$update.'</td><td>'.$delete.'</td></tr>';
      }
    ?>
    </table><br>
    <!-- <a href="../PHPMySqlFileUpload/samples/index.php">ck 테이블에 내용 추가하기 링크 </a>
    <form class="w3-container w3-card-4 w3-light-grey">
      <h2>프로젝트 삽입하기</h2>
      <a href="../ckeditor-full/samples/index.php">글쓰기</a>
      <p>Add the w3-border class to create bordered inputs.</p>

      <p><label>제목</label>
      <input class="w3-input w3-border" name="first" type="text"></p>

      <p><label>삽입링크</label>
            
      <input class="w3-input w3-border" name="last" type="text"></p>

      <p><button class="w3-btn w3-blue">Register</button></p>
    </form> -->
  </div>
  <hr>

  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
      <!-- <div class="w3-third">
        <h5>Regions</h5>
        <img src="../img/region.jpg" style="width:100%" alt="Google Regional Map">
      </div> -->
      <!-- <div class="w3-twothird"> -->
        <!-- <h5>Feeds</h5> -->
        <!-- <table class="w3-table w3-striped w3-white">
          <tr>
            <td><i class="fa fa-user w3-text-blue w3-large"></i></td>
            <td>New record, over 90 views.</td>
            <td><i>10 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-bell w3-text-red w3-large"></i></td>
            <td>Database error.</td>
            <td><i>15 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-users w3-text-yellow w3-large"></i></td>
            <td>New record, over 40 users.</td>
            <td><i>17 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-comment w3-text-red w3-large"></i></td>
            <td>New comments.</td>
            <td><i>25 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-bookmark w3-text-blue w3-large"></i></td>
            <td>Check transactions.</td>
            <td><i>28 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-laptop w3-text-red w3-large"></i></td>
            <td>CPU overload.</td>
            <td><i>35 mins</i></td>
          </tr>
          <tr>
            <td><i class="fa fa-share-alt w3-text-green w3-large"></i></td>
            <td>New shares.</td>
            <td><i>39 mins</i></td>
          </tr>
        </table> -->
      <!-- </div> -->
    </div>
  </div>
  <hr>
  <!-- <div class="w3-container">
    <h5>General Stats</h5>
    <p>New Visitors</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-green" style="width:25%">+25%</div>
    </div>

    <p>New Users</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-orange" style="width:50%">50%</div>
    </div>

    <p>Bounce Rate</p>
    <div class="w3-grey">
      <div class="w3-container w3-center w3-padding w3-red" style="width:75%">75%</div>
    </div>
  </div> -->
<hr>

  <!-- <div class="w3-container">
    <h5>Recent Users</h5>
    <ul class="w3-ul w3-card-4 w3-white">
      <li class="w3-padding-16">
        <img src="../img/avatar2.png" class="w3-left w3-circle w3-margin-right" style="width:35px">
        <span class="w3-xlarge">Mike</span><br>
      </li>
      <li class="w3-padding-16">
        <img src="../img/avatar5.png" class="w3-left w3-circle w3-margin-right" style="width:35px">
        <span class="w3-xlarge">Jill</span><br>
      </li>
      <li class="w3-padding-16">
        <img src="../img/avatar6.png" class="w3-left w3-circle w3-margin-right" style="width:35px">
        <span class="w3-xlarge">Jane</span><br>
      </li>
    </ul>
  </div> -->
  <hr>

  <div class="w3-container">
    <!-- <h5>Recent Comments</h5>
    <div class="w3-row">
      <div class="w3-col m2 text-center">
        <img class="w3-circle" src="../img/avatar3.png" style="width:96px;height:96px">
      </div>
      <div class="w3-col m10 w3-container">
        <h4>John <span class="w3-opacity w3-medium">Sep 29, 2014, 9:12 PM</span></h4>
        <p>Keep up the GREAT work! I am cheering for you!! Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><br>
      </div>
    </div> -->

    <!-- <div class="w3-row">
      <div class="w3-col m2 text-center">
        <img class="w3-circle" src="../img/avatar1.png" style="width:96px;height:96px">
      </div>
      <div class="w3-col m10 w3-container">
        <h4>Bo <span class="w3-opacity w3-medium">Sep 28, 2014, 10:15 PM</span></h4>
        <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><br>
      </div>
    </div> -->
  </div>
  <br>
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
  </div>

  <!-- Footer -->
  <!-- <footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>FOOTER</h4>
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
  </footer> -->

  <!-- End page content -->
</div>

<script>
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
