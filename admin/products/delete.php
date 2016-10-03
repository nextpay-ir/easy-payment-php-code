<?php
// error_reporting(0);
ob_start();
include (dirname(__FILE__).'/../../config.php');
include_once (dirname(__FILE__).'/../../include/init.php');
include (dirname(__FILE__).'/../loginchk.php');

//getting id of the data from url
$id = $_GET['id'];

//deleting the row from table
$result = mysqli_query($mysqli, "DELETE FROM product WHERE id=$id");

//redirecting to the display page (index.php in our case)
header("Location:index.php");
?>
