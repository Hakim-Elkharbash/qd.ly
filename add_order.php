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
            <div class="panel panel-default col-lg-12" style="padding-bottom:20px !important">
               <div class="panel-heading" style="background-color: burlywood !important">
                    <h4 style="text-align:right;"> <i class="fa fa-diamond fa-md"></i> إضافة طلبية جديدة.. </h4>
                </div>
                <div class="panel-body ">             
                    <form action="do_add_order.php" method="post" class="form-horizontal" id="qd-form" name="qd-form-nm">
                                        
                        <div class="form-group">
                            
                            
                        <div class="col-sm-6">
                            <label for="inputName4" class="pull-right control-label fields-name"> رقم بوليصة الشحن &amp; البارن </label>
                            <input type="text" name="qdtex4" class="form-control input-lg" id="inputName4"  placeholder="Way Bill" style="text-align: left; direction: ltr">
                        </div>
                          
                            
                            
                            
                            <div class="col-sm-6">
                            <label for="inputName27" class="pull-right control-label fields-name">   نوع الخدمة </label>
                             <select name="qdtex27" class="form-control input-lg">
                             <option value="COD">COD</option>
                             <option value="MAIL">MAIL</option>
                            </select>  
                            </div>      
                            
                            
                            
                            
                            <div class="col-sm-6">
                            <label for="inputName6" class="pull-right control-label fields-name"> السعر </label>
                            <input type="text" name="qdtex6" oninput="calculate()" class="form-control input-lg" id="inputName6"  placeholder="Amount" style="text-align: left; direction: ltr">
                        </div>
                     
                        <div class="col-sm-6">
                            <label for="inputName7" class="pull-right control-label fields-name"> سعر الخدمة </label>
                            <input type="text" name="qdtex7" oninput="calculate()" class="form-control input-lg" id="inputName7"  placeholder="Service Charge" style="text-align: left; direction: ltr">
                        </div>
                      
                        <div class="col-sm-6">
                            <label for="inputName8" class="pull-right control-label fields-name"> إجمالي المبلغ </label>
                            <input type="text" name="qdtex8" readonly class="form-control input-lg" id="inputName8"  placeholder="Total Amount" style="text-align: left; direction: ltr">
                        </div>
                            
               
<script type="text/javascript">
    function calculate() {
    document.getElementById('inputName8').value = Number(document.getElementById('inputName6').value) + Number(document.getElementById('inputName7').value);
}     
</script>                 
                            
                        <div class="col-sm-6">
                            <label for="inputName9" class="pull-right control-label fields-name"> تسديد القيمة من </label>
                            <select name="qdtex9" class="form-control input-lg">
                             <option value="Consignee">المستلم (Consignee)</option>
                             <option value="Shipper">المرسل (Shipper)</option>
                            </select>  
                        </div>    
                            
                          
                            
                            <div class="col-sm-6">
                            <label for="inputName14" class="pull-right control-label fields-name">  اسم المستلم </label>
                            <input type="text" name="qdtex14" class="form-control input-lg" id="inputName14"  placeholder="Consignee Name" style="text-align: left; direction: ltr">
                        </div>
                            
                            
                      
                        <div class="col-sm-6">
                            <label for="inputName15" class="pull-right control-label fields-name">  رقم هاتف المستلم </label>
                            <input type="text" name="qdtex15" class="form-control input-lg" id="inputName15"  placeholder="Consignee Phone" style="text-align: left; direction: ltr">
                        </div>
                            
                            
                            
                            
                         <div class="col-sm-6">
                            <label for="inputName13" class="pull-right control-label fields-name">  عنوان المستلم </label>
                            <input type="text" name="qdtex13" class="form-control input-lg" id="inputName13"  placeholder="Consignee Address" style="text-align: left; direction: ltr">
                        </div>
                     
                        
                            
                        <div class="col-sm-6">
                            <label for="inputName5" class="pull-right control-label fields-name"> كود المندوب </label>
                            <input type="text" name="qdtex5" class="form-control input-lg" id="inputName5"  placeholder="Code" style="text-align: left; direction: ltr">
                        </div>
                            
                            
                        
                            <div class="col-sm-6">
                            <label for="inputName11" class="pull-right control-label fields-name">  المنطقة </label>
                            <select name="qdtex11" class="form-control input-lg">
                              <?
                               echo "<option value=''>يرجى تحديد المنطقة</option>";
                               $permissions_ar= explode(" ",$qd_list[access_areas]);
                               $qd_list_ar=mysql_query("SELECT * FROM qd_areas");
                                while($rows=mysql_fetch_array($qd_list_ar)){
                                  if (in_array($rows[id], $permissions_ar)){ 
                                    echo "<option value='".$rows[area_en]."'>".$rows[area_ar]." (".$rows[area_en].")</option>";
                                  }
                                }
                              ?>
                            </select> 
                            </div>
                      
                            
                            <div class="col-sm-6">
                            <label for="inputName19" class="pull-right control-label fields-name"> ايميل او الكنية على الفيس للمستلم </label>
                            <input type="text" name="qdtex19" class="form-control input-lg" id="inputName19"  placeholder="Email or Facebook" style="text-align: left; direction: ltr">
                        </div>
                        
                        
                        
                            <div class="col-sm-6">
                            <label for="inputName16" class="pull-right control-label fields-name"> اسم المرسل </label>
                            <input type="text" name="qdtex16" class="form-control input-lg" id="inputName16"  placeholder="Shipper Name" style="text-align: left; direction: ltr">
                        </div>
                            
                            
                        <div class="col-sm-6">
                            <label for="inputName12" class="pull-right control-label fields-name">  المدينة </label>
                            <select name="qdtex12" class="form-control input-lg">
                              <?
                               echo "<option value=''>يرجى تحديد المدينة</option>";
                               $permissions_ct= explode(" ",$qd_list[access_city]);
                               $qd_list_ct=mysql_query("SELECT * FROM qd_city");
                                while($rows=mysql_fetch_array($qd_list_ct)){
                                  if (in_array($rows[id], $permissions_ct)){ 
                                    echo "<option value='".$rows[city_en]."'>".$rows[city_ar]." (".$rows[city_en].")</option>";
                                  }
                                }
                              ?>
                            </select>   
                            </div>
                            
                            
                            
                            
                             <div class="col-sm-6">
                            <label for="inputName17" class="pull-right control-label fields-name">  كود المشرف </label>
                            <input type="text" name="qdtex17" class="form-control input-lg" id="inputName17"  placeholder="Shipper Code" style="text-align: left; direction: ltr">
                        </div>
                
    
    
                         <div class="col-sm-6">
                            <label for="inputName18" class="pull-right control-label fields-name">  رقم هاتف المرسل </label>
                            <input type="text" name="qdtex18" class="form-control input-lg" id="inputName18"  placeholder="Shipper Phone" style="text-align: left; direction: ltr">
                        </div>
    
    

    
    
                        <div class="col-sm-6">
                            <label for="inputName2" class="pull-right control-label fields-name"> تحديد المخزن </label>
                            <select name="qdtex2" class="form-control input-lg">
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
    
                            
                            
                        <div class="col-sm-6">
                            <label for="inputName1" class="pull-right control-label fields-name"> رقم الطلبية </label>
                            <input type="text" name="qdtex1" class="form-control input-lg" id="inputName1"  placeholder="Order No." style="text-align: left; direction: ltr">
                        </div>
                            
                            
                            
                            
                            
                        <div class="col-sm-6">
                            <label for="inputName20" class="pull-right control-label fields-name">  Shipment State حالة الشحن </label>
                            <select name="qdtex20" class="form-control input-lg">
                              <?
                               echo "<option value=''>يرجى تحديد حالة الشحن</option>";
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
                            
                            
                            
                            
                            
                            <div class="col-sm-6">
                            <label for="inputName26" class="pull-right control-label fields-name">   نوعية السلعة </label>
                            <input type="text" name="qdtex26" class="form-control input-lg" id="inputName26"  placeholder="Service Type"  style="text-align: left; direction: ltr">
 
                            </div>   
                            
                            
                            
                            
                      
                      
                        <div class="col-sm-6">
                            <label for="inputName3" class="pull-right control-label fields-name"> إدخل التاريخ </label>
                                <input type='text' name="qdtex3" value="<? echo date('Y-m-d'); ?>" class="form-control input-lg" id='datetimepicker1' />
                        </div>
                            
                            <script type="text/javascript">
                                $(function () {
                                    $('#datetimepicker1').datetimepicker({
                                        format: 'YYYY-MM-DD',

                                    });
                                });
                            </script>
                      
                      
                      
    
    
    
                            <div class="col-sm-6">
                            <label for="inputName22" class="pull-right control-label fields-name"> تاريخ موعد التسليم </label>
                                <input type='text' name="qdtex22" value="<? echo date('Y-m-d'); ?>" class="form-control input-lg" id='datetimepicker3' />
                        </div>
                            
                            <script type="text/javascript">
                                $(function () {
                                    $('#datetimepicker3').datetimepicker({
                                        format: 'YYYY-MM-DD',

                                    });
                                });
                            </script> 
                            
    
    
    
    
                             <div class="col-sm-6">
                            <label for="inputName24" class="pull-right control-label fields-name"> عدد الطرود </label>
                            <input type="text" name="qdtex24" class="form-control input-lg" id="inputName24"  placeholder="Total Pkgs" style="text-align: left; direction: ltr">
                        </div>
    
    
    
    
                                      
                              <div class="col-sm-6">
                            <label for="inputName33" class="pull-right control-label fields-name"> الوزن </label>
                            <input type="text" name="qdtex33" class="form-control input-lg" id="inputName33"  placeholder="Weigh" style="text-align: left; direction: ltr">
                        </div>
                            
                            
                            
                           
                            
                            
                              <div class="col-sm-6">
                            <label for="inputName34" class="pull-right control-label fields-name"> الطول </label>
                            <input type="text" name="qdtex34" class="form-control input-lg" id="inputName34"  placeholder="Length" style="text-align: left; direction: ltr">
                        </div>
                            
                            
                            
                           
                            
                            
                              <div class="col-sm-6">
                            <label for="inputName35" class="pull-right control-label fields-name"> العرض </label>
                            <input type="text" name="qdtex35" class="form-control input-lg" id="inputName35"  placeholder="Width" style="text-align: left; direction: ltr">
                        </div>
                            
                            
                            
                           
                            
                            
                              <div class="col-sm-6">
                            <label for="inputName36" class="pull-right control-label fields-name"> الارتفاع </label>
                            <input type="text" name="qdtex36" class="form-control input-lg" id="inputName36"  placeholder="Height" style="text-align: left; direction: ltr">
                        </div>
                       
                            
    
    
      <div class="col-sm-12">
                            <label for="inputName41" class="pull-right control-label fields-name"> ملاحظات </label>
                            <input type="text" name="qdtex41" class="form-control input-lg" id="inputName41"  placeholder="Comment" style="text-align: left; direction: ltr">
                        </div>
                       
    
    
    
    
    
<!--
    
    
    
    
    
    
    
                        
                      
                        
                      
                        <div class="col-sm-6">
                            <label for="inputName10" class="pull-right control-label fields-name"> ترقيم الارفف </label>
                            <input type="text" name="qdtex10" class="form-control input-lg" id="inputName10"  placeholder="Locker" style="text-align: left; direction: ltr">
                        </div>
                      
                        
                            
                            
                      <div class="col-sm-6">
                            <label for="inputName21" class="pull-right control-label fields-name"> تاريخ معاملة حالة الشحنة </label>
                                <input type='text' name="qdtex21" value="<? //echo date('Y-m-d'); ?>" class="form-control input-lg" id='datetimepicker2' />
                        </div>
                            
                            <script type="text/javascript">
                                $(function () {
                                    $('#datetimepicker2').datetimepicker({
                                        format: 'YYYY-MM-DD',

                                    });
                                });
                            </script>      
                            
                        
                            
                        <div class="col-sm-6">
                            <label for="inputName23" class="pull-right control-label fields-name">  إرسال الباران </label>
                            <select name="qdtex23" class="form-control input-lg">
                             <option value="SENT">SENT</option>
                             <option value="NOT SENT">NOT SENT</option>
                            </select>   
                            </div>    
                         
                            
                            
                            
                            
                            
                            <div class="col-sm-6">
                            <label for="inputName25" class="pull-right control-label fields-name"> رقم الطرد </label>
                            <input type="text" name="qdtex25" class="form-control input-lg" id="inputName25"  placeholder="Pkg No." style="text-align: left; direction: ltr">
                        </div>
                      
                          
                            
                            
                         
                            
                            
                            
                            <div class="col-sm-6">
                            <label for="inputName28" class="pull-right control-label fields-name"> تاريخ الاخطار الاول </label>
                                <input type='text' name="qdtex28" value="<? //echo date('Y-m-d'); ?>" class="form-control input-lg" id='datetimepicker4' />
                        </div>
                            
                            <script type="text/javascript">
                                $(function () {
                                    $('#datetimepicker4').datetimepicker({
                                        format: 'YYYY-MM-DD',

                                    });
                                });
                            </script>      
                            
                        
                            
                            
                    
                            
                            
                            
                            <div class="col-sm-6">
                            <label for="inputName29" class="pull-right control-label fields-name"> تاريخ الإخطار الثاني </label>
                                <input type='text' name="qdtex29" value="<? //echo date('Y-m-d'); ?>" class="form-control input-lg" id='datetimepicker5' />
                        </div>
                            
                            <script type="text/javascript">
                                $(function () {
                                    $('#datetimepicker5').datetimepicker({
                                        format: 'YYYY-MM-DD',

                                    });
                                });
                            </script> 
                            
                            
                            
                            
                            
                            <div class="col-sm-6">
                            <label for="inputName30" class="pull-right control-label fields-name"> ارسال المبلغ </label>
                            <select name="qdtex30" class="form-control input-lg">
                             <option value="تم الارسال">تم الارسال</option>
                             <option value="لم يتم الارسال">لم يتم الارسال</option>
                            </select>   
                            </div> 
                            
                            
                            
                            
                            
                            <div class="col-sm-6">
                            <label for="inputName31" class="pull-right control-label fields-name">  تسليم قيمة الشحنة للمرسل </label>
                            <select name="qdtex31" class="form-control input-lg">
                             <option value="تم التسليم">تم التسليم</option>
                             <option value="لم يتم التسليم">لم يتم التسليم</option>
                            </select>   
                            </div> 
                            
                            
                            
                            
                            
                            
                               
                            <div class="col-sm-6">
                            <label for="inputName32" class="pull-right control-label fields-name"> تاريخ تسليم قيمة الشحنة للمرسل </label>
                                <input type='text' name="qdtex32" value="<? //echo date('Y-m-d'); ?>" class="form-control input-lg" id='datetimepicker6' />
                        </div>
                            
                            <script type="text/javascript">
                                $(function () {
                                    $('#datetimepicker6').datetimepicker({
                                        format: 'YYYY-MM-DD',

                                    });
                                });
                            </script> 
                            
                           
                            
                            
                            
                         
                            
                                         
                              <div class="col-sm-6">
                            <label for="inputName37" class="pull-right control-label fields-name"> QD1 </label>
                            <input type="text" name="qdtex37" class="form-control input-lg" id="inputName37"  placeholder="QD1" style="text-align: left; direction: ltr">
                        </div>
                            
                            
                            
                           
                            
                            
                              <div class="col-sm-6">
                            <label for="inputName38" class="pull-right control-label fields-name"> QD2 </label>
                            <input type="text" name="qdtex38" class="form-control input-lg" id="inputName38"  placeholder="QD2" style="text-align: left; direction: ltr">
                        </div>
                            
                            
                            
                           
                            
                            
                              <div class="col-sm-6">
                            <label for="inputName39" class="pull-right control-label fields-name"> QD3 </label>
                            <input type="text" name="qdtex39" class="form-control input-lg" id="inputName39"  placeholder="QD3" style="text-align: left; direction: ltr">
                        </div>
                            
                            
                            
                           
                            
                            
                              <div class="col-sm-6">
                            <label for="inputName40" class="pull-right control-label fields-name"> QD4 </label>
                            <input type="text" name="qdtex40" class="form-control input-lg" id="inputName40"  placeholder="QD4" style="text-align: left; direction: ltr">
                        </div>
                        
                            
                            
-->
                            
                            
                            
                            
                    </div>  
                        <br>
                      <div class="form-group">
                        <div class="col-sm-12 pull-right">
                          <button name="login_utton" type="submit" class="btn btn-primary btn-lg"> إضافة الطلبية </button>
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
				/*qdtex1 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال رقم الطلبية"
						}
					}
				},*/ 
				qdtex2 : {
					validators: {
						notEmpty : {
							message : "يجب تحديد المخزن"
						}
					}
				/*},
                qdtex3 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال التاريخ"
						}
					}*/
				},
                qdtex4 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال رقم بوليصة الشحن"
						}
					}
				/*},
                qdtex5 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال كود المندوب"
						}
					}*/
				},
                qdtex6 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال السعر"
						}
					}
				},
                qdtex7 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال سعر الخدمة"
						}
					}
				/*},
                qdtex8 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال إجمالي المبلغ"
						}
					}*/
                },
                qdtex9 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال بيانات من سيقوم بتسديد القيمة"
						}
					}
				},
                qdtex10 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال بيانات الارفف"
						}
					}
				},
                qdtex11 : {
					validators: {
						notEmpty : {
							message : "يجب تحديد المنطقة"
						}
					}
				},
                qdtex12 : {
					validators: {
						notEmpty : {
							message : "يجب تحديد المدينة"
						}
					}
				},
                qdtex13 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال عنوان المستلم"
						}
                    }
				},
                qdtex14 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال اسم المستلم"
						}
					}
				},
                qdtex15 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال هاتف المستلم"
						}
					}
				},
                qdtex16 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال اسم المرسل"
						}
					}
				/*},
                qdtex17 : {
					validators: {
						notEmpty : {
							message : "يجب كود المشرف"
						}
					}*/
				},
                qdtex18 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال هاتف المرسل"
						}
					}
				/*},
                qdtex19 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال هذه البيانات"
						}
					}
				}*/,
                qdtex20 : {
					validators: {
						notEmpty : {
							message : "يجب تحديد حالة الشحن"
						}
					}
				}/*,
                qdtex21 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال التاريخ"
						}
					}
				},
                qdtex22 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال التاريخ"
						}
					}
				},
                qdtex23 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال حالة الباران "
						}
					}*/
				},
                qdtex24 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال عدد الطرود"
						}
					}
				},
                qdtex25 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال رقم الطرد"
						}
					}
				},
                qdtex26 : {
					validators: {
						notEmpty : {
							message : "يجب تحديد نوعية السلعة"
						}
					}
				},
                qdtex27 : {
					validators: {
						notEmpty : {
							message : "يجب تحديد نوع الخدمة"
						}
					}
				/*},
                qdtex28 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال تاريخ الاخطار الاول"
						}
					}
				},
                qdtex29 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال تاريخ الاخطار الثاني"
						}
					}
				},
                qdtex30 : {
					validators: {
						notEmpty : {
							message : "يجب تحديد أحد الخيارات"
						}
					}
				},
                qdtex31 : {
					validators: {
						notEmpty : {
							message : "يجب تحديد أحد الخيارات"
						}
					}
				},
                qdtex32 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال التاريخ"
						}
					}
				},
                qdtex33 : {
					validators: {
						notEmpty : {
							message : "يجب إخال الوزن"
						}
					}
				},
                qdtex34 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال الطول"
						}
					}
				},
                qdtex35 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال العرض"
						}
					}
				},
                qdtex36 : {
					validators: {
						notEmpty : {
							message : "يجب  إدخال الأرتفاع"
						}
					}
				},
                qdtex37 : {
					validators: {
						notEmpty : {
							message : "يجب  إدخال QD1"
						}
					}
				},
                qdtex38 : {
					validators: {
						notEmpty : {
							message : "يجب  إدخال QD2"
						}
					}
				},
                qdtex39 : {
					validators: {
						notEmpty : {
							message : "يجب  إدخال QD34"
						}
					}
				},
                qdtex40 : {
					validators: {
						notEmpty : {
							message : "يجب  إدخال QD4"
						}
					}
				},
                qdtex41 : {
					validators: {
						notEmpty : {
							message : "يجب إدخال الملاحظات "
						}
					}*/
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
