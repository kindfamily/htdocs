
<?php      
        require("../../config/config.php");
        require("../../lib/db.php");
        $conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);

        $editor = $_POST['editor'];

        $user_id = $_POST['user_id'];
        $title = $_POST['title'];

        
        $file = $_FILES['file'];
        // print_r($file);
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];
        
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'pdf');
        
        if (in_array($fileActualExt, $allowed)){
                if ($fileError === 0){
                if ($fileSize < 5000000){
                        $fileNameNew = uniqid('', true).".".$fileActualExt;
                        $fileDestination = 'img/'.$fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                               
                                $sql = "INSERT INTO ck(title, content, link_img, user_id) VALUES ('$title', '$editor', '$fileNameNew', '$user_id')";


                                $result = mysqli_query($conn, $sql);

                                if($result === false){
                                        echo mysqli_error($conn);
                                }

                       


                        
                        
                //     session_start();
        
                //     $_SESSION['file_name'] = $fileNameNew;
        
                        header("Location: index.php?uploadsuccess");
        
                } else {
                        echo "Your file is too big!";
                }
                } else {
                echo "There was an error uploading your file!";
                }    
        } else{
                echo "You cannot upload filed of this type";
        }


        


?>
<!-- <meta http-equiv='refresh' content='0;url=./index.php'> -->