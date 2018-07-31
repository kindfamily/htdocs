<?php
	require("../../config/config.php");
	require("../../lib/db.php");
	$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
?>

<!DOCTYPE html>
<html lang="en">
	<header>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>동네컴퓨터학원</title>
		
		<script src="../ckeditor.js"></script>
		<script src="js/sample.js"></script>
		<link rel="stylesheet" href="css/samples.css">
		<link rel="stylesheet" href="toolbarconfigurator/lib/codemirror/neo.css">

		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<!-- <link rel="stylesheet" href="../css/fontello.css"> -->

		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">


		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="js/jQuery.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jQuery.Form.js"></script>
		
		<style>
            ul{
                list-style:none;
            }
        </style>  
		<script>
		// 재료 사진 조회 
             $(document).ready(function () {
                $("#keyword").keyup(function()   {
                    var keyword = $(this).val();
                    var dataString = 'searchword='+ keyword;                
                                
                    if(keyword=='') { 
                         $("#display").hide();
                    } else {    
                        $.ajax({
                        type: "POST",
                        url: "itemssuggestions.php",
                        data: dataString,
                        cache: false,
                        success: function(html) {               
								$("#display").html(html).show(); 
								
								$("#key").click(function(){
									$("#display").hide();
									$("#play").html(html).show(); 
								});
                          
                            }
                        });
                    } return false;                             
                });     
            }); 
     
        </script>
	</header>
	<body>
		<div class="container">			
			<div class="page-header">
			<a href="../../index.php"></a>
				<h1>새로운 프로젝트 생성 </h1>
			</div>
			<div class="panel panel-default">
				<div class="panel-body">
					<form method="post" enctype="multipart/form-data" name="formUploadFile" id="uploadForm" action="upload_admin.php">
	
						<p>
						<h3>제목</h3>
							<input type="text" name="title">	
						</p>
						<p>
						<h3>메인사진</h3>	
							<input type="file" name="maintitle">	
						</p>
						<p>
							<textarea class="ckeditor" name="editor"></textarea>	
						</p>

						<div class="input-group">
							<input name="keyword" id="keyword" type="text" class="form-control">
							<span class="input-group-btn">
								<button class="btn btn-danger" type="button" onclick="javascript:checkSearch('keyword');">검색</button>
							</span>
						</div>
						<div id="display"></div>
						<div id="play"></div>

						
						<button type="submit" class="btn btn-primary" name="btnSubmit" >전송</button>
						<!-- <a href="view.php" class="btn btn-info">Show Uploaded Files</a> -->
					</form>
					<br/>
					</div>
				</div>
			</div>
		
		</div>
		
	
	</body>
</html>