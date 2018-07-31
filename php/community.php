<?php
require("../config/session.php");
require("../config/config.php");
require("../lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

$sql = "SELECT * FROM items LEFT JOIN ck ON items.id = ck.itemNum LIMIT 30";
$result = mysqli_query($conn, $sql);
// if(!isset($_POST['user_id']) || !isset($_POST['user_pw'])) exit;

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
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}

/* slide */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}
</style>
<body class="w3-light-grey w3-content" style="max-width:1600px">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container">
    <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
      <i class="fa fa-remove"></i>
    </a>
    <a href="../index.php"><img src="../img/avatar3.png" style="width:45%;" class="w3-round"></a><br><br>
    <h4><b></b></h4>
    <p class="w3-text-grey"></p>
  </div>
  <div class="w3-bar-block">
    <!-- 
    <i class="fa fa-envelope fa-fw w3-margin-right"></i>
    <i class="fa fa-user fa-fw w3-margin-right"></i> -->
    
    
    <a href="../index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-home fa-fw"></i> 홈</a> 
    <!-- <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-fighter-jet fa-fw"></i> 최신</a> 
    <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-heart fa-fw"></i> 인기</a> 
    <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-youtube-play fa-fw"></i> 연재</a> 
    <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i> 수준별</a> -->
    <!-- <a href="../PHPMySqlFileUpload/samples/create.php" class="w3-bar-item w3-padding"><i class="fa fa-plus-square" style="font-size:36px;"></i></a> -->
  </div>
</nav>


 
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Header -->
  <header id="portfolio">
    <a href="../index.php"><img src="../img/avatar3.png" style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>
    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
    <div class="w3-container">
    <h1><b>프로젝트</b></h1><h2><?=$user_info?><br></h2>
    
    <div class="w3-section">
      <!-- <label class="switch w3-left w3-margin-bottom">
          <input type="checkbox">
          <span class="slider round"></span>
      </label> -->
    </div>
      <!-- <div class="w3-section w3-bottombar w3-padding-16">
      <span class="w3-margin-right">Filter:</span> 
      <button class="w3-button w3-black"><i class="fa fa-sun-o fa-fw"></i> 전체</button>
      <button class="w3-button w3-white"><i class="fa fa-fighter-jet fa-fw"></i> 유망플렛폼</button> 
      <button class="w3-button w3-white w3-hide-small"><i class="fa fa-heart fa-fw"></i> 인기</button>
      <button class="w3-button w3-white w3-hide-small"><i class="fa fa-youtube-play fa-fw"></i> 연재</button>
      <button class="w3-button w3-white w3-hide-small"><i class="fa fa-users fa-fw"></i> 수준별</button> 
    
      <button class="w3-button w3-white w3-hide-small"><i class="fa fa-map-pin w3-margin-right"></i>새로만들기</button>
      </div> -->
  </header>

        

        
  <!-- Photo Grid-->
  <div class="w3-row-padding">
      
  <?php
    while($row = mysqli_fetch_assoc($result)){
      $itemsType = $row['type'];
      if ($itemsType === 'it'){

      echo '
      <div class="w3-display-container w3-quarter w3-container w3-margin-bottom">
      <div class="w3-display-topright w3-amber w3-padding w3-round" style="width: 90px; text-align:center; margin-top:35px;">'.$row['platform'].'</div>
        <div class="w3-display-topright w3-teal w3-padding w3-round" style="width: 90px; text-align:center;"><b>items</b></div>
          <a href="youtubepage.php?id='.$row['id'].'">
            <img src="../editor/samples/Upload/'.($row['title_img_name']).'" alt="Norway" style="width:100%" class="">
          </a>
        <div class="w3-container w3-white">
          <p>'.($row['title']).'</p>
        </div>
      </div>';

     }elseif ($itemsType === 'pl') {

      echo '
      <div class="w3-display-container w3-quarter w3-container w3-margin-bottom">
      <div class="w3-display-topright w3-amber w3-padding w3-round" style="width: 90px; text-align:center; margin-top:35px; ">'.$row['platform'].'</div>
      <div class="w3-display-topright w3-teal w3-padding w3-round" style="width: 90px; text-align:center;"><b>platform</b></div>
          <a href="youtubepage.php?id='.$row['id'].'">
            <img src="../editor/samples/Upload/'.($row['title_img_name']).'" alt="Norway" style="width:100%" class="">
          </a>
        <div class="w3-container w3-white">
          <p>'.($row['title']).'</p>
        </div>
      </div>';

     }
    }
  ?>

<!-- End page content -->
</div>

<script>
// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}
</script>

</body>
</html>
