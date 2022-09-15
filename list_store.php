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
<script src="dialog/bootbox.min.js"></script>
    
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
  
    <div class="container">
        <div class="text-center">
            <div class="panel panel-default col-lg-10 col-lg-offset-1" style="padding-bottom:20px !important">
               <div class="panel-heading" style="background-color: burlywood !important">
                    <h4 style="text-align:right;"> <i class="fa fa-archive fa-md"></i> إدارة مخزن Stores.. </h4>
                </div>
                <div class="panel-body ">              
                    
<?
$qd_list=mysql_query("SELECT * FROM qd_store");
 
                    
?>
<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th style="text-align:center; " class="success">ر.م</th>
      <th style="text-align:center; " class="success"> اسم المنطقة</th>
      <th style="text-align:center; " class="success">الاسم بالانجليزي</th>
      <th style="text-align:center; " class="success">الاسم بالعربي</th>
      <th style="text-align:center;" class="success">العمليات المطلوب القيام بها</th>
    </tr>
  </thead>
  <tbody>
<?
if (mysql_numrows($qd_list) > 0){
$i=1;
while($rows=mysql_fetch_array($qd_list)){
    echo '<tr>
      <td style="text-align:center;vertical-align: middle">'.$i.'</td>';
      
    $area_name=mysql_fetch_array(mysql_query("SELECT * FROM qd_areas WHERE id='$rows[area_id]'"));
    echo '<td style="text-align:center;vertical-align: middle">'.$area_name[area_ar].' ('.$area_name[area_en].')</td>';
        
    echo' <td style="text-align:center;vertical-align: middle">'.$rows[store_en].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[store_ar].'</td>
      <td style="text-align:center;vertical-align: middle">
        
        <a href="edit_store.php?id='.$rows[id].'" class="btn btn-info  btn-md navbar-btn">
                    تعديل&nbsp;
                <span class="fa fa-pencil-square-o"></span>
        </a>
            
        <a id="model-1" class="btn btn-danger btn-md navbar-btn" onclick="msg_info('.$rows[id].')" href="javascript:void(0);">
        حذف&nbsp;  <span class="fa fa-trash-o"></span>  </a>
  
         </td>
      </tr>';
$i++;
}

}else{
echo '<tr>
		<td colspan="4" style="text-align:right">
			 &nbsp;&nbsp;<span style=" font-size:15px; color: red; font-weight:bold;">لم يتم الحصول على أي نتائج..</span>&nbsp;&nbsp;
			 </td>
	</tr>';
}
echo '</tbody>
</table>';						

    
?>                
                    
                </div>
            </div>  
        </div>          
    </div> 
   

        
        
        
    <script>
        function msg_info(xx){
    
            bootbox.dialog({
              message: "<span style='font-size:16px; font-weight: bold'>هل ترغب بالفعل في حذف هذه البيانات</span>",
              title: "لوحة التحكم",
              buttons: {
                success: {
                  label: "إلغاء الامر",
                  className: "btn-success",
                  callback: function () {
                      bootbox.hideAll(); 
                  }
                 },
                danger: {
                  label: "حذف البيانات",
                  className: "btn-danger",
                  callback: function () {
                      location.href = "do_del_store.php?id="+xx;
                  }
                }
              }
            });
        }
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
