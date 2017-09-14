<?php
//登录验证
session_start();
include('../config.php');

$session_id = $input->session('id');

if( $session_id === false ) {
	header("Location:login.php");
}

$sql ="select * from admin where id='{$session_id}'";
$username_result=$db->query($sql); 
$session_username = $username_result->fetch_array(MYSQLI_ASSOC);
?>