<?php
error_reporting(E_ALL);
date_default_timezone_set('Asia/Tehran');
$mysqli=mysqli_connect("$database_Host", "$database_User", "$database_Password", "$database_Name") or die ('خطا در اتصال به دیتابیس  ممکن است مشخصات نام کاربری و کلمه رمز را اشتباه وارد کرده باشید : ' . mysql_error());
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
//initiate mysql connection for utf8 support;
mysqli_query($mysqli, "SET NAMES 'utf8'");
/*
if (!function_exists('injection')) {
	function injection($string){
		if(is_array($string)){
			$string	=array_map("injection",$string);
			return $string;
		}
		if(get_magic_quotes_gpc()){
			$string = stripslashes($string);
		}
		echo "<pre>";
		echo $mysqli;
		echo "</pre>";
		$string = mysqli_real_escape_string($mysqli, $string);
		echo "<pre>";
		echo $string;
		echo "</pre>";
		return $string;
	}
	$_POST=array_map("injection",$_POST);
	$_GET=array_map("injection",$_GET);
}	*/
?>