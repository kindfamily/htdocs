<?php
require("../../config/session.php");
require("../../config/config.php");
require("../../lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

if($_POST) {    
        $q = $_POST['searchword'];    
        $sql = "SELECT * FROM items WHERE title LIKE '$q%' LIMIT 5";
        $result = mysqli_query($conn,$sql);
        
        if($result === false){
            echo mysqli_error($conn);
            exit;
        }

    while($row = mysqli_fetch_assoc($result)) {
        $title=$row['title'];
        $price=$row['price'];
        $fileName=$row['fileName2'];

        $sql2 = "SELECT * FROM items WHERE fileName2 = '$fileName'";
        $result2 = mysqli_query($conn,$sql);
        $row2 = mysqli_fetch_assoc($result2);
        $itemsNum = $row['id'];
        $itemsType = $row['type'];

        if ($itemsType === 'it'){
            echo "
            <div class='display_box' id='key'> 
                <h5><b>$title</b></h5><img src='../../img/littlebits/$fileName' width='50' class='boximage'/><br/><br/>$price
                
                <input type='hidden' id='item_num' name='item_num' value='$itemsNum'>
                <p>클릭하면 고정됩니다</p>
                </div>                
            ";
        }elseif ($itemsType === 'pl') {
            echo "
            <div class='display_box' id='key'> 
                <h5><b>$title</b></h5><img src='../../img/platform/$fileName' width='50' class='boximage'/><br/><br/>$price
                
                <input type='hidden' id='item_num' name='item_num' value='$itemsNum'>
                <p>클릭하면 고정됩니다</p>
                </div>                
            ";
        }
    }
}
?>