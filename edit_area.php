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
$area_id=$_GET['id'];
$qd_list=mysql_fetch_array(mysql_query("SELECT * FROM qd_areas WHERE id='$area_id'"));
 ?>

       
    <div class="container">
        <div class="text-center">
            <div class="panel panel-default col-lg-6 col-lg-offset-3" style="padding-bottom:20px !important">
               <div class="panel-heading" style="background-color: burlywood !important">
                    <h4 style="text-align:right;"> <i class="fa fa-globe fa-md"></i>  تعديل بيانات منطقة.. </h4>
                </div>
                <div class="panel-body ">             
                    <form action="do_edit_area.php" method="post" class="form-horizontal" id="qd-form" name="qd-form-nm">
                        <input type="hidden" name="idd" value="<? echo $qd_list[id]; ?>">                    
                      <div class="form-group">
                        <div class="col-sm-12">
                            <label for="inputName1" class="pull-right control-label fields-name"> اسم المنطقة - انجليزي </label>
                            <input type="text" name="ename" class="form-control input-lg" value="<? echo $qd_list[area_en]; ?>" id="inputName1"  placeholder="اسم المنطقة - انجليزي" style="text-align: left; direction: ltr">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                            <label for="inputName2" class="pull-right control-label fields-name"> اسم المنطقة - عربي </label>
                            <input type="text" name="aname" class="form-control input-lg" value="<? echo $qd_list[area_ar]; ?>" id="inputName2"  placeholder="اسم المنطقة - عربي" >
                            
                        </div>
                      </div>
                         
                                             
                      <div class="form-group">
                        <div class="col-sm-12 pull-right">
                          <button name="login_utton" type="submit" class="btn btn-primary btn-lg"> تعديل المنطقة </button>
                           &nbsp;&nbsp;<a href="members.php" class="link_det" > إلغاء الأمر </a> 
                        </div>
                      </div>
                    </form>
                    
                </div>
            </div>  
        </div>
    </div> 
    
    
    
    
    <script type="text/javascript">
	$(document).ready(function () {
		var validator = $("#qd-form").bootstrapValidator({
			feedbackIcons: {
				valid: "glyphicon glyphicon-ok input-lg",
				invalid: "glyphicon glyphicon-remove input-lg", 
				validating: "glyphicon glyphicon-refresh input-lg"
			}, 
			fields : {
				ename : {
					validators: {
						notEmpty : {
							message : "يجب إدخال اسم المنطقة بالانجليزي"
						}
					}
				}, 
				aname : {
					validators: {
						notEmpty : {
							message : "يجب إدخال اسم المنطقة بالعربي"
						}
					}
				}
			}
		});
	
		validator.on("success.form.bv", function (e) {
            $('form#qd-form-nm').submit();
            //alert("test");
			//e.preventDefault();
			//$("#registration-form").addClass("hidden");
			//$("#confirmation").removeClass("hidden");
		});
		
	});

</script>

    
    
    
    
    
    
    
    
    
    
    <div class="navbar navbar-default navbar-fixed-bottom">
        <div class="container">
            <p class="navbar-text pull-left devoloed">Developed By:&nbsp;<a  href="http://www.libyapages.net/" target="_blank" class="libyapages">LIBYAPAGES</a></p>
        <p class="navbar-text pull-right copyright"><? echo $site_information[copyright_ar]; ?></p>
            
        <!--    <a class="btn navbar-btn btn-default pull-right btn-sm">شروط تقديم الخدمة</a>  -->
        </div>
    </div>

</body>

</html>
