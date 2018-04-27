
<!--버튼 클릭으로 투표숫자에 1을 더하는 모듈-->

<?php
require("../config/config.php");
require("../lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
$result = mysqli_query($conn, "SELECT * FROM num");
?>
<DOCTYPE! html>
<html>
	<head>
	</head>
	<body>
		<header>		
			<?php
				$sql = "SELECT votenum FROM num WHERE num.id=1";
				$result = mysqli_query($conn, $sql);
				$row = mysqli_fetch_assoc($result);

			?>
			<form action="./process.php">
				<label for="vote">클릭:
					<?php
						echo $row['votenum'];
					?>
				</label>
				<button type="submit">투표</button>
			</form>
		
		</header>
	</body>
</html>