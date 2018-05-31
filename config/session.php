<?php

session_start();

$timeout = 1 ; // Set timeout minutes 
$logout_redirect_url = "index.php" ; // Set logout URL 
$timeout = $timeout * 3600 ; // Converts minutes to seconds 
if (isset( $_SESSION [ 'start_time' ])) { 
	$elapsed_time = time () - $_SESSION [ 'start_time' ]; 
	if ( $elapsed_time >= $timeout ) { 
		session_destroy (); 
		header ( "Location: $logout_redirect_url" ); 
	} 
} 
$_SESSION [ 'start_time' ] = time (); 

if(isset($_SESSION['user_id']))
{
	$user_id = $_SESSION['user_id'];
}

if(isset($_SESSION['user_name']))
{
$user_name = $_SESSION['user_name'];
}

$user_type='';
if(isset($_SESSION['user_type']))
{
	$user_type = $_SESSION['user_type'];
}else{
	$user_type = $user_type."";
}

?>