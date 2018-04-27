<?php
require("../config/config.php");
require("../lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

// if(!isset($_POST['user_id']) || !isset($_POST['user_pw'])) exit;

// if(!isset($_GET['id'])) exit;

// $filtered = array(
//         'user_id'=>mysqli_real_escape_string($conn, $_GET['id'])
// );


$id = $_GET['id'];
$sql = "SELECT * FROM youtube WHERE id='".$id."'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if($result === false){
        echo mysqli_error($conn);
        exit;
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
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif;}
.w3-sidebar {
  z-index: 3;
  width: 250px;
  top: 43px;
  bottom: 0;
  height: inherit;
}

tr, td, th, table{
  border: 1px solid #a7dc65;
}

th{
  background-color: grey;
}
</style>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-theme w3-top w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-right w3-hide-large w3-hover-white w3-large w3-theme-l1" href="javascript:void(0)" onclick="w3_open()"><i class="fa fa-bars"></i></a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white"><?=$id?></a>
    <a href="../php/community.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">전체보기</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">스토리</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">소스코드</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hover-white">재료</a>
    <!-- <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Clients</a> -->
    <!-- <a href="#" class="w3-bar-item w3-button w3-hide-small w3-hide-medium w3-hover-white">Partners</a> -->
  </div>
</div>

<!-- Sidebar -->
<nav class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
    <i class="fa fa-remove"></i>
  </a>
  <h4 class="w3-bar-item"><b>Menu</b></h4>

  <a href="../php/community.php" class="w3-bar-item w3-button w3-hover-black">전체보기</a>
  <a href="#" class="w3-bar-item w3-button w3-hover-black">스토리</a>
  <a href="#" class="w3-bar-item w3-button w3-hover-black">소스코드</a>
  <a href="#" class="w3-bar-item w3-button w3-hover-black">재료</a>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:200px; margin-right: 200px;">
  <div class="w3-row w3-padding-64">
    <h1 class="w3-text-teal w3-center"><?=$row['title']?></h1>
    <h4 class="w3-center">by jungwonbong <b>2018.04.29</b></h4>
    
    <div class="w3-twothird w3-container">
      <?php
        echo '<img src="../img/'.($row['link_img']).'" alt="Norway" style="width:100%" class=""><h1>story</h1><p>'.($row['description']).'</p><iframe width="100%" height="500px" src="https://www.youtube.com/embed/Rrm8AeYEcFY" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
      ?>
      
    </div>
    <div class="w3-third w3-container">
      <div class="w3-border w3-padding-large w3-padding-64" >
      <p>개요</p>
      <p>리틀비츠 coding kit 을 활용해서 간단한 튜토리얼 프로젝트 진행</p>
      </div>
      <div class="w3-border w3-padding-large w3-padding-64 w3-center">AD</div>
    </div>
  </div>

  <div class="w3-row w3-padding-64">
    <div class="w3-twothird w3-container">
      <h1 class="w3-text-teal">Heading</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum
        dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div class="w3-third w3-container">
      <div class="w3-border w3-padding-large w3-padding-64 w3-center">AD</div>
      <div class="w3-border w3-padding-large w3-padding-64 w3-center">AD</div>
    </div>
  </div>

  <div class="w3-row">
    <div class="w3-twothird w3-container">
      <table class="w3-table w3-margin">
        <tr>
          <th>이름</th>
          <th>플랫폼</th>          
          <th>사진</th>
          <th>장바구니</th>
        </tr>
        <tr>
          <td>button</td>
          <td><img src="../img_sum/littlebits.png" style="width:10rem" alt=""></td>
          <td><img src="../img_littlebits/button.jpg" style="width:10rem" alt=""></td>
          <td><input type="button" value="+"></td>
        </tr>
        <tr>
          <td>Jill</td>
          <td>Jill</td>
          <td>Smith</td>
          <td>50</td>
        </tr>
        <tr>
          <td>Jill</td>
          <td>Jill</td>
          <td>Smith</td>
          <td>50</td>
        </tr>
        <tr>
          <td>Jill</td>
          <td>Jill</td>
          <td>Smith</td>
          <td>50</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td>총합:5</td>
        </tr>
        <tr>  
          <td></td>
          <td></td>
          <td></td>
          <td><input type="button" value="결제하기"></td>
        </tr>

      </table>
    </div>
    <!-- <div class="w3-third w3-container">
      <p class="w3-border w3-padding-large w3-padding-32 w3-center">AD</p>
      <p class="w3-border w3-padding-large w3-padding-64 w3-center">AD</p>
    </div> -->
  </div>

  <!-- Pagination -->
  <!-- <div class="w3-center w3-padding-32">
    <div class="w3-bar">
      <a class="w3-button w3-black" href="#">1</a>
      <a class="w3-button w3-hover-black" href="#">2</a>
      <a class="w3-button w3-hover-black" href="#">3</a>
      <a class="w3-button w3-hover-black" href="#">4</a>
      <a class="w3-button w3-hover-black" href="#">5</a>
      <a class="w3-button w3-hover-black" href="#">»</a>
    </div>
  </div>
 -->
  <footer id="myFooter">
    <div class="w3-container w3-theme-l2 w3-padding-32">
      <h4>Footer</h4>
    </div>
  </footer>

<!-- END MAIN -->
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
