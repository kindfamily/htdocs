<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V5</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
				<form class="login100-form validate-form flex-sb flex-w" method='post' action='./php/signin_ok.php'>
					<span class="login100-form-title p-b-53">
						Sign In With
					</span>

					<!-- <a href="#" class="btn-face m-b-20">
						<i class="fa fa-facebook-official"></i>
						Facebook
					</a>

					<a href="#" class="btn-google m-b-20">
						<img src="images/icons/icon-google.png" alt="GOOGLE">
						Google
					</a> -->
					
					<div class="p-t-31 p-b-9">
						<span class="txt1">
							Username
                        </span>
                        <div class="p-t-31 p-b-9" id="idch" >
                        <span class="txt1"> 
                            아이디를 입력하세요.
                        </span>
                        <input type="hidden" value="0" name="use"/>
                    </div>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Username is required">
                        <input class="input100" type="text" name='user_id' id="id">
						<span class="focus-input100"></span>
                    </div>

					<div class="p-t-13 p-b-9">
						<span class="txt1">
							Password
						</span>
                    </div>
                    
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name='user_pw' >
						<span class="focus-input100"></span>
                    </div>

                    <div class="p-t-13 p-b-9">
						<span class="txt1">
							name
						</span>
                    </div>
                    
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="text" name='user_name' >
						<span class="focus-input100"></span>
                    </div>
<!--                     
                    <div class="p-t-13 p-b-9">
						<span class="txt1">
							type
						</span>
                    </div>
					 -->
					<input name="user_type" type="hidden" value="3">


					<!-- <div class="wrap-input100 validate-input" data-validate = "Password is required">
                            <select class="input100" name="user_type">
                                <option value="3">일반회원</option>
                                <option value="교사">교사</option>
                                <option value="판매자">판매자</option>
                            </select>
						<span class="focus-input100"></span>
					</div> -->
					
					<div class="p-t-13 p-b-9">
						<span class="txt1">
							likes
						</span>
                    </div>
					<div class="wrap-input100" name="user_likes">          
						<input type="radio" value="1">microbit
						<input type="radio" value="2">littlebits
						<input type="radio" value="3">arduino
					</div>

					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn">
							Sign In
						</button>
					</div>

					<div class="w-full text-center p-t-55">
						<span class="txt2">
							Not a member?
						</span>

						<a href="#" class="txt2 bo1">
							Sign up now
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
    <script src="js/main.js"></script>

<!-- 아이디 확인 -->
    <script>
	$(document).ready(function(){
		
		$('#id').blur(function(){    

				$.ajax({ // ajax실행부분
					type: "post",
					url : "./php/checkid.php",
					data : {
						id : $('#id').val()
					},
					success : function s(a){ $('#idch').html(a); },
					error : function error(){ alert('시스템 문제발생');}
				});

		});
		
	});
	</script>

</body>
</html>