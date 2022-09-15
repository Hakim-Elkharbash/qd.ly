<?
ob_start();
//error_reporting(0);
session_start();
if(!isset($_SESSION['st'])){
//echo '<script> window.location.replace("http://www.dm.ly/login.php#form"); </script>';
header("location:login.php");
}

include("db.php");
//------------------------------------------------------------------------------------------ General information
$site_information=mysql_fetch_assoc(mysql_query("SELECT * FROM setting WHERE id='1'"));
$lang="ar";
//-------------------------
$time_zone=$site_information[zone_time];
date_default_timezone_set($time_zone);
$dat=date('d/m/Y');
$tim=date('H:i:s');
//-------------------------------

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<meta name="viewport" content="width=device-width,initial-scale=1" />
<meta content="<? echo $site_information[keywords_ar],' ',$site_information[keywords_en]; ?>" name="keywords">
<meta content="<? echo $site_information[description_ar],' ',$site_information[description_en]; ?>" name="description">
<?
$page_url=basename($_SERVER['PHP_SELF']);
//--------------------------------- Check User Premissions
$qd_user_prem=mysql_fetch_array(mysql_query("SELECT * FROM page_titles WHERE page_link='$page_url'"));
$premissions_access=$_SESSION['pre_acc'];
if (!in_array($qd_user_prem[user_access], $premissions_access)){ 
header("location:members.php");
}
//------------------------------------------------------
$page_titles=mysql_fetch_assoc(mysql_query("SELECT * FROM page_titles WHERE page_link='$page_url' AND page_languge='$lang'"));
echo "<title>".$page_titles[page_title]."</title>";
echo "<link rel='shortcut icon' href='".$site_information[website_icon]."'>";
?>
<link  rel="stylesheet" type="text/css" href="css/ar.css">

<!-- يجب ان توضع هنا عند استخدام نموذج التحقق -->    
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="dialog/bootbox.min.js"></script>
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.2.0-rc2/css/bootstrap-rtl.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<!-- Bootstrap Validations -->    
<script src="validation/bootstrapValidator.min.js"></script>
<link rel="stylesheet" href="validation/bootstrapValidator.min.css">





<script type="text/javascript">
function top_page(obj) {
$('html, body').animate({ scrollTop: 0 }, 'slow');
}
</script>

    
   

</head>

<body>
<?
$qu_wide=$_SESSION['qu'];
$qd_list=mysql_query($qu_wide);
 

echo '                    
<table class="table table-striped table-hover table-responsive" style="white-space: nowrap; max-width: none; width: auto;">
  <thead>
    <tr>
<th style="text-align:center; " class="success">ر.م</th>
      <th style="text-align:center; " class="success">بوليصة الشحن & الباران</th>
      <th style="text-align:center; " class="success">كود المندوب</th>
      <th style="text-align:center; " class="success">السعر</th>
      <th style="text-align:center; " class="success">سعر الخدمة</th>
      <th style="text-align:center; " class="success">اجمالي المبلغ</th>
      <th style="text-align:center; " class="success">المنطقة</th>
      <th style="text-align:center; " class="success">المدينة</th>
      <th style="text-align:center; " class="success">اسم المستلم</th>
      <th style="text-align:center; " class="success">SHIPMENT STATUS</th>
      <th style="text-align:center; " class="success">حالة الشحنة</th>
      <th style="text-align:center; " class="success">تاريخ معاملة حالة الشحنة</th>
      <th style="text-align:center; " class="success">تاريخ موعد التسليم</th>
      <th style="text-align:center; " class="success">ارسال الباران</th>
      <th style="text-align:center; " class="success">عدد الطرود</th>
      <th style="text-align:center; " class="success">رقم الطرد</th>
      <th style="text-align:center; " class="success">نوع الخدمة</th>
      <th style="text-align:center; " class="success">اخطار الاول</th>
      <th style="text-align:center; " class="success">اخطار الثاني</th>
      <th style="text-align:center; " class="success">ملاحظات</th>    </tr>
  </thead>
  <tbody>';

$i=1;
while($rows=mysql_fetch_array($qd_list)){
    echo '<tr>
      <td style="text-align:center;vertical-align: middle">'.$i.'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[way_bill].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[code].'</td>
      <td style="text-align:center;vertical-align: middle">'.round($rows[amount],3).'</td>
      <td style="text-align:center;vertical-align: middle">'.round($rows[service_charge],3).'</td>
      <td style="text-align:center;vertical-align: middle">'.round($rows[total_amount],3).'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[area].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[city].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[consignee_name].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[shipment_state_en].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[shipment_state_ar].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[shipment_date].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[delivered_date].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[alb_update].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[total_pkgs].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[pkg_no].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[service_type].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[first_notice_date].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[second_notice_date].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[comment].'</td>
      </tr>';
$i++;
}
echo '</tbody>
</table>';
?>

</body>
</html>