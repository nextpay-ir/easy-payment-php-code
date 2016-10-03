<?php
error_reporting(1);
header('Content-Type: text/html; charset=utf-8');
include_once dirname(__FILE__).'/config.php';
include_once dirname(__FILE__).'/include/init.php';
include_once dirname(__FILE__).'/include/nextpay_payment.php';
function message_exit($message) {
    include dirname(__FILE__).'/include/back.html';
    exit();
}

$trans_id = isset($_POST['trans_id']) ? $_POST['trans_id'] : false ;
$order_id = isset($_POST['order_id']) ? $_POST['order_id'] : false ;

if (!$trans_id) {
    message_exit('خطا در انجام عملیات بانکی ، شناسه تراکنش موجود نمی باشد');
}

if (!is_string($trans_id) || (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $trans_id) !== 1)) {
    message_exit('تراکنش ارسال شده معتبر نمیباشد');
}

$result_trans=$mysqli->query("SELECT `amount` FROM `order` WHERE `ref` = '$trans_id'");
if(mysqli_num_rows($result_trans)>0){
    list($price)=mysqli_fetch_array($result_trans);
}else{
    message_exit('سفارش در سایت موجود نمی باشد.');
}

$parameters = array
(
    'api_key'	=> $api_key,
    'order_id'	=> $order_id,
    'trans_id' 	=> $trans_id,
    'amount'	=> $price,
);
try {
    $nextpay = new Nextpay_Payment();
    
    $result = $nextpay->verify_request($parameters);
    if( $result < 0 ) {
        message_exit('خطا در عملیات بانکی پرداخت تائید نگردید.');
    } elseif ($result==0) {
        $mysqli->query("update `order` set `status`='y' where `ref`='$trans_id' limit 1");
        $msg="<p align='center'><font color='#1B7B71'><b>عملیات خرید با موفقیت به پایان رسید</b></font></p> مشخصات پرداخت شما:<br>کد پیگیری سفارش: $trans_id <br> مبلغ پرداختی: $price ریال <br> از خرید شما متشکریم<br>";
        message_exit($msg);
    }else{
	message_exit('خطا در عملیات بانکی پرداخت تائید نگردید.');
    }
}catch (Exception $e) { echo 'Error'. $e->getMessage();  }

?>
