<html xmlns="http://www.w3.org/1999/xhtml"><head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>پنل مدیریت آسان پرداخت</title>
</head>
<meta charset="utf-8" />
<link type="text/css" rel="stylesheet" href="<?php echo $site_url; ?>/static/css/bootstrap.css">
<link type="text/css" rel="stylesheet" href="<?php echo $site_url; ?>/static/css/admin.css">
</head>
<body>

	<nav class="navbar navbar-default navbar-static-top">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header navbar-right">
				<a class="navbar-brand" href="#">مدیرت آسان پرداخت</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-left">
					<li><a href="<?php echo $site_url; ?>admin/logout.php">خروج</a></li>
					<li><a href="<?php echo $site_url; ?>" target="_blank">نمایش سایت</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	<div class="container-fluid main-container">
		<div class="col-md-10 content">
			<?php echo $out_html;?>
		</div>
		<div class="col-md-2 sidebar">
			<div class="row">
				<!-- uncomment code for absolute positioning tweek see top comment in css -->
				<div class="absolute-wrapper"> </div>
				<!-- Menu -->
				<div class="side-menu">
					<nav class="navbar navbar-default" role="navigation">
						<!-- Main Menu -->
						<div class="side-menu-container">
							<ul class="nav navbar-nav navbar-right">
								<li><a href="<?php echo $site_url; ?>admin/payment.php">تراکنش ها</a></li>
								<li><a href="<?php echo $site_url; ?>admin/products/">محصولات</a></li>
								<!-- <li><a href="#">Link</a></li> -->
							</ul>
						</div><!-- /.navbar-collapse -->
					</nav>

				</div>
			</div>
		</div>

		<footer class="pull-left footer">
			<p class="col-md-12">
				<hr class="divider">
				Copyright &COPY; 2015 <a href="http://www.nextpay.ir">Nextpay</a>
			</p>
		</footer>
	</div>
	<script type="text/javascript" src="<?php echo $site_url; ?>/static/js/bootstrap.js"></script><!-- Bootstrap Js -->
	<script type="text/javascript" src="<?php echo $site_url; ?>/static/js/jquery-1.11.1.min.js"></script>

	</body>
</html>
