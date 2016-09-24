
<?php
// error_reporting(0);
ob_start();
include_once ('../../config.php');
include_once ('../../include/init.php');
include_once ('../loginchk.php');

if(isset($_POST['submit'])) {
	$name = $_POST['name'];
	$desc = $_POST['desc'];
	$amount = $_POST['amount'];

	// checking empty fields
	if(empty($name) || empty($desc) || empty($amount)) {

		if(empty($name)) {
			echo "<font color='red'>فیلد نام خالی نمیتواند باشد.</font><br/>";
		}

		if(empty($desc)) {
			echo "<font color='red'>فیلد توضیحات نمیتواند خالی باشد</font><br/>";
		}

		if(empty($amount)) {
			echo "<font color='red'>فیلد قیمت نمیتواند خالی باشد</font><br/>";
		}

		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>برگشت</a>";
	} else {
		// if all the fields are filled (not empty)

		//insert data to database
		$result = mysqli_query($mysqli, "INSERT INTO product(name,`desc`,amount) VALUES('$name','$desc',$amount)");

		//display success message
		echo "<font color='green'>محصول با موفقیت افزوده شمد";
		echo "<br/><a href='index.php'>نماش محصولات</a>";
	}
}else{ ?>
	<div class="col-sm-8" style="float:right;">
		<h3>افزودن محصول</h3>
		<hr>
		<form id="new_product" method="post" class="form" role="form">
			<div class="row">
				<div class="col-xs-6 col-md-6 form-group">
					<input class="form-control" tabindex="4" id="amount" name="amount" placeholder="قیمت محصول" type="number" required />
				</div>
				<div class="col-xs-6 col-md-6 form-group">
					<input class="form-control" tabindex="3" id="name" name="name" placeholder="نام محصول" type="text" required autofocus />
				</div>
			</div>
			<textarea class="form-control" tabindex="5" id="desc" name="desc" placeholder="توضیحات" rows="5"></textarea>
			<br />
			<div class="row">
				<div class="col-xs-12 col-md-12 form-group">
					<button name="submit" class="btn btn-primary pull-right"  value="Add" type="submit">ذخیره</button>
				</div>
			</div>
		</form>
	</div>
	<?php } ?>

	<?php $out_html = ob_get_clean(); include_once ('../dashboard.php');?>
