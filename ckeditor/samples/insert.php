
<?php
        
        require("../../config/config.php");
        require("../../lib/db.php");
        $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);


        $text = $_POST['editor'];
        $sql = "INSERT INTO ck(content) VALUES ('$text')";


        $result = mysqli_query($conn, $sql);

        if($result === false){
                echo mysqli_error($conn);
        }

?>
<meta http-equiv='refresh' content='0;url=./index.php'>