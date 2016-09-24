<?php
// error_reporting(0);
ob_start();
include (__DIR__.'/../../config.php');
include_once (__DIR__.'/../../include/init.php');
include (__DIR__.'/../loginchk.php');


if(isset($_POST['update']))
{
	$id = $_POST['id'];

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

	} else {
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE product SET name='$name',`desc`='$desc',amount=$amount WHERE id=$id");

		//redirectig to the display page. In our case, it is index.php
		header("Location: index.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM product WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$name = $res['name'];
	$desc = $res['desc'];
	$amount = $res['amount'];
}
?>


<div class="col-sm-8" style="float:right;">
	<h3>ویرایش محصول</h3>
	<hr>
	<form id="new_product" method="post" class="form" role="form">
		<div class="row">
			<div class="col-xs-6 col-md-6 form-group">
				<input class="form-control" id="amount" name="amount" placeholder="قیمت محصول" type="number" value=<?php echo $amount;?> required />
			</div>
			<div class="col-xs-6 col-md-6 form-group">
				<input class="form-control" id="name" name="name" placeholder="نام محصول" type="text" value=<?php echo $name;?> required autofocus />
			</div>
		</div>
		<textarea class="form-control" id="desc" name="desc" placeholder="توضیحات" rows="5"><?php echo $desc;?></textarea>
		<br />
		<div class="row">
			<div class="col-xs-12 col-md-12 form-group">
				<input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
				<button name="update" class="btn btn-primary pull-right"  value="Update" type="submit">به روزرسانی</button>
			</div>
		</div>
	</form>
</div>


<?php $out_html = ob_get_clean(); include_once (__DIR__.'/../dashboard.php');?>
