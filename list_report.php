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

    
    
<script type="text/javascript">
var flg=true;
$(document).on("click","#search_op",function(){
if (flg){
$("#search_area").slideUp('slow');
flg=false;
}else{
$("#search_area").slideDown('slow');
flg=true;
}
});

</script>     

    
    
    
    
<script type="text/javascript">
checked = false;
function checkedAll () {
if (checked == false){checked = true}else{checked = false}
for (var i = 0; i < document.getElementById('qd-form').elements.length; i++) {
document.getElementById('qd-form').elements[i].checked = checked;
}
document.getElementById("view_all_id").checked = false;
}
</script>
    
    

</head>

<body>

<!-- 
Starting the user interface..
-->

    <!-- Navbar -->
  	<nav class="navbar navbar-inverse navbar-fixed-top " id="my-navbar">
  		<div class="container ">
  			<div class="navbar-header">
  				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
  					<span class="icon-bar"></span>
  					<span class="icon-bar"></span>
  					<span class="icon-bar"></span>
  				</button>
                
                <a href="logout.php" class="btn btn-success btn-md navbar-btn pull-left">
                    تسجيل خروج&nbsp;
                <span class="glyphicon glyphicon-log-out"></span>
                </a> 
          </div><!-- Navbar Header-->
  			<div class="collapse navbar-collapse" id="navbar-collapse">
   				<ul class="nav navbar-nav navbar-right top-links">
                    <li><a href="members.php"> لـوحة التحكم</a>
                    <li><a href="index.php">الصفحة الرئيسية</a>
  		        </ul>
  			</div>
  		</div><!-- End Container-->
  	</nav><!-- End navbar -->
 

    
    
<div style="height:75px">
   
     
</div>
  
<?
$user_id=$_SESSION['st'];
$qd_list=mysql_fetch_array(mysql_query("SELECT * FROM sys_users_lp WHERE username='$user_id'"));
$state_fg=false;
$store_fg=false;
$area_fg=false;
$city_fg=false;
?>   
    
    <div class="container">
        <div class="text-center">
            <div class="panel panel-default col-lg-10 col-lg-offset-1" style="padding-bottom:20px !important">
               <div class="panel-heading" style="background-color: burlywood !important">
                   <a class="btn navbar-btn btn-info pull-left" id="search_op" title="إخفاء / إظهار خيارات البحث"> <i class="fa fa-search"></i></a>
                   <h4 style="text-align:right;"> <i class="fa  fa-md"></i> إنشاء التقارير.. </h4>

                </div>
                <div class="panel-body ">              
             
                    
                    
                <div id="search_area">
                    <form action="" method="post" class="form-horizontal" id="qd-form" name="qd-form-nm">
                        
                       <div class="well well-lg">
                        <div class="form-group">
                            <div class="col-sm-3">
                            <label for="inputName1" class="pull-right control-label fields-name"> بوليصة الشحن </label>
                            <input type="text" name="way_bill" class="form-control input-lg" id="inputName1"  placeholder="بوليصة الشحن أو الباران" style="text-align: left; direction: ltr">
                
                            </div>
                            
                            <div class="col-sm-3">
                            <label for="inputName1" class="pull-right control-label fields-name"> كود المشرف </label>
                            <input type="text" name="shipper_code" class="form-control input-lg" id="inputName1"  placeholder="كود المشرف" style="text-align: left; direction: ltr">
                            </div>
                            
                            <div class="col-sm-3">
                            <label for="inputName1" class="pull-right control-label fields-name"> كود المندوب </label>
                            <input type="text" name="code" class="form-control input-lg" id="inputName1"  placeholder="كود المندوب" style="text-align: left; direction: ltr">
                            </div> 
                            
                            <div class="col-sm-3">
                            <label for="inputName1" class="pull-right control-label fields-name">  رقم الطلبية </label>
                            <input type="text" name="order_no" class="form-control input-lg" id="inputName1"  placeholder="رقم الطلبية" style="text-align: left; direction: ltr">
                
                            </div> 
                            
                            
                            <div class="col-sm-3">
                            <label for="inputName1" class="pull-right control-label fields-name"> حالة الطلبية </label>
                            <select name="orlist" class="form-control input-lg">
                              <?
                                echo "<option value='all'> كل الحالات </option>";
                               $permissions_stt= explode(" ",$qd_list[access_status]);
                               $qd_list_stt=mysql_query("SELECT * FROM qd_state");
                                $state_query='';
                                while($rows=mysql_fetch_array($qd_list_stt)){
                                  if (in_array($rows[id], $permissions_stt)){ 
                                    echo "<option value='".$rows[state_en]."'>".$rows[state_ar]." (".$rows[state_en].")</option>";
                                    $state_query=$state_query." shipment_state_en = '$rows[state_en]'"." || ";
                                    $state_fg=true;
                                  }
                                }
                              ?>
                            </select>                
                            </div>
                            
                            <div class="col-sm-3">
                            <label for="inputName1" class="pull-right control-label fields-name">  تحديد المخزن </label>
                            <select name="stlist" class="form-control input-lg">
                              <?
                                echo "<option value='all'> كل المخازن </option>";
                               $permissions_st= explode(" ",$qd_list[access_stores]);
                               $qd_list_st=mysql_query("SELECT * FROM qd_store");
                                $store_query='';
                                while($rows=mysql_fetch_array($qd_list_st)){
                                    if (in_array($rows[id], $permissions_st)){ 
                                        echo "<option value='".$rows[store_en]."'>".$rows[store_ar]." (".$rows[store_en].")</option>";
                                        $store_query=$store_query." store = '$rows[store_en]'"." || ";
                                        $store_fg=true;
                                    }
                                }
                              ?>
                            </select> 
                            </div>
                            
                            <div class="col-sm-3">
                            <label for="inputName1" class="pull-right control-label fields-name">  تحديد المنطقة </label>
                            <select name="arlist" class="form-control input-lg">
                              <?
                                echo "<option value='all'> كل المناطق </option>";
                               $permissions_ar= explode(" ",$qd_list[access_areas]);
                               $qd_list_ar=mysql_query("SELECT * FROM qd_areas");
                                $area_query='';
                                while($rows=mysql_fetch_array($qd_list_ar)){
                                  if (in_array($rows[id], $permissions_ar)){ 
                                    echo "<option value='".$rows[area_en]."'>".$rows[area_ar]." (".$rows[area_en].")</option>";
                                    $area_query=$area_query." area = '$rows[area_en]'"." || ";
                                    $area_fg=true;
                                  }
                                }
                              ?>
                            </select> 
                            </div>
                            
                            <div class="col-sm-3">
                            <label for="inputName1" class="pull-right control-label fields-name"> تحديد المدينة </label>
                            <select name="ctlist" class="form-control input-lg">
                              <?
                                echo "<option value='all'>  كل المدن </option>";
                               $permissions_ct= explode(" ",$qd_list[access_city]);
                               $qd_list_ct=mysql_query("SELECT * FROM qd_city");
                                $city_query='';
                                while($rows=mysql_fetch_array($qd_list_ct)){
                                  if (in_array($rows[id], $permissions_ct)){ 
                                    echo "<option value='".$rows[city_en]."'>".$rows[city_ar]." (".$rows[city_en].")</option>";
                                    $city_query=$city_query." city = '$rows[city_en]'"." || ";
                                    $city_fg=true;
                                  }
                                }
                              ?>
                            </select>                
                            </div>  
                            
                            <div class="col-sm-3">
                            <label for="inputName1" class="pull-right control-label fields-name"> حالة الباران </label>
                            <select name="albupdate" class="form-control input-lg">
                                <option value="all">  كل الحالات </option>
                                <option value="SENT">SENT</option>
                                <option value="NOT SENT">NOT SENT</option>
                            </select>                
                            </div>
                            
                            
                            <div class="col-sm-3">
                            <label for="inputName1" class="pull-right control-label fields-name"> نوع الخدمة </label>
                            <select name="servicetype" class="form-control input-lg">
                                <option value="all">  كل الحالات </option>
                                 <option value="COD">COD</option>
                                 <option value="MAIL">MAIL</option>
                            </select>                
                            </div>
                            
                            
                            <div class="col-sm-3">
                            <label for="inputName1" class="pull-right control-label fields-name"> تسديد القيمة من </label>
                            <select name="paymentby" class="form-control input-lg">
                                <option value="all">  كل الحالات </option>
                                 <option value="Consignee">المستلم (Consignee)</option>
                                 <option value="Shipper">المرسل (Shipper)</option>
                            </select>                
                            </div>
                            
                            
                            <div class="col-sm-3">
                            <label for="inputName1" class="pull-right control-label fields-name"> ارسال المبلغ </label>
                            <select name="moneytransferred" class="form-control input-lg">
                            <option value="all">  كل الحالات </option>
                            <option value="تم الارسال">تم الارسال</option>
                            <option value="لم يتم الارسال">لم يتم الارسال</option>
                            </select>   
                            </div>
                            
                            
                            <div class="col-sm-3">
                            <label for="inputName1" class="pull-right control-label fields-name">  تسليم قيمة الشحنة للمرسل </label>
                            <select name="moneyreturned" class="form-control input-lg">
                            <option value="all">  كل الحالات </option>
                            <option value="تم التسليم">تم التسليم</option>
                            <option value="لم يتم التسليم">لم يتم التسليم</option>
                            </select>   
                            </div>
                            
                            
                            
                            
                        </div>
                        
                    </div>
                    
                        
                        
                <div class="well well-lg">
                    <div class="form-group">
                            <div class="col-sm-12">
                               <span class="pull-left"><input name="checkall" type="checkbox" onclick="checkedAll();">  تحديد الكل  </span>
                            </div>
                    <?           
                    $qd_list_sr=mysql_query("SELECT * FROM `qd_report_dic` WHERE `show`<>'no'");
echo mysql_error();
                        while($rows1=mysql_fetch_array($qd_list_sr)){
                                echo '
                                <div class="col-sm-4">
                                <label for="checkfields'.$rows1[id].'" class="pull-right control-label fields-name">';
                                if (($rows1[db_field]=='way_bill')||($rows1[db_field]=='store')||($rows1[db_field]=='shipment_state_en')){
                                    echo '<input checked name="checkedfields['.$rows1[db_field].']" value="'.$rows1[db_field].'" type="checkbox" id="checkfields'.$rows1[id].'"> '.$rows1[arabic];
                                }else{
                                    echo '<input name="checkedfields['.$rows1[db_field].']" value="'.$rows1[db_field].'" type="checkbox" id="checkfields'.$rows1[id].'">   '.$rows1[arabic];
                                
                                }
                               echo' </label>
                            </div>'; 
                        }
                    
                    ?>
                    </div>
                </div>
                    
                        
                        
                        
                        
                <div class="well well-lg">
                <hr>
                        <div class="form-group">
                        <div class="col-sm-4 pull-right">
                            <select name="rep_languge" class="form-control input-lg">
                                  <option value='arabic'>اللغة العربية (Arabic Interface)</option>
                              <option value='english'>اللغة الإنجليزية (English Interface)</option>
                            </select>
                        </div>
                            
                        <div class="col-sm-8 pull-right">

                        <?
                        $permissions_all= explode(" ",$qd_list[access_services]);
                        if (in_array('17', $permissions_all)){
                        $all_flag=true;
                        }

                        $permissions_all= explode(" ",$qd_list[access_services]);
                        if (in_array('21', $permissions_all)){
                        $xls_flag=true;
                        }


                            if (($store_fg && $state_fg && $area_fg && $city_fg)||($all_flag)){
                                echo '<button name="login_utton" type="submit" class="btn btn-primary btn-lg"> البحث وفقاً للشروط </button>';
                            }else{
                                echo '<button name="login_utton" type="submit" class="btn btn-primary btn-lg" disabled="disabled"> البحث وفقاً للشروط </button>';
                            }

                            if ($all_flag){
                            echo '<div class="checkbox-inline">
                               <label for="view_all_id"> Unlimited Access  </label>
                                <input type="checkbox" value="all" name="view_all" id="view_all_id">
                            </div>';
                            }
                        ?>
                          
                        </div>
                      </div>
                </div>
                        
                </form>          
            </div>
<div style="overflow-x: scroll;" <? if (($_POST['rep_languge']=='english')||($_SESSION['lg']=='english')) echo 'dir="ltr"'; ?>>                   
<?

//----------- pagination
$sr_no=$site_information[rows];



if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    
echo "
<script type=\"text/javascript\">
$('#search_area').slideUp('slow');
flg=false;
</script>
";
    
    
$checkedfields=$_POST['checkedfields'];
$rep_languge=$_POST['rep_languge'];

//------------------------------select colums
$check_fields='';
foreach ($checkedfields as &$check_field) {
$check_fields_st = $check_fields_st." ".$check_field.", ";
}
$check_fields=substr($check_fields_st, 0, -2);
unset($_SESSION[qu]);
unset($_SESSION[fl]);
unset($_SESSION[lg]);
unset($_SESSION[xls_file_se]);
$pp=0;
if ($view_all=$_POST['view_all']<>'all'){
$way_bill=$_POST['way_bill'];
$shipper_code=$_POST['shipper_code'];
$code=$_POST['code'];
$order_no=$_POST['order_no'];
$orlist=$_POST['orlist'];
$stlist=$_POST['stlist'];
$arlist=$_POST['arlist'];
$ctlist=$_POST['ctlist'];
$albupdate=$_POST['albupdate'];
$servicetype=$_POST['servicetype'];
$paymentby=$_POST['paymentby'];
$moneytransferred=$_POST['moneytransferred'];
$moneyreturned=$_POST['moneyreturned'];
    
    
$where_flag=false;
if ($way_bill==''){
$way_bill='';
}else{
$where_flag=true;
$way_bill=" (way_bill = '$way_bill')"." && ";
} 

if ($shipper_code==''){
$shipper_code='';
}else{
$where_flag=true;
$shipper_code=" (shipper_code = '$shipper_code')"." && ";
} 
    
if ($code==''){
$code='';
}else{
$where_flag=true;
$code=" (code = '$code')"." && ";
} 

    
if ($order_no==''){
$order_no='';
}else{
$where_flag=true;
$order_no=" (order_no = '$order_no')"." && ";
} 

    
if ($orlist=='all'){
$state_query=substr($state_query, 0, -3); 
$orlist="(".$state_query.") &&";
$where_flag=true;
}else{
$where_flag=true;
$orlist=" shipment_state_en = '$orlist'"." && ";
} 

    
if ($stlist=='all'){
$store_query=substr($store_query, 0, -3); 
$stlist="(".$store_query.") &&";
$where_flag=true;
}else{
$where_flag=true;
$stlist=" store = '$stlist'"." && ";
} 

    
if ($arlist=='all'){   
$area_query=substr($area_query, 0, -3); 
$arlist="(".$area_query.") &&";
$where_flag=true;
}else{
$where_flag=true;
$arlist=" area = '$arlist'"." && ";
} 

    
if ($ctlist=='all'){   
$city_query=substr($city_query, 0, -3); 
$ctlist="(".$city_query.") &&";
$where_flag=true;
}else{
$where_flag=true;
$ctlist=" city = '$ctlist'"." && ";
} 
    
    
if ($albupdate=='all'){
$albupdate='';
}else{
$where_flag=true;
$albupdate=" (alb_update = '$albupdate')"." && ";
}

    
if ($servicetype=='all'){
$servicetype='';
}else{
$where_flag=true;
$servicetype=" (service_type = '$servicetype')"." && ";
}

    
if ($paymentby=='all'){
$paymentby='';
}else{
$where_flag=true;
$paymentby=" (payment_by = '$paymentby')"." && ";
}

    
if ($moneytransferred=='all'){
$moneytransferred='';
}else{
$where_flag=true;
$moneytransferred=" (money_transferred = '$moneytransferred')"." && ";
}

   
if ($moneyreturned=='all'){
$moneyreturned='';
}else{
$where_flag=true;
$moneyreturned=" (money_returned_shipper = '$moneyreturned')"." && ";
}

    
if ($where_flag==true){ 
$string=$way_bill.$shipper_code.$code.$order_no.$orlist.$stlist.$arlist.$ctlist.$albupdate.$servicetype.$paymentby.$moneytransferred.$moneyreturned;
$st_qu=substr($string, 0, -3);
$st_qu_all="SELECT ".$check_fields." FROM qd_orders WHERE ".$st_qu;
$st_qu_lm="SELECT ".$check_fields." FROM qd_orders WHERE ".$st_qu." LIMIT $pp,$sr_no";
}else{
$st_qu_all="SELECT ".$check_fields." FROM qd_orders";
$st_qu_lm="SELECT ".$check_fields." FROM qd_orders LIMIT $pp,$sr_no";
}
    
    
}else{
    
echo '<div class="alert alert-danger" role="alert"  style="font-size: 16px; font-weight: bold; text-align: right">
 ملاحظة: الوصول للبيانات غير محدد بشروط، تم جلب كل البيانات المتوفرة في قاعدة البيانات
</div>';
    
$st_qu_all="SELECT ".$check_fields." FROM qd_orders";
$st_qu_lm="SELECT ".$check_fields." FROM qd_orders LIMIT $pp,$sr_no";
}
    
    
$_SESSION['qu']=$st_qu_all;
$_SESSION['fl']=$checkedfields;
$_SESSION['lg']=$rep_languge;
$qd_list=mysql_query($st_qu_lm);
   // echo $st_qu_all;

if (mysql_numrows($qd_list) > 0){
if ($rep_languge=='arabic'){
echo '
<a href="list_report_wide_view.php" target="_blank" class="btn btn-warning navbar-btn btn-sm pull-left">
                                    <span class="fa fa-eye"></span>

                    &nbsp;عرض  البيانات في صفحة منفصلة 
                </a> ';
if ($xls_flag){
echo '
<a href="list_report_xls.php" class="btn btn-success navbar-btn btn-sm pull-left" style="margin-left: 5px; margin-right:5px">
                                    <span class="fa fa-file-excel-o"></span>

                    &nbsp;تحميل كملف Excel 
                </a>';
}

}else{
echo '
<a href="list_report_wide_view.php" target="_blank" class="btn btn-warning navbar-btn btn-sm pull-right">
                                    <span class="fa fa-eye"></span>

                    &nbsp;عرض  البيانات في صفحة منفصلة 
                </a>';
if ($xls_flag){
echo '
<a href="list_report_xls.php" class="btn btn-success navbar-btn btn-sm pull-right">
                                    <span class="fa fa-eye"></span>

                    &nbsp;تحميل كملف Excel 
                </a> ';
}

}
}

echo '                    
<table class="table table-striped table-hover table-responsive" style="white-space: nowrap; max-width: none; width: auto;">
  <thead>
    <tr>';
    
    $row_xls=0;
    $col_xls=0;
    if ($rep_languge=='arabic'){
    echo '<th style="text-align:center; " class="success">ر.م</th>';
    foreach ($checkedfields as &$check_field) {
    $rep_infos=mysql_fetch_array(mysql_query("SELECT * FROM qd_report_dic WHERE db_field='$check_field'"));
        echo '<th style="text-align:center; " class="success"> '.$rep_infos[arabic].' </th>';
        $xls_file[$row_xls][$col_xls]=$rep_infos[arabic];
        $col_xls++;
    }
    }else{
    echo '<th style="text-align:center; " class="success">No.</th>';
    foreach ($checkedfields as &$check_field) {
    $rep_infos=mysql_fetch_array(mysql_query("SELECT * FROM qd_report_dic WHERE db_field='$check_field'"));
        echo '<th style="text-align:center; " class="success"> '.$rep_infos[english].' </th>';
        $xls_file[$row_xls][$col_xls]=$rep_infos[english];
        $col_xls++;
    }
    }          
   echo'</tr>
  </thead>
  <tbody>';

    

if (mysql_numrows($qd_list) > 0){
$i=1;
//------------------------------ Excel File
$qd_list_xls=mysql_query($st_qu_all);
while($rows_xls=mysql_fetch_array($qd_list_xls)){
    $row_xls++;
    $col_xls=0;
    if ($rep_languge=='arabic'){
    foreach ($checkedfields as &$check_field_xls) {
        if ($check_field_xls=="store"){
        $ar_info=mysql_fetch_array(mysql_query("SELECT * FROM qd_store WHERE store_en='$rows_xls[$check_field_xls]'"));
        $xls_file[$row_xls][$col_xls]=$ar_info[store_ar];
        $col_xls++;
        }elseif ($check_field_xls=="area"){
        $ar_info=mysql_fetch_array(mysql_query("SELECT * FROM qd_areas WHERE area_en='$rows_xls[$check_field_xls]'"));
        $xls_file[$row_xls][$col_xls]=$ar_info[area_ar];
        $col_xls++;
        }elseif ($check_field_xls=="city"){
        $ar_info=mysql_fetch_array(mysql_query("SELECT * FROM qd_city WHERE city_en='$rows_xls[$check_field_xls]'"));
        $xls_file[$row_xls][$col_xls]=$ar_info[city_ar];
        $col_xls++;
        }elseif ($check_field_xls=="shipment_state_en"){
        $ar_info=mysql_fetch_array(mysql_query("SELECT * FROM qd_state WHERE state_en='$rows_xls[$check_field_xls]'"));
        $xls_file[$row_xls][$col_xls]=$ar_info[state_ar];
        $col_xls++;
        }elseif ($check_field_xls=="amount"){
        $xls_file[$row_xls][$col_xls]=round($rows_xls[$check_field_xls],3);
        $col_xls++;
        }elseif ($check_field_xls=="service_charge"){
        $xls_file[$row_xls][$col_xls]=round($rows_xls[$check_field_xls],3);
        $col_xls++;
        }elseif ($check_field_xls=="total_amount"){
        $xls_file[$row_xls][$col_xls]=round($rows_xls[$check_field_xls],3);
        $col_xls++;
        }elseif ($check_field_xls=="locker"){
        $xls_file[$row_xls][$col_xls]=$rows_xls[$check_field_xls];
        $col_xls++;
        }else{
        $xls_file[$row_xls][$col_xls]=$rows_xls[$check_field_xls];
        $col_xls++;
        }
    }
    }else{
    foreach ($checkedfields as &$check_field_xls) {
        if ($check_field_xls=="amount"){
        $xls_file[$row_xls][$col_xls]=round($rows_xls[$check_field_xls],3);
        $col_xls++;
        }elseif ($check_field_xls=="service_charge"){
        $xls_file[$row_xls][$col_xls]=round($rows_xls[$check_field_xls],3);
        $col_xls++;
        }elseif ($check_field_xls=="total_amount"){
        $xls_file[$row_xls][$col_xls]=round($rows_xls[$check_field_xls],3);
        $col_xls++;
        }elseif ($check_field_xls=="locker"){
        $xls_file[$row_xls][$col_xls]=$rows_xls[$check_field_xls];
        $col_xls++;
        }else{
        $xls_file[$row_xls][$col_xls]=$rows_xls[$check_field_xls];
        $col_xls++;
        }
    }
    }          
   
}
 
$_SESSION['xls_file_se']=$xls_file;
    
//print_r($xls_file);

//-----------------------------------------
    
    
while($rows=mysql_fetch_array($qd_list)){
    echo '<tr>
    <td style="text-align:center;vertical-align: middle">'.$i.'</td> ';
    if ($rep_languge=='arabic'){
    foreach ($checkedfields as &$check_field) {
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
    foreach ($checkedfields as &$check_field) {
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

}else{
echo '<tr>
		<td colspan="20" style="text-align:right">
			 &nbsp;&nbsp;<span style=" font-size:15px; color: red; font-weight:bold;">لم يتم الحصول على أي نتائج..</span>&nbsp;&nbsp;
			 </td>
	</tr>';
}
echo '</tbody>
</table>';						
    
if (mysql_numrows($qd_list) > 0){
if ($rep_languge=='arabic'){
echo '
<a href="list_report_wide_view.php" target="_blank" class="btn btn-warning navbar-btn btn-sm pull-left">
                                    <span class="fa fa-eye"></span>

                    &nbsp;عرض  البيانات في صفحة منفصلة 
                </a> ';
if ($xls_flag){
echo '
<a href="list_report_xls.php" class="btn btn-success navbar-btn btn-sm pull-left" style="margin-left: 5px; margin-right:5px">
                                    <span class="fa fa-file-excel-o"></span>

                    &nbsp;تحميل كملف Excel 
                </a>';
}

}else{
echo '
<a href="list_report_wide_view.php" target="_blank" class="btn btn-warning navbar-btn btn-sm pull-right">
                                    <span class="fa fa-eye"></span>

                    &nbsp;عرض  البيانات في صفحة منفصلة 
                </a>';
if ($xls_flag){
echo '
<a href="list_report_xls.php" class="btn btn-success navbar-btn btn-sm pull-right">
                                    <span class="fa fa-eye"></span>

                    &nbsp;تحميل كملف Excel 
                </a> ';
}

}
}
    
}







if((isset($_SESSION['qu']))&&(($_SERVER['REQUEST_METHOD'] <> 'POST'))){
    
echo "
<script type=\"text/javascript\">
$('#search_area').slideUp('slow');
flg=false;
</script>
";
    
    
$pp=$_GET['page'];
if ($pp=='' || $pp=='1'){
$pp=0;
}else{
$pp=($pp*$sr_no)-$sr_no;
}
$rs_qur=$_SESSION['qu'];
$rs_fl=$_SESSION['fl'];
$rs_lg=$_SESSION['lg'];
$rs_qur=$rs_qur." LIMIT $pp,$sr_no ";
$qd_list=mysql_query($rs_qur);
    
if (mysql_numrows($qd_list) > 0){
if ($rs_lg=='arabic'){
echo '
<a href="list_report_wide_view.php" target="_blank" class="btn btn-warning navbar-btn btn-sm pull-left">
                                    <span class="fa fa-eye"></span>

                    &nbsp;عرض  البيانات في صفحة منفصلة 
                </a> ';
if ($xls_flag){
echo '
<a href="list_report_xls.php" class="btn btn-success navbar-btn btn-sm pull-left" style="margin-left: 5px; margin-right:5px">
                                    <span class="fa fa-file-excel-o"></span>

                    &nbsp;تحميل كملف Excel 
                </a>';
}

}else{
echo '
<a href="list_report_wide_view.php" target="_blank" class="btn btn-warning navbar-btn btn-sm pull-right">
                                    <span class="fa fa-eye"></span>

                    &nbsp;عرض  البيانات في صفحة منفصلة 
                </a>';
if ($xls_flag){
echo '
<a href="list_report_xls.php" class="btn btn-success navbar-btn btn-sm pull-right">
                                    <span class="fa fa-eye"></span>

                    &nbsp;تحميل كملف Excel 
                </a> ';
}

}}
    
echo '                    
<table class="table table-striped table-hover table-responsive" style="white-space: nowrap; max-width: none; width: auto;">
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


if (mysql_numrows($qd_list) > 0){
$i=$pp+1;
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

}else{
echo '<tr>
		<td colspan="20" style="text-align:right">
			 &nbsp;&nbsp;<span style=" font-size:15px; color: red; font-weight:bold;">لم يتم الحصول على أي نتائج..</span>&nbsp;&nbsp;
			 </td>
	</tr>';
}
echo '</tbody>
</table>';						
}






//------ pagiantion
if(!isset($_SESSION['qu'])){
$qd_list=mysql_query($st_qu_all);
}else{
$qd_list=mysql_query($_SESSION['qu']);
}
if((isset($_SESSION['qu']))||(($_SERVER['REQUEST_METHOD'] == 'POST'))){
$pags=ceil(mysql_numrows($qd_list)/$site_information[rows]);
}
if ($pags>1){
echo '<nav class="text-center">
  <ul class="pagination">';
    //<li>
      //<a href="#" aria-label="Previous">
       // <span aria-hidden="true">&laquo;</span>
      //</a>
    //</li>
    if (($rep_languge=='english')||($_SESSION['lg']=='english')){
    for ($i=$pags;$i>=1;$i--){
    echo '<li><a href="?page='.$i.'">'.$i.'</a></li>';
    }
    }else{
    for ($i=1;$i<=$pags;$i++){
    echo '<li><a href="?page='.$i.'">'.$i.'</a></li>';    
    }
    }
    //<li>
      //<a href="#" aria-label="Next">
        //<span aria-hidden="true">&raquo;</span>
      //</a>
    //</li>
    echo '
  </ul>
</nav>';
}
?>   
                    
    </div>
                </div>
            </div>  
        </div>          
    </div> 
   

        
        
        
    
    
    <div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container">
            <p class="navbar-text pull-left devoloed">Developed By:&nbsp;<a  href="http://www.libyapages.net/" target="_blank" class="libyapages">LIBYAPAGES</a></p>
        <p class="navbar-text pull-right copyright"><? echo $site_information[copyright_ar]; ?></p>
            
        <!--    <a class="btn navbar-btn btn-default pull-right btn-sm">شروط تقديم الخدمة</a>  -->
        </div>
    </div>
        
        
      
       
        
        
        
        
</body>

</html>
