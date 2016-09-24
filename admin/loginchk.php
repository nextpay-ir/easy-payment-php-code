<?php
// error_reporting(0);
include_once (__DIR__.'/../config.php');
include_once (__DIR__.'/../include/init.php');
session_start();
global $admin_user,$admin_pass;
if($_SESSION['Isloggedin']==false){
	header("Location: index.php");exit;
}else{
	if ($_SESSION["ASuser"]!=$admin_user or $_SESSION["ASpass"]!=$admin_pass){
		session_destroy();header("Location: index.php?err=1");exit;
	}
}
?>
