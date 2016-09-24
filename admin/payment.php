<?php
error_reporting(0);
ob_start();
include ('../config.php');
include_once ('../include/init.php');
include ('loginchk.php');

$res = mysqli_query($mysqli, "SELECT * FROM `order` ORDER BY id DESC LIMIT 500");

function xssafe($data,$encoding='UTF-8')
{
   return htmlspecialchars($data,ENT_QUOTES | ENT_HTML401,$encoding);
}

?>
<div class="col-md-12" style="float:right;">
  <table class="table table-striped table-condensed table-bordered">
    <thead>
      <tr>
        <th>شماره سفارش خرید</th>
        <th>نام و نام خانوادگی </th>
        <th>ایمیل</th>
        <th>تلفن</th>
        <th>عنوان پرداخت</th>
        <th>مبلغ (تومان)</th>
        <th>وضعیت</th>
        <th>کد تراکنش</th>
        <th>تاریخ</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if($res && mysqli_num_rows($res)>0){
        while($row=mysqli_fetch_assoc($res)){
          echo "<tr>";
          echo "<td>". xssafe($row['id']) ."</td>";
          echo "<td>". xssafe($row['name']) ."</td>";
          echo "<td>". xssafe($row['email']) ."</td>";
          echo "<td>". xssafe($row['tel']) . "</td>";
          echo "<td>". xssafe($row['comment']). "</td>";
          echo "<td>". xssafe($row['amount']) ."</td>";
          if($row['status']=='y'){echo "<td style='color:#009933;'><b>موفق</b></td>";}else{echo "<td style='color:#FF0000;'>ناموفق</td>";}
          echo "<td>$row[ref]</td>";
          echo "<td>".date("Y-m-d H:i",$row['date'])."</td>";
          echo "</tr>";
        }
      }else{
        echo 'سفارشی در آسان پرداز شما ثبت نشده است.';
      }
      ?>
    </tbody>
  </table>
</div>

<?php $out_html = ob_get_clean(); include_once ('dashboard.php');?>
