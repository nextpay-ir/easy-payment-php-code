<?php
include_once (dirname(__FILE__).'/config.php');
include_once (dirname(__FILE__).'/include/init.php');

$result = mysqli_query($mysqli, "SELECT * FROM `product`");

?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="script" content="http://www.nextpay.ir" />
	<meta name="copyright" content="FreezeMan - freezeman.0098@gmail.com" />
	<title>آسان پرداخت نکست پی</title>

	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<link type="text/css" rel="stylesheet" href="static/css/bootstrap.css">
	<link type="text/css" rel="stylesheet" href="static/css/order-form.css">
	<link type="text/css" rel="stylesheet" href="static/css/style.css">

</head>

<body dir="rtl">

	<!-- Preloader Area Start
	====================================================== -->
	<div id="mask">
			<div id="loader">
			</div>
	</div>
	<!-- =================================================
	Preloader Area End -->





	<section class="order-main" id="order-now">

		<h2 class="animated fadeInUp visible" data-animation="fadeInUp" data-animation-delay="200" style="color: white;">پرداخت آنلاین</h2>
		<div class="medium-txt animated fadeInUp visible" data-animation="fadeInUp" data-animation-delay="400">خرید و پراخت وجه</div>

		<!-- Start: Order Form -->
		<form action="order.php" method="post" id="order_frm">
			<div class="order-form">
				<div class="container text-center">

					<!-- Order Form Categories Start -->
					<div class="order-catogories clearfix">

						<!-- Order section Start -->
						<div class="col-md-8 clearfix">
							<div class="row">

								<div class="col-md-12">
									<!-- Additional Options Start -->
									<div class="addi-opts" id="add_options">
										<h6>انتخاب محصول</h6>
										<?php
										echo "<select class='first-field' style='width:50%' id='products' name='product'>";
										echo "<option value='-1' selected>محصول نامشخص (ورود مبلغ توسط مشتری)</option>";
										while ($row = mysqli_fetch_array($result))
										{
											echo "<option value='{$row['id']}' amount = '{$row['amount']}' desc = '{$row['desc']}'";
											echo ">{$row['name']}</option>";
										}
										echo "</select>";
										?>
										<input class="second-field" name="TxtPrice" placeholder="مبلغ پرداختی (تومان)" type="text"></br></br>
									</div>
									<!-- Additional Options End -->

									<!-- Form Start -->
									<div class="submit-opts-form clearfix">
										<h6>اطلاعات پرداخت کننده</h6>
										<div class="controls" id="error_order" style="color:red;"></div>
										<div class="clearfix">
											<input placeholder="نام و نام خانوادکی" name="TxtName" class="first-field" type="text">
											<input placeholder="ایمیل" name="TxtEmail" class="second-field" type="text">
											<input placeholder="موبایل" name="TxtMobile" class="third-field" type="text">
											<textarea cols="10" rows="5" name="TxtTitle" placeholder="توضیحات پرداخت" class="forth-field"></textarea>
										</div>
									</div>
									<!-- Form End -->
								</div>
							</div>
						</div>
						<!-- Order Section End -->

						<!-- Order Summary Start -->
						<div class="col-md-4 clearfix" id="order_summary_box">
							<div class="summary-box">
								<div class="heading-total">مجموع: <span class="color-txt" id="order_total">0</span>تومان</div>
								<!-- Package Features Start -->
								<div class="summary-basic-pack" id="summary-pack">
									<h5>مراحل پرداخت</h5>
									<ul class="pack-in">
										<li><span><i>1: </i></span> انتقال به بانک</li>
										<li><span><i>2: </i></span> پرداخت وجه</li>
										<li><span><i>3: </i></span> بازگشت به اینجا</li>
										<li><span><i>4: </i></span> دریافت کد پیگیری</li>
									</ul>
								</div>
								<!-- Package Features End -->
								<!-- Main order button area Start -->
								<div class="orderbtn-area">
									<p><img src="img/pay-img.jpg" alt=""></p>
									<p>با کلیک بر روی دکمه پرداخت شما تمامی <br><a target="_blank" href="#">قوانین و  سیاست های</a> این سایت را قبول میکنید</p>
									<div class="order-btn-cont"><a href="#" class="button" id="order_btn_id">پرداخت</a></div>
								</div>
								<!-- Main order button area end -->
							</div>
						</div>
						<!-- Order Summary End -->

					</div>
					<!-- Order Form Categories End -->
				</div>
			</div>
		</form>
		<!-- Start: Order Form -->

	</section>

	<p style="text-align: center;color:white;">قدرت گرفته از سامانه پرداخت الکترونیک <a href="http://www.nextpay.ir" target="_blank">نکست پی</a></p>

	<script type="text/javascript" src="static/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="static/js/bootstrap.js"></script>

	<script type="text/javascript" src="static/js/orderform.js"></script>

	<script type="text/javascript" src="static/js/jquery.appear.js"></script>
	<script type="text/javascript" src="static/js/settings.js"></script>
</body>
</html>
