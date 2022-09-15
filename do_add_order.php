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

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.2.0-rc2/css/bootstrap-rtl.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">




<script type="text/javascript">
function top_page(obj) {
$('html, body').animate({ scrollTop: 0 }, 'slow');
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
                    <li><a href="members.php"> لـوحة التحم</a>
                    <li><a href="index.php">الصفحة الرئيسية</a>
  		        </ul>
  			</div>
  		</div><!-- End Container-->
  	</nav><!-- End navbar -->
 

    
    
<div style="height:125px">
   
</div>
  
    <div class="container">
        <div class="text-center">
            <div class="panel panel-info col-lg-10 col-lg-offset-1" style="padding-bottom:20px !important; padding-top:30px !important;">
                <div class="panel-body ">  
<?   
$user_id=$_SESSION['st'];
$qd_list=mysql_fetch_array(mysql_query("SELECT * FROM sys_users_lp WHERE username='$user_id'"));                      
$permissions_all= explode(" ",$qd_list[access_services]);
if (in_array('21', $permissions_all)){
    $xls_flag=true;
}
unset($_SESSION[xls_file_se]);
$row_xls=0;

//---------- for log details
$user_id=$_SESSION['st'];
$user_infos=mysql_fetch_array(mysql_query("SELECT * FROM sys_users_lp WHERE username='$user_id'"));
//---------- end first part of log

$qdtex1=$_POST['qdtex1'];
$qdtex2=$_POST['qdtex2'];
$qdtex3=$_POST['qdtex3'];
$qdtex4=$_POST['qdtex4'];
$qdtex5=$_POST['qdtex5'];
$qdtex6=$_POST['qdtex6'];
$qdtex7=$_POST['qdtex7'];
$qdtex8=$_POST['qdtex8'];
$qdtex9=$_POST['qdtex9'];
$qdtex10=$_POST['qdtex10'];
$qdtex11=$_POST['qdtex11'];
$qdtex12=$_POST['qdtex12'];
$qdtex13=$_POST['qdtex13'];
$qdtex14=$_POST['qdtex14'];
$qdtex15=$_POST['qdtex15'];
$qdtex16=$_POST['qdtex16'];
$qdtex17=$_POST['qdtex17'];
$qdtex18=$_POST['qdtex18'];
$qdtex19=$_POST['qdtex19'];
$qdtex20=$_POST['qdtex20'];
//--------------Arabic
$rows_st=mysql_fetch_array(mysql_query("SELECT * FROM qd_state WHERE state_en='$qdtex20'"));
$qdtex20_1=$rows_st[state_ar];

$qdtex21=$_POST['qdtex21'];
$qdtex22=$_POST['qdtex22'];
$qdtex23=$_POST['qdtex23'];
$qdtex24=$_POST['qdtex24'];
$qdtex25=$_POST['qdtex25'];
$qdtex26=$_POST['qdtex26'];
$qdtex27=$_POST['qdtex27'];
$qdtex28=$_POST['qdtex28'];
$qdtex29=$_POST['qdtex29'];
$qdtex30=$_POST['qdtex30'];
$qdtex31=$_POST['qdtex31'];
$qdtex32=$_POST['qdtex32'];
$qdtex33=$_POST['qdtex33'];
$qdtex34=$_POST['qdtex34'];
$qdtex35=$_POST['qdtex35'];
$qdtex36=$_POST['qdtex36'];
$qdtex37=$_POST['qdtex37'];
$qdtex38=$_POST['qdtex38'];
$qdtex39=$_POST['qdtex39'];
$qdtex40=$_POST['qdtex40'];
$qdtex41=$_POST['qdtex41'];

//--------------------Export to Excel
$xls_file[$row_xls][0]='رقم بوليصة الشحن / البارن';
$xls_file[$row_xls][1]=$qdtex4;
$xls_file[$row_xls][2]='نوع الخدمة';
$xls_file[$row_xls][3]=$qdtex27;
$row_xls++;
$xls_file[$row_xls][0]='السعر';
$xls_file[$row_xls][1]=$qdtex6;
$xls_file[$row_xls][2]='سعر الخدمة';
$xls_file[$row_xls][3]=$qdtex7;
$row_xls++;
$xls_file[$row_xls][0]='إجمالي المبلغ';
$xls_file[$row_xls][1]=$qdtex8;
$xls_file[$row_xls][2]='تسديد القيمة من';
$xls_file[$row_xls][3]=$qdtex9;
$row_xls++;
$xls_file[$row_xls][0]='اسم المستلم';
$xls_file[$row_xls][1]=$qdtex14;
$xls_file[$row_xls][2]='رقم هاتف المستلم';
$xls_file[$row_xls][3]=$qdtex15;
$row_xls++;
$xls_file[$row_xls][0]='عنوان المستلم';
$xls_file[$row_xls][1]=$qdtex13;
$xls_file[$row_xls][2]='كود المندوب';
$xls_file[$row_xls][3]=$qdtex5;
$row_xls++;
$xls_file[$row_xls][0]='المنطقة';
$xls_file[$row_xls][1]=$qdtex11;
$xls_file[$row_xls][2]='ايميل او الكنية على الفيس للمستلم';
$xls_file[$row_xls][3]=$qdtex19;
$row_xls++;
$xls_file[$row_xls][0]='اسم المرسل';
$xls_file[$row_xls][1]=$qdtex16;
$xls_file[$row_xls][2]='المدينة';
$xls_file[$row_xls][3]=$qdtex12;
$row_xls++;
$xls_file[$row_xls][0]='كود المشرف';
$xls_file[$row_xls][1]=$qdtex17;
$xls_file[$row_xls][2]='رقم هاتف المرسل';
$xls_file[$row_xls][3]=$qdtex18;
$row_xls++;
$xls_file[$row_xls][0]='تجديد المخزن';
$xls_file[$row_xls][1]=$qdtex2;
$xls_file[$row_xls][2]='رقم الطلبية';
$xls_file[$row_xls][3]=$qdtex1;
$row_xls++;
$xls_file[$row_xls][0]='Shipment State حالة الشحن';
$xls_file[$row_xls][1]=$qdtex20;
$xls_file[$row_xls][2]='نوعية السلعة';
$xls_file[$row_xls][3]=$qdtex26;
$row_xls++;
$xls_file[$row_xls][0]='إدخل التاريخ';
$xls_file[$row_xls][1]=$qdtex3;
$xls_file[$row_xls][2]='تاريخ موعد التسليم';
$xls_file[$row_xls][3]=$qdtex22;
$row_xls++;
$xls_file[$row_xls][0]='عدد الطرود';
$xls_file[$row_xls][1]=$qdtex24;
$xls_file[$row_xls][2]='الوزن';
$xls_file[$row_xls][3]=$qdtex33;
$row_xls++;
$xls_file[$row_xls][0]='الطول';
$xls_file[$row_xls][1]=$qdtex34;
$xls_file[$row_xls][2]='العرض';
$xls_file[$row_xls][3]=$qdtex35;
$row_xls++;
$xls_file[$row_xls][0]='الارتفاع';
$xls_file[$row_xls][1]=$qdtex36;
$xls_file[$row_xls][2]='ملاحظات';
$xls_file[$row_xls][3]=$qdtex41;

$_SESSION['xls_file_se']=$xls_file;
//-----------------------------------

$result = mysql_query("INSERT INTO qd_orders(order_no,store,import_date,way_bill,code,amount,service_charge,total_amount,payment_by,locker,area,city,consignee_address,consignee_name,consignee_phone,shipper_name,shipper_code,shipper_phone,facebook_email,shipment_state_en,shipment_state_ar,shipment_date,delivered_date,alb_update,total_pkgs,pkg_no,commodity,service_type,first_notice_date,second_notice_date,money_transferred,money_returned_shipper,date_retunred_shipper,weigh,length,width,height,qd1,qd2,qd3,qd4,comment) VALUES ('$qdtex1','$qdtex2','$qdtex3','$qdtex4','$qdtex5','$qdtex6','$qdtex7','$qdtex8','$qdtex9','$qdtex10','$qdtex11','$qdtex12','$qdtex13','$qdtex14','$qdtex15','$qdtex16','$qdtex17','$qdtex18','$qdtex19','$qdtex20','$qdtex20_1','$qdtex21','$qdtex22','$qdtex23','$qdtex24','$qdtex25','$qdtex26','$qdtex27','$qdtex28','$qdtex29','$qdtex30','$qdtex31','$qdtex32','$qdtex33','$qdtex34','$qdtex35','$qdtex36','$qdtex37','$qdtex38','$qdtex39','$qdtex40','$qdtex41')");

if ($result){
echo '<div  style="font-size:20px; font-weight: bold; padding-bottom:20px">
<span class="fa fa-check fa-3x"></span>
لقد تم إضافة البيانات بنجاح...
</div> '; 

    echo '
<a href="members.php" class="btn btn-info btn-md navbar-btn btn-lg">
                                    <span class="fa fa-tasks"></span>

                    &nbsp;إذهب  للوحة التحكم
                </a> 
';
    
echo '  
<a href="add_order.php" class="btn btn-warning btn-md navbar-btn btn-lg">
                                    <span class="fa fa-chevron-left fa-rotate-180"></span>

                    &nbsp;إضافة طلبية جديدة
                </a> 
';

if ($xls_flag){
echo '  
<a href="list_report_xls.php" class="btn btn-success btn-md navbar-btn btn-lg">
                                    <span class="fa fa-file-excel-o"></span>

                    &nbsp;تحميل كملف Excel
                </a> 
';
}
    
echo '  
<a href="print_new_order.php" target="_blank" class="btn btn-warning btn-md navbar-btn btn-lg">
                                    <span class="fa fa-print"></span>

                    &nbsp;طباعة
                </a> 
';

 
    
//---------- for log details - second part
$order_id=$qdtex4;
$data_time=date('d/m/Y H:i:s');;
$operation="إدخال طلبية جديدة";
$details="يدوي";
$user_info=$user_infos[fullname];
$result = mysql_query("INSERT INTO qd_log(order_id,data_time,operation,details,user_info) VALUES ('$order_id','$data_time','$operation','$details','$user_info')");
//--------------- end log   
    
    
    
}else{

echo '<div  style="font-size:20px; font-weight: bold; padding-bottom:20px">
<span class="fa fa-times fa-3x"></span>
حدث خطأ في عملية الإضافة، قد تكون هذه البيانات مضافة سابقا...
</div> '; 

 echo '
<a href="javascript:history.back()" class="btn btn-info btn-md navbar-btn btn-lg">
                                    <span class="fa fa-chevron-left fa-rotate-180"></span>

                    &nbsp;إعادة المحاولة                </a> 
';    
}
?>
                
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

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
