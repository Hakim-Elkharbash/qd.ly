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

<!-- Date & Time-->
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
<link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">



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
$user_id=$_SESSION['st'];
$qd_list=mysql_fetch_array(mysql_query("SELECT * FROM sys_users_lp WHERE username='$user_id'"));    
?>
    <div class="container">
        <div class="text-center">
            <div class="panel panel-default col-lg-6 col-lg-offset-3" style="padding-bottom:20px !important">
               <div class="panel-heading" style="background-color: burlywood !important">
                    <h4 style="text-align:right;"> <i class="fa fa-diamond fa-md"></i>   إستراد طلبيات جديدة.. </h4>
                </div>
                <div class="panel-body ">             
                    <form action="do_import_order.php" method="post" class="form-horizontal" id="qd-form" name="qd-form-nm" enctype="multipart/form-data">
                      
                        
                        <div class="form-group">
                        <div class="col-sm-12">
                            <label for="inputName1" class="pull-right control-label fields-name"> إدخل رقم الطلبية </label>
                            <input type="text" name="oname" class="form-control input-lg" id="inputName1"  placeholder="إدخل رقم الطلبية" style="text-align: left; direction: ltr">
                        </div>
                      </div>
                        
                        <div class="form-group">
                        <div class="col-sm-12">
                            <label for="inputName1" class="pull-right control-label fields-name"> تحديد المخزن </label>
                            <select name="storlist" class="form-control input-lg">
                              <?
                               echo "<option value=''>يرجى تحديد المخزن</option>";
                                $permissions_st= explode(" ",$qd_list[access_stores]);
                                $qd_list_st=mysql_query("SELECT * FROM qd_store");
                                while($rows=mysql_fetch_array($qd_list_st)){
                                    if (in_array($rows[id], $permissions_st)){ 
                                        echo "<option value='".$rows[store_en]."'>".$rows[store_ar]." (".$rows[store_en].")</option>";
                                    }
                                }
                              ?>
                            </select>                         
                        </div>
                      </div>
                        
                     
                        
                         <div class="form-group">
                        <div class="col-sm-12">
                            <label for="inputName1" class="pull-right control-label fields-name"> تحديد الحالة  </label>
                            <select name="stlist" class="form-control input-lg">
                              <?
                                echo "<option value='default'> الحالة الإفتراضية (الموجودة في ملف أكسل) </option>";
                                $permissions_stt= explode(" ",$qd_list[access_status]);
                                $qd_list_stt=mysql_query("SELECT * FROM qd_state");
                                while($rows=mysql_fetch_array($qd_list_stt)){
                                  if (in_array($rows[id], $permissions_stt)){ 
                                    echo "<option value='".$rows[state_en]."'>".$rows[state_ar]." (".$rows[state_en].")</option>";
                                  }
                                }
                              ?>
                            </select>                         
                        </div>
                      </div>
                        
                        
                        <div class="form-group">
                        <div class="col-sm-12">
                            <label for="inputName1" class="pull-right control-label fields-name"> إدخل التاريخ </label>
                                <input type='text' name="dattim" value="<? echo date('Y-m-d'); ?>" class="form-control input-lg" id='datetimepicker1' />
                        </div>
                            
                            <script type="text/javascript">
                                $(function () {
                                    $('#datetimepicker1').datetimepicker({
                                        format: 'YYYY-MM-DD',

                                    });
                                });
                            </script>
                      </div>
                      
                        <div class="form-group">
                        <div class="col-sm-12">
                            
                            <label for="inputName2" class="pull-right control-label fields-name"> يرجى تحديد الملف </label>
                            <input type="file" name="fname" class="form-control input-lg" id="inputName2"  placeholder="يرجى تحديد الملف" style="text-align: left; direction: ltr">
                            <label for="inputName2" class="pull-right control-label fields-name"> يجب ان يكون الملف من نوع xls أو xlsx وموافق للهيكلية الصحيحة. </label>

                        </div>
                      </div>
                        
                        <div class="alert alert-danger" role="alert"  style="font-size: 16px; font-weight: bold; text-align: right">
                            <i class="fa fa-exclamation-triangle fa-lg"></i>
                             ملاحظة هامة: يجب الإلتزام بالقالب الموحد الخاص بإستراد البيانات. <a href="images/QDelivery-template.xlsx" title="القالب الموحد لإستراد البيانات"> تحميل القالب </a>
                        </div>                     

                        
                        
                            <hr>                                       
                      <div class="form-group">
                        <div class="col-sm-12 pull-right">
                          <button name="login_utton" type="submit" class="btn btn-primary btn-lg"> تحميل الملف </button>
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
				oname : {
					validators: {
						notEmpty : {
							message : "يجب إدخال رقم الطلبية"
						}
					}
				},
                fname : {
					validators: {
						notEmpty : {
							message : "يجب إختيار ملف لتحميله"
						}
					}
				},
                dattim : {
					validators: {
						date: {
                            format: 'YYYY-MM-DD',
                            message: 'يجب إدخال التاريخ بطريقة صحيحة: مثل،، 23-6-2015'
                        }
					}
				},
                stlist : {
					validators: {
						notEmpty : {
							message : "يجب تحديد الحالة"
						}
					}
				},
                storlist : {
					validators: {
						notEmpty : {
							message : "يجب تحديد المخزن"
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
