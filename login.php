<?
ob_start();
//error_reporting(0);
session_start();
if(isset($_SESSION['st'])){
//echo '<script> window.location.replace("http://www.dm.ly/login.php#form"); </script>';
header("location:members.php");
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
//------------------------------------------------------
$page_titles=mysql_fetch_assoc(mysql_query("SELECT * FROM page_titles WHERE page_link='$page_url' AND page_languge='$lang'"));
echo "<title>".$page_titles[page_title]."</title>";
echo "<link rel='shortcut icon' href='".$site_information[website_icon]."'>";
?>
<link  rel="stylesheet" type="text/css" href="css/ar.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.2.0-rc2/css/bootstrap-rtl.min.css">




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
<?
if(isset($_SESSION['st'])){
echo '

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
                    <li><a href="index.php">الصفحة الرئيسية</a>
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
  			<div class="navbar-header">
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
   				<ul class="nav navbar-nav navbar-right top-links">
                    <li><a href="index.php">الصفحة الرئيسية</a>
                    <li><a href="contact_us.php">تواصلوا معنا</a>
  					<!-- <li><a href="">حول الشركة</a>  -->
  		        </ul>
  			</div>
  		</div><!-- End Container-->
  	</nav><!-- End navbar -->

';
    
}
    
?>

    
<div style="height:75px">
   
</div>
  
    <div class="container">
        <div class="text-center">
            <div class="panel panel-info col-lg-6 col-lg-offset-3" style="padding-bottom:20px !important">
                <div class="panel-body ">              
                    <form action="" method="post" class="form-horizontal">
                        <div>
                        <?
                            function encryptIt( $q ) {
                                $cryptKey  = '0k8gwV8RBljhx2cxYMWVnhsUig+S9/p6JA1g';
                                $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
                                return( $qEncoded ); }

                            if (isset($_REQUEST['login_utton'])) {
                                $st=mysql_real_escape_string(strval($_POST["email"]));
                                $st1=mysql_real_escape_string(strval($_POST["password"]));

                                $e_pass= encryptIt( $st1 );

                                $result1 = mysql_query("SELECT * FROM sys_users_lp WHERE username = '$st' && password = '$e_pass' && suspended = ''");
                                if (mysql_numrows($result1) > 0){
                                    session_start();
                                    $_SESSION['st'] = $st;
                                    //session_register("st");
                                    header("location:members.php");
                                }else{
echo '<div class="panel panel-info" style="background-color: crimson !important; font-size:18px; font-weight: bold; color:white; text-align: right !important">
غير قادر على تسجيل الدخول قد يكون هناك خطا في البريد الإلكتروني أو/ و كلمة المرور،، أو أن حسابكم موقف مؤقتنا من إدارة الموقع...  </div> '; 
                                }
                            }
                            ?>
                        </div>    
                      <div class="form-group">
                        <div class="col-sm-12">
                            <label for="inputEmail3" class="pull-right control-label fields-name">البريد الإلكتروني</label>
                            <input type="email" name="email" class="form-control input-lg" id="inputEmail3" style="text-align: left; direction: ltr" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                            <label for="inputPassword3" class="pull-right control-label fields-name" > كلمة المرور</label>
                          <input type="password" name="password" class="form-control input-lg" id="inputPassword3" style="text-align: left; direction: ltr" placeholder="Password">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12 pull-right">
                          <button name="login_utton" type="submit" class="btn btn-success btn-lg">تسجيل الدخول</button>
                           &nbsp;&nbsp;<a href="retrieve_password.php" class="link_det" > نسيت كلمة المرور </a> 
                        </div>
                      </div>
                    </form> 
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
