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
$rs_fl=$_SESSION['fl'];
$rs_lg=$_SESSION['lg'];
$qu_wide=$_SESSION['qu'];
$qd_list=mysql_query($qu_wide);

if ($rs_lg=='arabic'){
echo '<table class="table table-striped table-hover table-responsive" style="white-space: nowrap; max-width: none; width: auto;">';
}else{
echo '<table class="table table-striped table-hover table-responsive" dir="ltr" style="white-space: nowrap; max-width: none; width: auto;">';
}
echo '                    
  <thead>
    <tr>';
    
    
    if ($rs_lg=='arabic'){
    echo '<th style="text-align:center; " class="success">ر.م</th>';
    foreach ($rs_fl as &$check_field) {
    $rep_infos=mysql_fetch_array(mysql_query("SELECT * FROM qd_report_dic WHERE db_field='$check_field'"));
        echo '<th style="text-align:center; " class="success"> '.$rep_infos[arabic].' </th>';
    }
    }else{
    echo '<th style="text-align:center; " class="success">No.</th>';
    foreach ($rs_fl as &$check_field) {
    $rep_infos=mysql_fetch_array(mysql_query("SELECT * FROM qd_report_dic WHERE db_field='$check_field'"));
        echo '<th style="text-align:center; " class="success"> '.$rep_infos[english].' </th>';
    }
    }          
   echo' </tr>
  </thead>
  <tbody>';


$i=1;
while($rows=mysql_fetch_array($qd_list)){
    echo '<tr>
    <td style="text-align:center;vertical-align: middle">'.$i.'</td> ';
    if ($rs_lg=='arabic'){
    foreach ($rs_fl as &$check_field) {
        if ($check_field=="store"){
        $ar_info=mysql_fetch_array(mysql_query("SELECT * FROM qd_store WHERE store_en='$rows[$check_field]'"));
        echo '<td style="text-align:center;vertical-align: middle">'.$ar_info[store_ar].'</td> ';
        }elseif ($check_field=="area"){
        $ar_info=mysql_fetch_array(mysql_query("SELECT * FROM qd_areas WHERE area_en='$rows[$check_field]'"));
        echo '<td style="text-align:center;vertical-align: middle">'.$ar_info[area_ar].'</td> ';
        }elseif ($check_field=="city"){
        $ar_info=mysql_fetch_array(mysql_query("SELECT * FROM qd_city WHERE city_en='$rows[$check_field]'"));
        echo '<td style="text-align:center;vertical-align: middle">'.$ar_info[city_ar].'</td> ';
        }elseif ($check_field=="shipment_state_en"){
        $ar_info=mysql_fetch_array(mysql_query("SELECT * FROM qd_state WHERE state_en='$rows[$check_field]'"));
        echo '<td style="text-align:center;vertical-align: middle">'.$ar_info[state_ar].'</td> ';
        }elseif ($check_field=="amount"){
        echo '<td style="text-align:center;vertical-align: middle">'.round($rows[$check_field],3).'</td> ';
        }elseif ($check_field=="service_charge"){
        echo '<td style="text-align:center;vertical-align: middle">'.round($rows[$check_field],3).'</td> ';
        }elseif ($check_field=="total_amount"){
        echo '<td style="text-align:center;vertical-align: middle">'.round($rows[$check_field],3).'</td> ';
        }elseif ($check_field=="locker"){
        echo '<td style="text-align:center;vertical-align: middle; direction: rtl">'.$rows[$check_field].'</td> ';
        }else{
        echo '<td style="text-align:center;vertical-align: middle">'.$rows[$check_field].'</td> ';
        }
    }
    }else{
    foreach ($rs_fl as &$check_field) {
        if ($check_field=="amount"){
        echo '<td style="text-align:center;vertical-align: middle">'.round($rows[$check_field],3).'</td> ';
        }elseif ($check_field=="service_charge"){
        echo '<td style="text-align:center;vertical-align: middle">'.round($rows[$check_field],3).'</td> ';
        }elseif ($check_field=="total_amount"){
        echo '<td style="text-align:center;vertical-align: middle">'.round($rows[$check_field],3).'</td> ';
        }elseif ($check_field=="locker"){
        echo '<td style="text-align:center;vertical-align: middle; direction: rtl">'.$rows[$check_field].'</td> ';
        }else{
        echo '<td style="text-align:center;vertical-align: middle">'.$rows[$check_field].'</td> ';
        }
    }
    }          
    echo' </tr>';
$i++;
}
echo '</tbody>
</table>';						
?>

</body>
</html>