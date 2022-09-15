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
$qd_list=mysql_fetch_array(mysql_query("SELECT * FROM setting WHERE id='1'"));
 ?>
  
    <div class="container">
        <div class="text-center">
            <div class="panel panel-default col-lg-6 col-lg-offset-3" style="padding-bottom:20px !important">
               <div class="panel-heading" style="background-color: burlywood !important">
                    <h4 style="text-align:right;"> <i class="fa fa-cogs fa-md"></i>  تغيير إعدادت النظام.. </h4>
                </div>
                <div class="panel-body "> 
<div style="background-color: crimson !important; font-size:16px; font-weight: bold; color:white; padding:10px"><i class="fa fa-exclamation-triangle fa-lg"></i>  تحذير: قد يؤدي تغيير هذه الاعدادت الى خلل أو توقف كامل للنظام عن العمل.  </div>                     
                    <form action="do_settings.php" method="post" class="form-horizontal" id="qd-form" name="qd-form-nm">
                      
                        <div class="form-group">
                        <div class="col-sm-12">
                            <label for="inputZone1" class="pull-right control-label fields-name">المنطقة الزمنية</label>
                            <select name="znlist" id="inputZone1" class="form-control input-lg">
                              
                               <?
                                    echo "<option value=".$qd_list[zone_time].">".$qd_list[zone_time]."</option>";
                                ?>
                            </select>                        
                        </div>
                      </div>
                        
                        <div class="form-group">
                        <div class="col-sm-12">
                    <label for="inputZone2" class="pull-right control-label fields-name">اللغة الإفتراضية </label>
                            <select name="lglist" id="inputZone2" class="form-control input-lg">
                              
                               <?
                                    echo "<option value=".$qd_list[default_language].">اللغة العربية</option>";
                                ?>
                            </select>                        
                        </div>
                      </div>
                        
                        <div class="form-group">
                        <div class="col-sm-12">
                            <label for="inputEmail3" class="pull-right control-label fields-name" > البريد الإفتراضي (<span style="font-size:12px;"> لإرسال وأستقبال رسائل النظام وإستلام الإشعارات. </span>)</label>
                          <input type="email" name="email" value="<? echo $qd_list[system_email]; ?>" class="form-control input-lg" id="inputEmail3" style="text-align: left; direction: ltr" placeholder="البريد الإفتراضي" >
                            
                        </div>
                      </div>
                        
                        
                        <div class="form-group">
                        <div class="col-sm-12">
                            <label for="inputName3" class="pull-right control-label fields-name">عدد نتائج البحث</label>
                        
                        <select name="rslist" class="form-control input-lg" id="res_no">
                            <?
                            if ($qd_list[rows]=='10'){
                            echo"<option selected='selected' value='10'>10</option>";
                            }else{
                            echo"<option value='10'>10</option>";
                            }
                            if ($qd_list[rows]=='25'){
                            echo"<option selected='selected' value='25'>25</option>";
                            }else{
                            echo"<option value='25'>25</option>";
                            }
                            if ($qd_list[rows]=='50'){
                            echo"<option selected='selected' value='50'>50</option>";
                            }else{
                            echo"<option value='50'>50</option>";
                            }
                            if ($qd_list[rows]=='75'){
                            echo"<option selected='selected' value='75'>75</option>";
                            }else{
                            echo"<option value='75'>75</option>";
                            }
                            if ($qd_list[rows]=='100'){
                            echo"<option selected='selected' value='100'>100</option>";
                            }else{
                            echo"<option value='100'>100</option>";
                            }
                            ?>
                            </select>    
                        </div>
                      </div>
                     
                    <div class="form-group">
                        <div class="col-sm-12">
                    <label for="inputnotfi2" class="pull-right control-label fields-name"> إستقبال الإشعارات عند تغيير الحالة </label>
                            <select name="ntlist" id="inputnotfi2" class="form-control input-lg">
                              
                                <?
                                if ($qd_list[receive_notifi]=="yes"){
                                echo "<option value='yes' selected>تفعيل إستقبال الإشعارات</option>";
                                echo "<option value='no'>منع إستقبال الإشعارات</option>";
                                }else{
                                echo "<option value='yes'>تفعيل إستقبال الإشعارات</option>";
                                echo "<option value='no' selected>منع إستقبال الإشعارات</option>";
                                }
                                ?>
                            </select>                        
                        </div>
                      </div>
                        
                        
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="inputface3" class="pull-right control-label fields-name" >عنوان صفحة فيس بوك</label>
                          <input type="text" name="face" value="<? echo $qd_list[facebook]; ?>" class="form-control input-lg" id="inputface3" style="text-align: left; direction: ltr" placeholder=" صفحة الفيس بوك" >
                        </div>
                      </div>
                        
                        <div class="form-group">
                        <div class="col-sm-12">
                            <label for="inputkeywords3" class="pull-right control-label fields-name" >الكلمات المفتاحية للموقع  (<span style="font-size:12px;"> تساعد هذه الكلمات محركات البحث للوصول للموقع بسهولة </span>) </label>
                          <input type="text" name="key" value="<? echo $qd_list[keywords_ar]; ?>" class="form-control input-lg" id="inputkeywords3" placeholder=" الكلمات المفتاحية" >
                        </div>
                      </div>
                    
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="inputdes3" class="pull-right control-label fields-name" >وصف الموقع (<span style="font-size:12px;"> يساعد هذا الوصف محركات البحث للوصول للموقع بسهولة </span>) </label>
                          <input type="text" name="des" value="<? echo $qd_list[description_ar]; ?>" class="form-control input-lg" id="inputdes3"  placeholder="وصف الموقع" >
                        </div>
                      </div>
                
                <div class="form-group">
                        <div class="col-sm-12">
                            <label for="inputcopy3" class="pull-right control-label fields-name" >حقوق الملكية الفكرية</label>
                          <input type="text" name="copyright" value="<? echo $qd_list[copyright_ar]; ?>" class="form-control input-lg" id="inputcopy3"  placeholder="حقوق الملكية الفكرية" >
                        </div>
                      </div>
                        
                         
                      <div class="form-group">
                        <div class="col-sm-12 pull-right">
                          <button name="login_utton" type="submit" class="btn btn-primary btn-lg">حفظ الإعدادات الجديدة </button>
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
				email :{
					message : "يجب إدخال البريد الالكتروني",
					validators : {
						notEmpty : {
							message : "إدخل البريد الالكتروني"
						},
						emailAddress: {
							message: "خطأ في صيغة البريد الإلكتروني"
						}
					}
				}, 
				znlist: {
					validators: {
						notEmpty : {
							message : "يجب  تحديد المنطقة الزمنية"
						}
					}
				}, 
                lglist: {
					validators: {
						notEmpty : {
							message : "يجب  تحديد  اللغة الافتراضية"
						}
					}
				}, 
                rslist: {
					validators: {
						notEmpty : {
							message : "يجب  تحديد عدد نتائج البحث"
						}
					}
				}, 
                ntlist: {
					validators: {
						notEmpty : {
							message : "يجب تحديد حالة إستلام الاشعارات"
						}
					}
				},
                face: {
					validators: {
						notEmpty : {
							message : "يجب إدخال عنوان صفحة الفيس بوك"
						}
					}
				}, 
                key: {
					validators: {
						notEmpty : {
							message : "يجب إدخال الكلمات المفتاحية للموقع"
						}
					}
				}, 
                des: {
					validators: {
						notEmpty : {
							message : "يجب إدخال وصف للموقع"
						}
					}
				}, 
				copyright : {
					validators : {
						notEmpty : {
							message : "إدخل حقوق الملقية الفكرية للموقع"
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
