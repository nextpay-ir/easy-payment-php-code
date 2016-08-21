<?php
header('Content-Type: text/html; charset=utf-8');
include_once "./config.php";
include_once "./include/init.php";
include_once './include/nextpay_payment.php';
function message_exit($message) {
    include './include/back.html';
    exit();
}
$trans_id = isset($_POST['trans_id'])?$_POST['trans_id'] : false ;

if (!$trans_id) {
    message_exit('خطا در انجام عملیات بانکی ، شناسه تراکنش موجود نمی باشد');
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
    'trans_id' 	=> $trans_id,
    'amount'	=> $price,
);
try {
    $nextpay = new Nextpay_Payment();
    $result = intval($nextpay->verify_request($parameters));
    if( $result < 0 ) {
        message_exit('خطا در عملیات بانکی پرداخت تائید نگردید.');
    } elseif ($result==0) {
        $mysqli->query("update `order` set `status`='y',`ref`='$trans_id' where `id`='$res_num' limit 1");
        $msg="<p align='center'><font color='#1B7B71'><b>عملیات خرید با موفقیت به پایان رسید</b></font></p> مشخصات پرداخت شما:<br>کد پیگیری سفارش: $trans_id <br> مبلغ پرداختی: $price ریال <br> از خرید شما متشکریم<br>";
        message_exit($msg);
    }
}catch (Exception $e) { echo 'Error'. $e->getMessage();  }

?>