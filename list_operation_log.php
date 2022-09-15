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

    
    
<script type="text/javascript">
var flg=true;
$(document).on("click","#search_op",function(){
if (flg){
$("#search_area").slideUp('slow');
flg=false;
}else{
$("#search_area").slideDown('slow');
flg=true;
}
});

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
$state_fg=false;
$store_fg=false;
$area_fg=false;
$city_fg=false;
?>   
    
    <div class="container">
        <div class="text-center">
            <div class="panel panel-default col-lg-10 col-lg-offset-1" style="padding-bottom:20px !important">
               <div class="panel-heading" style="background-color: burlywood !important">
                   <a class="btn navbar-btn btn-info pull-left" id="search_op" title="إخفاء / إظهار خيارات البحث"> <i class="fa fa-search"></i></a>
                   <h4 style="text-align:right;"> <i class="fa fa-file-text fa-md"></i> تقرير متابعة الطلبيات والمستخدمين.. </h4>

                </div>
                <div class="panel-body ">              
             
                    
                    
                    <div class="well well-lg" id="search_area">
                    
                    <form action="" method="post" class="form-horizontal" id="qd-form" name="qd-form-nm">
                        <div class="form-group">
                            <div class="col-sm-6">
                            <label for="inputName1" class="pull-right control-label fields-name"> رقم بوليصة الشحن أو الباران </label>
                            <input type="text" name="way_bill" class="form-control input-lg" id="inputName1"  placeholder="إدخل رقم البوليصة" style="text-align: left; direction: ltr">
                
                            </div>
                            
                            
                            
                            <div class="col-sm-6">
                            <label for="inputName1" class="pull-right control-label fields-name"> المستخدمين </label>
                            <select name="usrlist" class="form-control input-lg">
                              <?
                                echo "<option value='all'> كل المستخدمين </option>";
                               $qd_list_usr=mysql_query("SELECT * FROM sys_users_lp WHERE occupation='qd_employee' OR occupation='others'");
                                while($rows=mysql_fetch_array($qd_list_usr)){
                                    echo "<option value='".$rows[fullname]."'>".$rows[fullname]."</option>";
                                }
                              ?>
                            </select>                
                            </div>
                            
                           
                        <?
                        $permissions_all= explode(" ",$qd_list[access_services]);
                        if (in_array('21', $permissions_all)){
                        $xls_flag=true;
                        }
    
                        ?>    
                            
                            
                            
                        </div>
                        <hr>
                        <div class="form-group">
                        <div class="col-sm-12 pull-right">
<?
    echo '<button name="login_utton" type="submit" class="btn btn-primary btn-lg"> البحث وفقاً للشروط </button>';
?>
                          
                        </div>
                      </div>
                    </form>
                        
                    </div>
<div style="overflow-x: scroll; text-align:center;">                   
<?

//----------- pagination
$sr_no=$site_information[rows];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

unset($_SESSION[qu]);
unset($_SESSION[xls_file_se]);

$pp=0;
$way_bill=$_POST['way_bill'];
$usrlist=$_POST['usrlist'];

$where_flag=false;

if ($way_bill==''){
$way_bill='';
}else{
$where_flag=true;
$way_bill=" (order_id = '$way_bill')"." && ";
} 

if ($usrlist=='all'){
$usrlist='';
}else{
$where_flag=true;
$usrlist=" (user_info = '$usrlist')"." && ";
} 
    

if ($where_flag==true){ 
$string=$way_bill.$usrlist;
$st_qu=substr($string, 0, -3);
$st_qu_all="SELECT * FROM qd_log WHERE ".$st_qu." ORDER BY data_time DESC";
$st_qu_lm="SELECT * FROM qd_log WHERE ".$st_qu." ORDER BY data_time DESC LIMIT $pp,$sr_no";
}else{
$st_qu_all="SELECT * FROM qd_log ORDER BY data_time DESC";
$st_qu_lm="SELECT * FROM qd_log ORDER BY data_time DESC LIMIT $pp,$sr_no";
}
    
$_SESSION['qu']=$st_qu_all;
$qd_list=mysql_query($st_qu_lm);
   // echo $st_qu_all;

if (mysql_numrows($qd_list) > 0){
echo '
<a href="list_operation_wide_view.php" target="_blank" class="btn btn-warning navbar-btn btn-sm pull-left">
                                    <span class="fa fa-eye"></span>

                    &nbsp;عرض  البيانات في صفحة منفصلة 
                </a> ';
if ($xls_flag){
echo '
<a href="list_report_xls.php" class="btn btn-success navbar-btn btn-sm pull-left" style="margin-left: 5px; margin-right:5px">
                                    <span class="fa fa-file-excel-o"></span>

                    &nbsp;تحميل كملف Excel 
                </a>';
}

}

$row_xls=0;
$col_xls=0;

echo '                    
<table class="table table-striped table-hover table-responsive" style="white-space: nowrap; max-width: none; width: auto;">
  <thead>
    <tr>
     <th style="text-align:center; width:5%" class="success">ر.م</th>';
      echo '<th style="text-align:center; width:10%" class="success">رقم البوليصة / الباران</th>';
      $xls_file[$row_xls][$col_xls]='بوليصة الشحن / الباران';
      $col_xls++;
      echo '<th style="text-align:center; width:30%" class="success">العملية</th>';
      $xls_file[$row_xls][$col_xls]='العملية';
      $col_xls++;
      echo '<th style="text-align:center; width:15%" class="success">التفاصيل</th>';
      $xls_file[$row_xls][$col_xls]='التفاصيل';
      $col_xls++;
      echo '<th style="text-align:center; width:25%" class="success">المستخدم</th>';
      $xls_file[$row_xls][$col_xls]='المستخدم';
      $col_xls++;
      echo '<th style="text-align:center; width:15%" class="success">التاريخ والوقت</th>';
      $xls_file[$row_xls][$col_xls]='التاريخ والوقت';
      $col_xls++;
    echo '</tr>
  </thead>
  <tbody>';

if (mysql_numrows($qd_list) > 0){
//------------------------------ Excel File    
$qd_list_xls=mysql_query($st_qu_all);
while($rows_xls=mysql_fetch_array($qd_list_xls)){
    $row_xls++;
    $col_xls=0;
    $xls_file[$row_xls][$col_xls]=$rows_xls[order_id];
    $col_xls++;  
    $xls_file[$row_xls][$col_xls]=$rows_xls[operation];
    $col_xls++;  
    $xls_file[$row_xls][$col_xls]=$rows_xls[details];
    $col_xls++;  
    $xls_file[$row_xls][$col_xls]=$rows_xls[user_info];
    $col_xls++;  
    $xls_file[$row_xls][$col_xls]=$rows_xls[data_time];
    $col_xls++;  
  }
$_SESSION['xls_file_se']=$xls_file;
//------------------------------      

$i=1;
while($rows=mysql_fetch_array($qd_list)){
    echo '<tr>
      <td style="text-align:center;vertical-align: middle">'.$i.'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[order_id].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[operation].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[details].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[user_info].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[data_time].'</td>
      </tr>';
$i++;
}

}else{
echo '<tr>
		<td colspan="6" style="text-align:right">
			 &nbsp;&nbsp;<span style=" font-size:15px; color: red; font-weight:bold;">لم يتم الحصول على أي نتائج..</span>&nbsp;&nbsp;
			 </td>
	</tr>';
}
echo '</tbody>
</table>';						
    
if (mysql_numrows($qd_list) > 0){
echo '
<a href="list_operation_wide_view.php" target="_blank" class="btn btn-warning navbar-btn btn-sm pull-left">
                                    <span class="fa fa-eye"></span>

                    &nbsp;عرض  البينات في صفحة منفصلة 
                </a> ';
if ($xls_flag){
echo '
<a href="list_report_xls.php" class="btn btn-success navbar-btn btn-sm pull-left" style="margin-left: 5px; margin-right:5px">
                                    <span class="fa fa-file-excel-o"></span>

                    &nbsp;تحميل كملف Excel 
                </a>';
}

}
    
}







if((isset($_SESSION['qu']))&&(($_SERVER['REQUEST_METHOD'] <> 'POST'))){
$pp=$_GET['page'];
if ($pp=='' || $pp=='1'){
$pp=0;
}else{
$pp=($pp*$sr_no)-$sr_no;
}
$rs_qur=$_SESSION['qu'];
$rs_qur=$rs_qur." LIMIT $pp,$sr_no ";
$qd_list=mysql_query($rs_qur);
    
if (mysql_numrows($qd_list) > 0){
echo '
<a href="list_operation_wide_view.php" target="_blank" class="btn btn-warning navbar-btn btn-sm pull-left">
                                    <span class="fa fa-eye"></span>

                    &nbsp;عرض  البينات في صفحة منفصلة 
                </a> ';
if ($xls_flag){
echo '
<a href="list_report_xls.php" class="btn btn-success navbar-btn btn-sm pull-left" style="margin-left: 5px; margin-right:5px">
                                    <span class="fa fa-file-excel-o"></span>

                    &nbsp;تحميل كملف Excel 
                </a>';
}
    
}
    
echo '                    
<table class="table table-striped table-hover table-responsive" style="white-space: nowrap; max-width: none; width: auto;">
  <thead>
    <tr>
     <th style="text-align:center; width:5%" class="success">ر.م</th>
      <th style="text-align:center; width:10%" class="success">رقم البوليصة / الباران</th>
      <th style="text-align:center; width:30%" class="success">العملية</th>
      <th style="text-align:center; width:15%" class="success">التفاصيل</th>
      <th style="text-align:center; width:25%" class="success">المستخدم</th>
      <th style="text-align:center; width:15%" class="success">التاريخ والوقت</th>
    </tr>
  </thead>
  <tbody>';


if (mysql_numrows($qd_list) > 0){
$i=$pp+1;
while($rows=mysql_fetch_array($qd_list)){
    echo '<tr>
      <td style="text-align:center;vertical-align: middle">'.$i.'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[order_id].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[operation].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[details].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[user_info].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[data_time].'</td>
      </tr>';
$i++;
}

}else{
echo '<tr>
		<td colspan="6" style="text-align:right">
			 &nbsp;&nbsp;<span style=" font-size:15px; color: red; font-weight:bold;">لم يتم الحصول على أي نتائج..</span>&nbsp;&nbsp;
			 </td>
	</tr>';
}
echo '</tbody>
</table>';						
}






//------ pagiantion
if(!isset($_SESSION['qu'])){
$qd_list=mysql_query($st_qu_all);
}else{
$qd_list=mysql_query($_SESSION['qu']);
}
if((isset($_SESSION['qu']))||(($_SERVER['REQUEST_METHOD'] == 'POST'))){
$pags=ceil(mysql_numrows($qd_list)/$site_information[rows]);
}
if ($pags>1){
echo'
<nav class="text-center">
  <ul class="pagination">';
    //<li>
      //<a href="#" aria-label="Previous">
       // <span aria-hidden="true">&laquo;</span>
      //</a>
    //</li>
    for ($i=1;$i<=$pags;$i++){
    echo '<li><a href="?page='.$i.'">'.$i.'</a></li>';
    }
    //<li>
      //<a href="#" aria-label="Next">
        //<span aria-hidden="true">&raquo;</span>
      //</a>
    //</li>
    echo '
  </ul>
</nav>';
}
?>   
                    
    </div>
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
        
        
      
       
        
        
        
        
</body>

</html>
