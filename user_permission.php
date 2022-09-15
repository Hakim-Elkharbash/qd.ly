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
checked = false;
function checkedAll () {
if (checked == false){checked = true}else{checked = false}
for (var i = 0; i < document.getElementById('qd-form').elements.length; i++) {
document.getElementById('qd-form').elements[i].checked = checked;
}}
</script>

    
    
    


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
$user_id=$_GET['id'];
$qd_list=mysql_fetch_array(mysql_query("SELECT * FROM sys_users_lp WHERE id='$user_id'"));
 ?> 
    <div class="container">
        <div class="text-center">
            <div class="panel panel-default col-lg-8 col-lg-offset-2" style="padding-bottom:20px !important">
               <div class="panel-heading" style="background-color: burlywood !important">
            <span class="pull-left"><input name="checkall" type="checkbox" onclick="checkedAll();">  تحديد الكل  </span>
 
                   <h4 style="text-align:right;"> <i class="fa fa-users fa-md"></i>  منح الصلاحيات للمستخدم.. </h4>

                </div>
                <div class="panel-body ">              
                    <form action="do_user_permission.php" method="post" class="form-horizontal" id="qd-form" name="qd-form-nm">
                            <input type="hidden" name="idd" value="<? echo $qd_list[id]; ?>">                    
                      <div class="form-group">
                        <div class="col-sm-12">
                            <label for="inputName3" class="pull-right control-label fields-name"> أسم المستخدم </label>
                            <input type="text" name="fullname" readonly value="<? echo $qd_list[fullname]; ?>" class="form-control input-lg" id="inputName3"  placeholder="الإسم الشخصي" >
                        </div>
                      </div>
                      
                    
                        <div class="panel panel-danger">
                          <div class="panel-heading" >
                            <h4 style="text-align:right;"><i class="fa fa-cog fa-md"></i>  تحديد الخدمات</h4>  
                            </div>
                          <div class="panel-body">
                            
                        <div class="form-group">
                           <?
                                $permissions_sr= explode(" ",$qd_list[access_services]);
                                $qd_list_sr=mysql_query("SELECT * FROM user_services ORDER BY order_se ASC");
                                while($rows1=mysql_fetch_array($qd_list_sr)){
                                if (in_array($rows1[id], $permissions_sr)){ 
                                echo '
                                <div class="col-sm-4">
                                <label for="inputsend'.$rows1[id].'" class="pull-right control-label fields-name">
                                    <input name="service['.$rows1[id].']" value="'.$rows1[id].'" type="checkbox" checked id="inputsend'.$rows1[id].'"> '.$rows1[service_name].'
                                </label>
                            </div>
                                
                                ';
                                
                                }else{
                                echo '
                                <div class="col-sm-4">
                                <label for="inputsend'.$rows1[id].'" class="pull-right control-label fields-name">
                                    <input name="service['.$rows1[id].']" value="'.$rows1[id].'" type="checkbox" id="inputsend'.$rows1[id].'"> '.$rows1[service_name].'
                                </label>
                            </div>';
                                }
                                }
                            ?>   
                             
                           
                        </div> 
                              
                        
                              
                          </div>
                        </div>

                        
                        
                        
                        <div class="panel panel-danger">
                          <div class="panel-heading" >
                            <h4 style="text-align:right;"><i class="fa fa-cog fa-md"></i>  الوصول للمخازن</h4>  
                            </div>
                          <div class="panel-body">
                            
                              
                             
                        <div class="form-group">
                            
                             <?
                                $permissions_st= explode(" ",$qd_list[access_stores]);
                                $qd_list_st=mysql_query("SELECT * FROM qd_store");
                                while($rows2=mysql_fetch_array($qd_list_st)){
                                if (in_array($rows2[id], $permissions_st)){ 
                                echo '
                                <div class="col-sm-6">
                                <label for="inputsend'.$rows2[id].'" class="pull-right control-label fields-name">
                                    <input name="store['.$rows2[id].']" value="'.$rows2[id].'" checked type="checkbox" id="inputsend'.$rows2[id].'"> '.$rows2[store_ar].'
                                </label>
                            </div>
                                
                                ';
                                
                                }else{
                                echo '
                                <div class="col-sm-6">
                                <label for="inputsend'.$rows2[id].'" class="pull-right control-label fields-name">
                                    <input name="store['.$rows2[id].']" value="'.$rows2[id].'" type="checkbox" id="inputsend'.$rows2[id].'"> '.$rows2[store_ar].'
                                </label>
                            </div>
                                
                                ';
                                
                                }
                                
                                }
                            ?>
                            
                            
                          </div> 
                         </div>
                        </div>
                        
                    
                       
                        
                        
                        
                        
                        
                        <div class="panel panel-danger">
                          <div class="panel-heading" >
                            <h4 style="text-align:right;"><i class="fa fa-cog fa-md"></i>  الوصول للمناطق</h4>  
                            </div>
                          <div class="panel-body">
                            
                              
                             
                        <div class="form-group">
                            
                             <?
                                $permissions_ar= explode(" ",$qd_list[access_areas]);
                                $qd_list_ar=mysql_query("SELECT * FROM qd_areas");
                                while($rows4=mysql_fetch_array($qd_list_ar)){
                                if (in_array($rows4[id], $permissions_ar)){ 
                                echo '
                                <div class="col-sm-4">
                                <label for="inputsend'.$rows4[id].'" class="pull-right control-label fields-name">
                                    <input name="areas['.$rows4[id].']" value="'.$rows4[id].'" checked type="checkbox" id="inputsend'.$rows4[id].'"> '.$rows4[area_ar].'
                                </label>
                            </div>
                                
                                ';
                                
                                }else{
                                echo '
                                <div class="col-sm-4">
                                <label for="inputsend'.$rows4[id].'" class="pull-right control-label fields-name">
                                    <input name="areas['.$rows4[id].']" value="'.$rows4[id].'" type="checkbox" id="inputsend'.$rows4[id].'"> '.$rows4[area_ar].'
                                </label>
                            </div>
                                
                                ';
                                
                                }
                                
                                }
                            ?>
                            
                            
                          </div> 
                         </div>
                        </div>
                    
                        
                        
                        
                        
                                                
                        <div class="panel panel-danger">
                          <div class="panel-heading" >
                            <h4 style="text-align:right;"><i class="fa fa-cog fa-md"></i>  الوصول للمدن</h4>  
                            </div>
                          <div class="panel-body">
                            
                              
                             
                        <div class="form-group">
                            
                             <?
                                $permissions_ct= explode(" ",$qd_list[access_city]);
                                $qd_list_ct=mysql_query("SELECT * FROM qd_city");
                                while($rows5=mysql_fetch_array($qd_list_ct)){
                                if (in_array($rows5[id], $permissions_ct)){ 
                                echo '
                                <div class="col-sm-4">
                                <label for="inputsend'.$rows5[id].'" class="pull-right control-label fields-name">
                                    <input name="city['.$rows5[id].']" value="'.$rows5[id].'" checked type="checkbox" id="inputsend'.$rows5[id].'"> '.$rows5[city_ar].'
                                </label>
                            </div>
                                
                                ';
                                
                                }else{
                                echo '
                                <div class="col-sm-4">
                                <label for="inputsend'.$rows5[id].'" class="pull-right control-label fields-name">
                                    <input name="city['.$rows5[id].']" value="'.$rows5[id].'" type="checkbox" id="inputsend'.$rows5[id].'"> '.$rows5[city_ar].'
                                </label>
                            </div>
                                
                                ';
                                
                                }
                                
                                }
                            ?>
                            
                            
                          </div> 
                         </div>
                        </div>
                    
                        

                        
                        
                        
                        
                        
                         <div class="panel panel-danger">
                          <div class="panel-heading" >
                            <h4 style="text-align:right;"><i class="fa fa-cog fa-md"></i> الوصول للحالات</h4>  
                            </div>
                          <div class="panel-body">
                            
                              
                             
                        <div class="form-group">
                            
                             <?
                                $permissions_sa= explode(" ",$qd_list[access_status]);
                                $qd_list_st=mysql_query("SELECT * FROM qd_state");
                                while($rows3=mysql_fetch_array($qd_list_st)){
                                if (in_array($rows3[id], $permissions_sa)){ 
                                echo '
                                <div class="col-sm-6">
                                <label for="inputsend'.$rows3[id].'" class="pull-right control-label fields-name">
                                    <input name="state['.$rows3[id].']" value="'.$rows3[id].'" checked type="checkbox" id="inputsend'.$rows3[id].'"> '.$rows3[state_ar].'
                                </label>
                            </div>
                                
                                ';
                                
                                }else{
                                echo '
                                <div class="col-sm-6">
                                <label for="inputsend'.$rows3[id].'" class="pull-right control-label fields-name">
                                    <input name="state['.$rows3[id].']" value="'.$rows3[id].'" type="checkbox" id="inputsend'.$rows3[id].'"> '.$rows3[state_ar].'
                                </label>
                            </div>
                                
                                ';
                                
                                }
                                
                                }
                            ?>
                            
                            
                        </div> 
                              
                              
                        
                              
                          </div>
                        </div>
                        
                         
                      <div class="form-group">
                        <div class="col-sm-12 pull-right">
                          <button name="login_utton" type="submit" class="btn btn-primary btn-lg"> حفظ الصلاحيات </button>
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
				fullname : {
					validators: {
						notEmpty : {
							message : "يجب إدخال الاسم"
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
