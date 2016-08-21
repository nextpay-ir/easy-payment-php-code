<?php
// Edited By Ali Samiee - shop.kadeh@yahoo.com
include_once './config.php';
include_once './include/init.php';
include_once './include/nextpay_payment.php';
if(!is_numeric($_POST['TxtPrice'])) {
	die("مبلغ پرداختی را به ریال و فقط با اعداد وارد نمائید.");
}
$_POST['TxtPrice']=intval($_POST['TxtPrice']);
$price=$_POST['TxtPrice'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>در حال اتصال ...</title>
	<style type="text/css">
		body{font-family:Arial;font-size:12pt;font-weight:bold;direction:rtl;color:#0079D5;}
		.messageBox{margin:200px auto; width:300px;padding:30px; border:solid 2px #A4CFEF;background-color:#E8F5FF; text-align:center; line-height:2em;}
	</style>
	<?php
	/*$desc = '';
	if ( isset($_POST['TxtTitle']) && $_POST['TxtTitle'] )
		$desc	.= 'عنوان پرداخت : '.$_POST['TxtTitle'].'<br>';
	if ( isset($_POST['TxtName']) && $_POST['TxtName'] )
		$desc	.= 'نام و نام خانوادگی : '.$_POST['TxtName'].'<br>';
	if ( isset($_POST['TxtEmail']) && $_POST['TxtEmail'] )
		$desc	.= 'ایمیل : '.$_POST['TxtEmail'].'<br>';
	if ( isset($_POST['TxtMobile']) && $_POST['TxtMobile'] )
		$desc	.= 'موبایل : '.$_POST['TxtMobile'].'<br>';
	*/
	$parameters = array
	(
		"api_key"=>$api_key,
		"amount"=>$price,
		"callback_uri"=>$site_url.'/back.php'
	);
	try {
		$nextpay = new Nextpay_Payment($parameters);
		//$nextpay->setDefaultVerify(Type_Verify::Http);
		$result = $nextpay->token();
		if(intval($result->code) == -1){
			$mysqli->query("INSERT INTO `order` (`email` ,`tel` ,`name`,`comment` ,`amount` ,`status` ,`ref` ,`date`) VALUES ('{$_POST['TxtEmail']}', '{$_POST['TxtMobile']}','{$_POST['TxtName']}','{$_POST['TxtTitle']}','{$_POST['TxtPrice']}', 'n', '{$result->trans_id}','".time()."');");
			echo mysqli_error();
			$id=mysqli_insert_id($mysqli);
			if($id<=0){echo 'خطا در ایجاد سفارش .';exit;}
			$nextpay->send($result->trans_id);
		} else {
			$data['message'] = ' شماره خطا: '.$result->code.'<br />';
			$data['message'] .='<br>'.$nextpay->code_error(intval($result->code));
			$code=$data['message'];
		}


	}catch (Exception $e) { echo 'Error'. $e->getMessage();  }


	?>
<body>
<?php echo $code; ?>
<?php if(isset($go)){?>
	<div class="messageBox">در حال اتصال به <br />سرور پرداخت الکترونیک <br /></div>
<?php } ?>
</body>
</html>