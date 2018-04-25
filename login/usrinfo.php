<?php

  $token = "AAAAOqfk5vpOV69BCRDRe1orLTHvxiVHxfit++ubjsi4b+TfSG9YiPb69zhXOA7FevBFsV44t718JuLT2V887GJIskY=";
  $header = "Bearer ".$token; // Bearer 다음에 공백 추가
  $url = "https://openapi.naver.com/v1/nid/me";
  $is_post = false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = array();
  $headers[] = "Authorization: ".$header;
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  echo "status_code:".$status_code."<br>";
  curl_close ($ch);
  if($status_code == 200) {
    echo $response;
    echo $_SESSION['access_token'];
  } else {
    echo "Error 내용:".$response;
  }
?>
