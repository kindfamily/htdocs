<?php
session_start();


if(isset($_SESSION['file_name'])){
    $file_name = $_SESSION['file_name'];
};
?>


<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <form action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="file">
        <button type="submit" name="submit">UPLOAD</button>
    </form>


    <?php
        echo $file_name;
    ?>
</body>
</html>
