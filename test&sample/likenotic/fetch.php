<?php

if(isset($_POST["view"]))
{
include("connect.php");


//알림창을 눌렀을 때 0 을 1로 변경 0:안봄 , 1: 봄
if($_POST["view"]!='')
{
$update_query = "update comments set comment_status =1 where comment_status=0";
mysqli_query($connect , $update_query);
}


// 최근글 5개만 가져오기
$query = "select * from comments order by comment_id desc limit 1000";
$result = mysqli_query($connect, $query);
$output ='';

if(mysqli_num_rows($result) > 0)
{
while($row = mysqli_fetch_array($result))
{
$output .= '
<li>
<a herf="#">
<strong>'.$row["comment_subject"].'</strong><br>
<small><em>'.$row["comment_text"].'</em></small>
</a>
</li>
';
}


}else
{
$output .= '
<li><a herf="#" class="text-bold text-italic">알림이 없습니다.</a></li>
';

}


//안본글 만 가져와서 숫자 표시해주기
$query_1 = "select * from comments where comment_status = 0";
$result_1 = mysqli_query($connect, $query_1);
$count = mysqli_num_rows($result_1);
$data = array(
'notification' => $output,
'unseen_notification' => $count

);

echo json_encode($data);
}

?>