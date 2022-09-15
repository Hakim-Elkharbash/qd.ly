<?
ob_start();
//error_reporting(0);
session_start();
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

function decryptIt( $q ) {
    $cryptKey  = '0k8gwV8RBljhx2cxYMWVnhsUig+S9/p6JA1g';
    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    return( $qDecoded );
}

$eml=mysql_real_escape_string(strval($_POST["email"]));
$result = mysql_query("SELECT * FROM sys_users_lp WHERE username = '$eml'");
if (mysql_numrows($result) > 0){
$row=mysql_fetch_assoc($result);
$d_pass = decryptIt($row['password']);

//-------------------- إرسال بريد الكتروني
$dat_tim=date('d/m/Y  H:i:s');

$to=$eml;
$subject="إستعادة كلمة المرور QDelivery";


$message = '

<html  class="main" >
<head>
<title>موقع QDelivery - ليبيا</title>
<style type="text/css">
.main{
 direction:rtl;
 text-align:right;
}
.style1 {
	font-size:16px;
	font-weight: bold;
	font-family:"Simplified Arabic";
	direction:rtl;
	text-align:right;
}

.style2 {
	font-size:15px;
	font-weight: bold;
	font-family:"Simplified Arabic";
	direction:rtl;
	text-align:right;

}
.style3 {
	font-size:18px;
	font-weight: bold;
	font-family:"Simplified Arabic";
	text-align:center;
	direction:rtl;
	text-align:right;

}


</style>
</head>
<body class="main">
<img src="http://qd.ly/images/email_logo.png">
<p class="style3"> السلام عليكم،،، </p>
<p class="style1"> لقد تم إستعادة بيانات الدخول الخاصة بكم في موقع QDelivery نرجوا أستلامها والمحافظة على سريتها. </p>
<p class="style3">~~~~~~~~~~~~~~</p>
<p class="style3">البريد الإلكتروني: <span style="background-color: #f3f3f5; direction:ltr;text-align:right"> '.$to.' </span></p>  
<p class="style3"> كلمة المرور: <span style="background-color: #f3f3f5; direction:ltr;text-align:left;"> '.$d_pass.' </span></p>
<p class="style3">~~~~~~~~~~~~~~</p>


<p class="style1">مع تحياتي فريق العمل...</p>
<p class="style2">موقع QDelivery - ليبيا...&nbsp; <span style="font-family:Tahoma; font-size:10px; font-weight:normal; color:gray"> 

تم الإرسال في: ('. $dat_tim .')
 ---
(IP Address: '. $ip .')

 </span> </p>

</body>
</html>


';

//$from='From: Blood Donation | موقع التبرع بالدم - ليبيا <' .$sender.'>';
//$headers = "?UTF-8?B?".base64_encode($from)."?=" . "\r\n" . 'Content-type: text/html; charset=utf-8' . "\r\n";    
//$headers .= 'From: =?UTF-8?B?'.base64_encode($from). "\r\n";
    
$sender=$site_information[system_email];
$headers ='From: QDelivery - Libya <' .$sender.'>'. "\r\n" . 'Content-type: text/html; charset=utf-8' . "\r\n";
$sn=mail( "$to" , "$subject" , "$message" , $headers );
    
if ($sn){
echo '<div  style="font-size:20px; font-weight: bold; padding-bottom:20px">
<span class="fa fa-check fa-3x"></span>
تم إرسالة بيانات الدخول الى بريدكم الإلكتروني. </div> '; 

}else{
echo '<div  style="font-size:20px; font-weight: bold; padding-bottom:20px">
<span class="fa fa-times fa-3x"></span>
لم تتم عملية إرسال بيانات الدخول، يرجى الاتصال بإدارة الشركة.
</div> '; 
}


    
}else{
echo '<div  style="font-size:20px; font-weight: bold; padding-bottom:20px">
<span class="fa fa-times fa-3x"></span>
هذا البريد غير موجود لدينا، يرجى التأكد والمحاولة مرة أخرى.
</div> '; 


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
