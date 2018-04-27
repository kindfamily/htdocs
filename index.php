<?php
    include_once './lib/head.php';
?>

<!-- Header with full-height image -->
  <div class="w3-container w3-padding-64 w3-center">
    <h1 id="title">배우고, 나누는</h1>
    <div style="width: 100%; height:1px; background-color: black;"></div>
    <h1 class="w3-wide w3-padding-16 w3-large" style="width:100%">플랫폼 커뮤니티</h1>
    <a href="../php/community.php" class=" w3-round w3-button w3-black w3-padding-large w3-medium w3-opacity w3-hover-opacity-off" style="width:50%;">전체보기</a>
    <div class="w3-padding-large w3-padding-64">
      <img class="w3-opacity" src="./img_sum/apple.jpeg" alt="Cherries" style="width:4rem">
      <img class="w3-opacity" src="./img_sum/Arduino.jpg" alt="Cherries" style="width:4rem">
      <img class="w3-opacity" src="./img_sum/ifttt.jpeg" alt="Cherries" style="width:4rem">
      <img class="w3-opacity" src="./img_sum/micro-bit.jpeg" alt="Cherries" style="width:4rem">
      <img class="w3-opacity" src="./img_sum/Raspi.jpeg" alt="Cherries" style="width:4rem">
      <img class="w3-opacity" src="./img_sum/amazon.jpeg" alt="Cherries" style="width:4rem">
      <img class="w3-opacity" src="./img_sum/google.jpg" alt="Cherries" style="width:4rem">
      <img class="w3-opacity" src="./img_sum/ubuntu.jpeg" alt="Cherries" style="width:4rem">
    </div>
    
  </div>

  <div id="navbar" class="tab">
    <a class="tablinks" onclick="openCity(event, 'London')" href="javascript:void(0)">전체</a>
    <a class="tablinks" onclick="openCity(event, 'Paris')" href="javascript:void(0)">최신</a>
    <a class="tablinks" onclick="openCity(event, 'Tokyo')" href="javascript:void(0)">인기</a>
    <a class="tablinks" onclick="openCity(event, 'Tokyo')" href="javascript:void(0)">더보기</a>
  </div>
  <div id="London" class="tabcontent">
    <div class="w3-row-padding">
      <?php
        $sql = "SELECT * FROM youtube LIMIT 30";
        $result = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_assoc($result)){
            echo '<div class="w3-third w3-container w3-margin-bottom"><a href="./php/youtubepage.php?id='.$row['id'].'"><img src="../img/'.($row['link_img']).'" alt="Norway" style="width:100%" class="w3-hover-opacity"></a><div class="w3-container w3-white"><p><b>'.($row['title']).'</b></p><p>'.($row['description']).'</p></div></div>';
          }
        ?> 
    </div>
  </div>
  <div id="Paris" class="tabcontent">
    <h3>Paris</h3>
    <p>Paris is the capital of France.</p> 
  </div>

  <div id="Tokyo" class="tabcontent">
    <h3>Tokyo</h3>
    <p>Tokyo is the capital of Japan.</p>
  </div>




  

<!-- Footer -->
<!-- <footer class="w3-center w3-black w3-padding-64">
  <a href="#home" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
  <div class="w3-xlarge w3-section">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
  </div>
</footer>
  -->
<!-- Add Google Maps -->
<script>
function myMap()
{
  myCenter=new google.maps.LatLng(41.878114, -87.629798);
  var mapOptions= {
    center:myCenter,
    zoom:12, scrollwheel: false, draggable: false,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"),mapOptions);

  var marker = new google.maps.Marker({
    position: myCenter,
  });
  marker.setMap(map);
}

// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}


// Toggle between showing and hiding the sidebar when clicking the menu icon
var mySidebar = document.getElementById("mySidebar");

function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
    } else {
        mySidebar.style.display = 'block';
    }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
}

// scrool nav
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}

// SHOW DANAMIC TAP
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

</script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCs933UzjYy_fxRkGivV_7L6Ieo_S-yCtY&callback=myMap"></script>
<!--
To use this code on your website, get a free API key from Google.
Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
-->

</body>
</html>
