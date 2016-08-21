<?php 
error_reporting(0);
date_default_timezone_set('Asia/Tehran');
header('Content-Type: text/html; charset=utf-8');

//database information
$database_Name = 'nextpay';//نام دیتابیس
$database_User = 'root';//نام کاربری دیتابیس
$database_Password = '';//کلمه رمز دیتابیس
$database_Host = 'localhost';

//admin username & password
$admin_user = 'admin';//نام کاربری بخش مدیریت
$admin_pass= '123456';//کلمه رمز بخش مدیریت


//site url without / at end of address
$site_url='http://localhost/easy-payment-php-code';//آدرس محل نصب بدون / دراخر نوشته شود
$api_key='1cf9d861-c817-468b-809b-2595625902ac';// شناسه درگاه درپنل کاربری بخش درگاه این شناسه ذکر شده است
?>