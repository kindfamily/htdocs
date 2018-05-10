<?php
require("../../config/config.php");
require("../../lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

?>

<!DOCTYPE html>
<html>
<head>
	<!-- <meta charset="utf-8"> -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CKEditor Sample</title>
	<script src="../ckeditor.js"></script>
	<script src="js/sample.js"></script>
	<link rel="stylesheet" href="css/samples.css">
	<link rel="stylesheet" href="toolbarconfigurator/lib/codemirror/neo.css"><title>동네컴퓨터학원</title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="../css/fontello.css">
</head>
<body id="main">
<form action="./insert.php" method="post" enctype="multipart/form-data">
	<p>
		<h3>메인사진</h3>	
		<input type="file" name="file">
		<h3>제목</h3>
		<input type="text" name="title">		
	</p>
	<p>
		<h3>작성자</h3>
		<?php
			$sql = "SELECT * FROM user";
			$result = mysqli_query($conn, $sql);
			$select_form = '<select name="user_id">';
			while($row = mysqli_fetch_array($result)){
			$select_form .= '<option value="'.$row['id'].'">'.$row['m_name'].'</option>';
			}
			$select_form .= '</select>';
		?>
		<?=$select_form?>
	</p>
	<p>
		<h3>재료1</h3>
		제품명:<input type="text" name="source_name">
		구매링크:<input type="text" name="source_name">
		사진:<input type="file" name="file2">
	</p>
	<p>
	<textarea class="ckeditor" name="editor"></textarea>	
		<button type="submit" name="submit">UPLOAD</button>
	</p>
</form>

<?php
	$sql = "SELECT * FROM ck LEFT JOIN user ON ck.user_id=user.id";

	$result = mysqli_query($conn, $sql);
	// if(!isset($_POST['user_id']) || !isset($_POST['user_pw'])) exit;

    while($row = mysqli_fetch_assoc($result)){
      echo '<div class="w3-twothird w3-container"><p>'.$row['title'].'</p></p><p><img src="./img/'.$row['link_img'].'" style="width:100%" ></p><p>'.$row['m_name'].'</p><p>'.$row['content'].'</p></div>';
	}
?>

<div class="w3-twothird w3-container"><table class="number-table w3-center">
	  <thead>
		  <tr>
			  <th scope="col">이름</th>
			  <th scope="col">플랫폼</th>
			  <th scope="col">사진</th>
			  <th scope="col">장바구니</th>
			  <th scope="col"></th>
		  </tr>
	  </thead>
	  <tbody>
<?php
	$sql = "SELECT * FROM userfiles LEFT JOIN ck ON ck.user_id=user.id";

	$result = mysqli_query($conn, $sql);
	// if(!isset($_POST['user_id']) || !isset($_POST['user_pw'])) exit;

    while($row = mysqli_fetch_assoc($result)){
	  echo '<tr>
	  			<th scope="row">button</th>
				  <td>리틀빗</td>
				  <td><img src="" style="width:8rem" alt=""></td>
				  <td><input class="w3-input w3-center" type="text" id="test" value="0"></td>
				  <td><button>+</button><a href="https://www.amazon.com/littleBits-680-0010-Education-Code-Kit/dp/B06XCL5S6D/ref=sr_1_1_sspa?ie=UTF8&qid=1525269139&sr=8-1-spons&keywords=littlebits+code+kit&psc=1"><i class=" icon-basket"></i></a></td>
  	 		 </tr>
	  ';
	}
?>

		  <tr>
			  <th scope="row">button</th>
			  <td>리틀빗</td><td><img src="./img/'.$row['link_img'].'" style="width:8rem" alt=""></td><td><input class="w3-input w3-center" type="text" id="test" value="0"></td><td><button>+</button><a href="https://www.amazon.com/littleBits-680-0010-Education-Code-Kit/dp/B06XCL5S6D/ref=sr_1_1_sspa?ie=UTF8&qid=1525269139&sr=8-1-spons&keywords=littlebits+code+kit&psc=1"><i class=" icon-basket"></i></a></td>
		  </tr>
	  </tbody>
	  <tfoot>
		  <tr>
			  <th scope="row"></th>
			  <td></td><td>합계:</td><td>5</td><td><input type="button" value="+" onclick=""></td>
		  </tr>
	  </tfoot>
  </table></div>'

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
