<?php
// error_reporting(0);
ob_start();
include (__DIR__.'/../../config.php');
include_once (__DIR__.'/../../include/init.php');
include (__DIR__.'/../loginchk.php');

//getting id of the data from url
$id = $_GET['id'];

//deleting the row from table
$result = mysqli_query($mysqli, "DELETE FROM product WHERE id=$id");

//redirecting to the display page (index.php in our case)
header("Location:index.php");
?>
