<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>پنل مدیریت آسان پرداخت</title>
	<link type="text/css" rel="stylesheet" href="../static/css/login.css">
</head>
<?php
error_reporting(0);
ob_start();
session_start();

if ($_SESSION['Isloggedin'] == true){
		header("Location: payment.php");
}else {
	session_destroy();
}
?>

<div class="login">
	<h1>ورود به پنل کاربری</h1>
    <form method="post" action="login.php">
			<?php if($_GET['err']==1){?><h4 style="text-align:center;color:red;">نام کاربری یا کلمه رمز اشتباه است</h4><?php }?>
    	<input type="text" name="username" placeholder="نام کاربری" required="required" />
        <input type="password" name="password" placeholder="کلمه عبور" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large">ورود</button>
    </form>
</div>
