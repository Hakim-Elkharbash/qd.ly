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
/*
$qd_user_prem=mysql_fetch_array(mysql_query("SELECT * FROM page_titles WHERE page_link='$page_url'"));
$premissions_access=$_SESSION['pre_acc'];
if (!in_array($qd_user_prem[user_access], $premissions_access)){ 
header("location:members.php");
}
*/
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




<script type="text/javascript">
function top_page(obj) {
$('html, body').animate({ scrollTop: 0 }, 'slow');
}
</script> 

</head>

<body>
<!-- 
Statistical information and settings..
-->
<?
/*
$ip = $_SERVER['REMOTE_ADDR'];
if (empty($ip)){
$ip = getenv('REMOTE_ADDR');
}

$geo_det_1 = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
if (!empty($geo_det_1)){
$geo_det_1 = get_object_vars($geo_det_1);
$whole_geo_det1 = implode(', ', array_map(function ($v, $k) { return '"'.$k . '"' .':' .'"'. $v .'"'; }, $geo_det_1, array_keys($geo_det_1)));
}else{
$whole_geo_det1="Unable to collect information";
}


$geo_det_2= file_get_contents('http://freegeoip.net/json/'.$ip);
if (!empty($geo_det_2)){
$whole_geo_det2=$geo_det_2;
}else{
$whole_geo_det2="Unable to collect information";
}

$geo_det_3 = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$ip"));
if (!empty($geo_det_3)){
$whole_geo_det3 = implode(', ', array_map(function ($v, $k) { return '"'.$k . '"' .':' .'"'. $v .'"'; }, $geo_det_3, array_keys($geo_det_3)));
}else{
$whole_geo_det3="Unable to collect information";
}
//-------------------------
$page_name="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//-------------------------
$agent_det=$_SERVER['HTTP_USER_AGENT'];
//-------------------------
if (stripos($agent_det,"iPod")){
$os="iPod";
}elseif (stripos($agent_det,"iPhone")){ 
$os="iPhone";
}elseif (stripos($agent_det,"iPad")){
$os="iPad"; 
}elseif (stripos($agent_det,"Android")){ 
$os="Android"; 
}elseif (stripos($agent_det,"webOS")){
$os="webOS"; 
}elseif (stripos($agent_det,"Win")){
$os="Windows"; 
}else{
$os="Unknown";
}
//-------------------------
$user_agent = $_SERVER['HTTP_USER_AGENT']; 
if (preg_match('/MSIE/i', $agent_det)) { $browser = "Internet Explorer";} 
elseif (preg_match('/Firefox/i', $agent_det)){$browser = "Mozilla Firefox";} 
elseif (preg_match('/Chrome/i', $agent_det)){$browser = "Google Chrome";} 
elseif (preg_match('/Safari/i', $agent_det)){$browser = "Safari";} 
elseif (preg_match('/Opera/i', $agent_det)){$browser = "Opera";}
else {$browser = "Unknown";}

//-------------------------
$time_zone=$site_information[zone_time];
date_default_timezone_set($time_zone);
$dat=date('d/m/Y');
$tim=date('H:i:s');

//-------------------------------
/*
//مستقبلا سيتم تعديل فتح الواجهة حسب البلد من خلال تفعيل هذه العبارة
if (($site_information[default_language]=='en')||($country<>"LY")){
//-------------------------------
if ($site_information[default_language]=="en"){
$lg="English";
}else{
$lg="Arabic";
} */

/*
$lg="Arabic";
//-------------------------
mysql_query("INSERT INTO public_users_tracing(access_date,access_time,public_ip,geo_ipinfo,geo_freegeoip,geo_geoplugin,os_agent,browser_agent,agent_details,accessed_page,displayed_language) VALUES ('$dat','$tim','$ip', '$whole_geo_det1', '$whole_geo_det2', '$whole_geo_det3','$os','$browser','$agent_det','$page_name','$lg')");

//----------------------------------------------------
if ($site_information[default_language]=='en'){
header("location:en/index.php");
}*/
?>

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
  
    <div class="container">
       <div class="panel panel-default col-lg-10 col-lg-offset-1" style="padding-bottom:20px !important">
               <div class="panel-heading" style="background-color: burlywood !important">
                    <h4 style="text-align:right;"> <i class="fa fa-globe fa-md"></i> العنوان .. </h4>
                </div>
                <div class="panel-body "> 
                
                
                
                
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
