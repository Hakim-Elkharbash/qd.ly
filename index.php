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

 <?
if(isset($_SESSION['st'])){
echo '

<!-- Navbar -->
  	<nav class="navbar navbar-inverse navbar-fixed-top " id="my-navbar">
  		<div class="container ">
  			<div class="navbar-header" >
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
                    <li><a href="'.$site_information[facebook].'" target="_blank"><span class="fa fa-facebook-official fa-lg"></span></a>
                    <li><a href="contact_us.php">تواصلوا معنا</a>
                    <li><a href="members.php"> لـوحة التحكم</a>
                    <li class="active"><a href="index.php">الصفحة الرئيسية</a>
  		        </ul>
  			</div>
  		</div><!-- End Container-->
  	</nav><!-- End navbar -->
 


';
}else{
echo '

<!-- Navbar -->
  	<nav class="navbar navbar-inverse navbar-fixed-top " id="my-navbar">
  		<div class="container ">
  			<div class="navbar-header" >
  				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
  					<span class="icon-bar"></span>
  					<span class="icon-bar"></span>
  					<span class="icon-bar"></span>
  				</button>
                
                <a href="login.php" class="btn btn-success btn-md navbar-btn pull-left">
                    تسجيل الدخول&nbsp;
                <span class="glyphicon glyphicon-log-in"></span>
                </a> 
          </div><!-- Navbar Header-->
  			<div class="collapse navbar-collapse" id="navbar-collapse">
   				<ul class="nav navbar-nav navbar-right top-links" >
                    <li><a href="'.$site_information[facebook].'" target="_blank"><span class="fa fa-facebook-official fa-lg"></span></a>
                    <li><a href="contact_us.php">تواصلوا معنا</a>
                    <li class="active"><a href="index.php">الصفحة الرئيسية</a>
  					<!-- <li><a href="">حول الشركة</a>  -->
  		        </ul>
  			</div>
  		</div><!-- End Container-->
  	</nav><!-- End navbar -->

';
    
}
    
?>

    
    
    <div class="jumbotron">
  		<div class="container text-center">
            <h1 style="font-family: serif; padding-bottom: 15px">QDelivery - Libya</h1>
  			<p style="padding-bottom: 30px">للشحن داخل مدن ليبيا،،، هدفنا هو تقريب المسافات بين المستثمرين ومتسوقي الانترنت</p>
            <!--
            
            -->
      <div class="panel panel-info col-lg-6 col-lg-offset-3">
        <div class="panel-body ">      
            <form action="search_new.php" method="get" >
                <div class="row">
                  <div class="col-lg-12">
                    <div class="input-group">
                      <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="submit">بحــث</button>
                      </span>
                      <input type="text" name="item"  style=" text-align: center" class="form-control input-lg" placeholder="إدخل بوليصة الشحن أو كود المندوب">
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            </form>

  		</div><!-- End container -->
    </div><!-- End jumbotron-->
   </div>
</div>         
            
            
    <div class="container">
        <div class="text-center">
               <h2 style="padding-bottom:20px">
                   <div class="btn btn-lg btn-default"><span class="glyphicon glyphicon-phone-alt"></span>&nbsp; +218-945336356</div>
                   <div class="btn btn-lg btn-default"><span class="glyphicon glyphicon-phone-alt"></span>&nbsp; +218-916713167</div>
                </h2>
                <div id="fb-root" style="text-align:center"></div>
                    <script>(function(d, s, id) {
                      var js, fjs = d.getElementsByTagName(s)[0];
                      if (d.getElementById(id)) {return;}
                      js = d.createElement(s); js.id = id;
                      js.src = "//connect.facebook.net/ar_AR/all.js#xfbml=1";
                      fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>
                    <div class="fb-like" data-href="<? echo  $site_information[facebook]; ?>" data-send="true" data-layout="button_count" data-width="250" data-show-faces="false" style="text-align:center;width:100px">
                </div>			


             <hr>
            <img src="images/logo.jpg">
            <h3 style="padding-bottom: 10px; direction: rtl !important">شركتنا هي الوكيل الحصري لتوصيل طلبيات شركة CristianLay</h3>
            <h4 style="direction: rtl !important">بوابة الأندلس الدور الثالث، قرقارش،، مدينة طرابلس - ليبيا
</h4>

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
