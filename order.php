<?php
include_once dirname(__FILE__).'/config.php';
include_once dirname(__FILE__).'/include/init.php';
include_once dirname(__FILE__).'/include/nextpay_payment.php';

// validate inputs
if(isset($_POST['product']) && $_POST['product'] != '-1'){
	if(!is_numeric($_POST['product'])) {
		die("محصول انتخاب معتبر نمیباشد");
		echo "<br/><a href='javascript:self.history.back();'>برگشت</a>";
	}else {
		$product = mysqli_query($mysqli, "SELECT * FROM `product` WHERE id = {$_POST['product']}") or die("محصول انتخاب معتبر نمیباشد") ;
		$product = mysqli_fetch_object($product);
		$price=intval($product->amount);
	}
}else {
	if(!is_numeric($_POST['TxtPrice'])) {
		die("مبلغ پرداختی را به ریال و فقط با اعداد وارد نمائید.");
		echo "<br/><a href='javascript:self.history.back();'>برگشت</a>";
	}else {
		$_POST['TxtPrice']=intval($_POST['TxtPrice']);
		$price=$_POST['TxtPrice'];
	}
}

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
	
try {
	$mysqli->query("INSERT INTO `order` (`email` ,`tel` ,`name`,`comment` ,`amount` ,`status` ,`ref` ,`date`) VALUES ('{$_POST['TxtEmail']}', '{$_POST['TxtMobile']}','{$_POST['TxtName']}','{$_POST['TxtTitle']}','{$price}', 'n', '','".time()."');");
	echo mysqli_error($mysqli);
	$order_id=mysqli_insert_id($mysqli);
	if($order_id<=0){echo 'خطا در ایجاد سفارش .';exit;}
	
	$parameters = array
	(
	"api_key"=>$api_key,
	"order_id"=> $order_id,
	"amount"=>$price,
	"callback_uri"=>$site_url.'back.php');
	
	$nextpay = new Nextpay_Payment($parameters);
	//$nextpay->setDefaultVerify(Type_Verify::Http);
	$result = $nextpay->token();
	if(intval($result->code) == -1){
		
		$mysqli->query("update `order` set `ref`='{$result->trans_id}' where `id`='$order_id' limit 1");
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
