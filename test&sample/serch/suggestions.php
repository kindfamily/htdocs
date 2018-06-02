<?php
require("../../config/session.php");
require("../../config/config.php");
require("../../lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

    if($_POST) {    
        $q=$_POST['searchword'];    

        $sql = "SELECT * FROM items WHERE title LIKE '$q%' LIMIT 5";
        $result = mysqli_query($conn,$sql);
        
        if($result === false){
            echo mysqli_error($conn);
            exit;
        }
    
        while($row = mysqli_fetch_assoc($result)) {
            $title=$row['title'];
            $price=$row['price'];
            $fileName=$row['fileName'];
            
            echo "
                <li class='display_box' id='key'> 
                    <img src='../../img/littlebits/$fileName' width='50' class='boximage'/><b>$title</b><br/><br/>$price$
                    
                    <input type='hidden' id='title' name='title' value='$title'>
                    <input type='hidden' id='price' name='price' value='$price'>
                    <input type='hidden' id='fileName' name='fileName' value='$fileName'>
                </li>                
            ";
        }
    }
?>

