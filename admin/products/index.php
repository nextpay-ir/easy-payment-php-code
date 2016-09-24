<?php
// error_reporting(0);
ob_start();
include_once ('../../config.php');
include_once ('../../include/init.php');
include_once ('../loginchk.php');

$res = mysqli_query($mysqli, "SELECT * FROM `product` ORDER BY id DESC");

?>

<div class="col-md-12" style="float:right;">
	<a class="btn btn-primary" href="add.php">افزودن محصول جدید</a><br/><br/>

	<table class="table table-striped table-condensed table-bordered">

		<tr bgcolor='#CCCCCC'>
			<td>نام محصول</td>
			<td>قیمت</td>
			<td>توضیحات</td>
			<td>به روز رسانی</td>
		</tr>
		<?php
		if($res && mysqli_num_rows($res)>0){
			while($row = mysqli_fetch_array($res)) {
				echo "<tr>";
				echo "<td>".$row['name']."</td>";
				echo "<td>".$row['amount']."</td>";
				echo "<td>".$row['desc']."</td>";
				echo "<td><a href=\"edit.php?id=$row[id]\">ویرایش</a> | <a href=\"delete.php?id=$row[id]\" onClick=\"return confirm('حذف شود ؟')\">حذف</a></td>";
			}
		}
		?>
	</table>
</div>
<?php $out_html = ob_get_clean(); include_once ('../dashboard.php');?>
