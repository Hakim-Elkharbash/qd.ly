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
            <div class="panel panel-info col-lg-8 col-lg-offset-2" style="padding-bottom:20px !important; padding-top:30px !important;">
                <div class="panel-body ">      
<?
//---------- for log details
$user_id=$_SESSION['st'];
$user_infos=mysql_fetch_array(mysql_query("SELECT * FROM sys_users_lp WHERE username='$user_id'"));
//---------- end first part of log

$uploaded_file = $_FILES['fname']['tmp_name'];
$allowed =  array('xls','xlsx');
$filename = $_FILES['fname']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);
if(in_array($ext,$allowed) ) {

require_once '/home/qdly/public_html/PHPExcel/Classes/PHPExcel.php';
require_once '/home/qdly/public_html/PHPExcel/Classes/PHPExcel/IOFactory.php';

try {
	$objPHPExcel = PHPExcel_IOFactory::load($uploaded_file);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}
     
if ($objPHPExcel->setActiveSheetIndex(0)->getHighestColumn()=="AM"){
$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);  
//print_r($allDataInSheet);
$arrayCount = count($allDataInSheet);
    
//----------------------- way_bill items
$qd_list_st=mysql_query("SELECT * FROM qd_orders");
while($rows=mysql_fetch_array($qd_list_st)){  
$way_bill_ar[]=$rows[way_bill];
}  
//----------------------------------------
    
$corr_yes=0;
$corr_no=0;
$wrong=0;
for($i=2;$i<=$arrayCount;$i++){
$way_bill = trim($allDataInSheet[$i]["A"]);
$locker = trim($allDataInSheet[$i]["G"]);

    
$result = mysql_query("UPDATE qd_orders SET locker='$locker' WHERE way_bill='$way_bill'");

if ($result){
if (in_array($way_bill, $way_bill_ar)){ 

//---------- for log details - second part
$order_id=$way_bill;
$data_time=date('d/m/Y H:i:s');;
$operation="تغيير ترقيم الارفف - إستراد";
$details=$locker;
$user_info=$user_infos[fullname];
$result = mysql_query("INSERT INTO qd_log(order_id,data_time,operation,details,user_info) VALUES ('$order_id','$data_time','$operation','$details','$user_info')");
//--------------- end log

$corr_yes++;
}else{
$corr_no++;
}
}else{
//echo mysql_error();
$wrong++;
}
}

$arrayCount_r=$arrayCount-1;

    //$date_tm=date("Y-m-d", strtotime($shipment_date));
//echo "***".$date_tm."***";
    
echo '<div  style="font-size:20px; font-weight: bold; padding-bottom:20px">';
if ($arrayCount_r==$corr_yes){
echo '<span class="fa fa-check fa-3x"></span>  
لقد تم تغيير ترقيم الأرفف ('.$corr_yes.') طلبية بنجاح (كل الطلبيات) وذلك من أصل ('.$arrayCount_r.') طلبية.
</div> '; 
}elseif ($corr_yes==0){
echo '<span class="fa fa-times fa-3x"></span>  
لم يتم تغيير ترقيم الأرفف إي طلبية من أصل ('.$arrayCount_r.') طلبية، السبب: قد تكون هذه الطلبية غير مضافة أصلاَ.
</div> '; 
//echo mysql_error();
}else{
echo '<span class="fa fa-info fa-3x"></span>  
لقد تم تغيير ترقيم الأرفف ('.$corr_yes.') طلبية فقط من أصل ('.$arrayCount_r.') طلبية، السبب: قد يكون جزء من هذه الطلبية غير مضافة أصلاَ.
</div> '; 
}

echo '
<a href="members.php" class="btn btn-info btn-md navbar-btn btn-lg">
                                    <span class="fa fa-tasks"></span>

                    &nbsp;إذهب  للوحة التحكم
                </a> 
';


/* 
if ($wrong>0){
echo '<div  style="font-size:20px; font-weight: bold; padding-bottom:20px">
<span class="fa fa-times fa-3x"></span>
حدث خطأ في إستراد ('.$wrong.') طلبية من أجمالي كل الطلبيات...
</div> ';   
 } 
*/

}else{

echo '<div  style="font-size:20px; font-weight: bold; padding-bottom:20px">
<span class="fa fa-times fa-3x"></span>
الملف الذي تحاول إستراده لا يوافق القالب الخاص بعملية إستراد الملفات...
</div> '; 

 echo '
<a href="javascript:history.back()" class="btn btn-info btn-md navbar-btn btn-lg">
                                    <span class="fa fa-chevron-left fa-rotate-180"></span>

                    &nbsp;إعادة المحاولة                </a> 
';
    
}

    
/*
echo "<table><tr><th>Title</th><th>Price</th><th>Number</th></tr>";
foreach($allDataInSheet as $v){
    echo "<tr>";
    foreach($v as $vv){
        echo "<td>{$vv}</td>";
    }
    echo "<tr>";
}
echo "</table>";
*/

    
    
    
    
}else{

echo '<div  style="font-size:20px; font-weight: bold; padding-bottom:20px">
<span class="fa fa-times fa-3x"></span>
حدث خطأ بسبب نوع املف، يجب ان يكون نوع الملف  xls و xlsx فقط....
</div> '; 

 echo '
<a href="javascript:history.back()" class="btn btn-info btn-md navbar-btn btn-lg">
                                    <span class="fa fa-chevron-left fa-rotate-180"></span>

                    &nbsp;إعادة المحاولة                </a> 
';
    
}

/*
$city_id=$_POST['arlist'];
$store_en=$_POST['ename'];
$store_ar=$_POST['aname'];

$result = mysql_query("INSERT INTO qd_store(city_id,store_en,store_ar) VALUES ('$city_id','$store_en','$store_ar')");
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
}*/

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