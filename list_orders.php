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
checked = false;
function checkedAll () {
if (checked == false){checked = true}else{checked = false}
for (var i = 0; i < document.getElementById('qd-form2').elements.length; i++) {
document.getElementById('qd-form2').elements[i].checked = checked;
}}
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
                   <h4 style="text-align:right;"> <i class="fa fa-pencil-square-o fa-md"></i> إدارة الطلبيات.. </h4>

                </div>
                <div class="panel-body ">              
             
                    
                    
                    <div class="well well-lg" id="search_area">
                    
                    <form action="" method="post" class="form-horizontal" id="qd-form" name="qd-form-nm">
                        <div class="form-group">
                            <div class="col-sm-3">
                            <label for="inputName1" class="pull-right control-label fields-name"> بوليصة الشحن </label>
                            <input type="text" name="way_bill" class="form-control input-lg" id="inputName1"  placeholder="بوليصة الشحن أو الباران" style="text-align: left; direction: ltr">
                            </div>
                            
                            <div class="col-sm-3">
                            <label for="inputName1" class="pull-right control-label fields-name"> كود المشرف </label>
                            <input type="text" name="shipper_code" class="form-control input-lg" id="inputName1"  placeholder="كود المشرف" style="text-align: left; direction: ltr">
                            </div>
                            
                            <div class="col-sm-3">
                            <label for="inputName1" class="pull-right control-label fields-name"> كود المندوب </label>
                            <input type="text" name="code" class="form-control input-lg" id="inputName1"  placeholder="كود المندوب" style="text-align: left; direction: ltr">
                            </div> 
                            
                            <div class="col-sm-3">
                            <label for="inputName1" class="pull-right control-label fields-name">  رقم الطلبية </label>
                            <input type="text" name="order_no" class="form-control input-lg" id="inputName1"  placeholder="رقم الطلبية" style="text-align: left; direction: ltr">
                
                            </div> 
                            
                            
                            <div class="col-sm-3">
                            <label for="inputName1" class="pull-right control-label fields-name"> حالة الطلبية </label>
                            <select name="orlist" class="form-control input-lg">
                              <?
                                echo "<option value='all'> كل الحالات </option>";
                               $permissions_stt= explode(" ",$qd_list[access_status]);
                               $qd_list_stt=mysql_query("SELECT * FROM qd_state");
                                $state_query='';
                                while($rows=mysql_fetch_array($qd_list_stt)){
                                  if (in_array($rows[id], $permissions_stt)){ 
                                    echo "<option value='".$rows[state_en]."'>".$rows[state_ar]." (".$rows[state_en].")</option>";
                                    $state_query=$state_query." shipment_state_en = '$rows[state_en]'"." || ";
                                    $state_fg=true;
                                  }
                                }
                              ?>
                            </select>                
                            </div>
                            
                            <div class="col-sm-3">
                            <label for="inputName1" class="pull-right control-label fields-name">  تحديد المخزن </label>
                            <select name="stlist" class="form-control input-lg">
                              <?
                                echo "<option value='all'> كل المخازن </option>";
                               $permissions_st= explode(" ",$qd_list[access_stores]);
                               $qd_list_st=mysql_query("SELECT * FROM qd_store");
                                $store_query='';
                                while($rows=mysql_fetch_array($qd_list_st)){
                                    if (in_array($rows[id], $permissions_st)){ 
                                        echo "<option value='".$rows[store_en]."'>".$rows[store_ar]." (".$rows[store_en].")</option>";
                                        $store_query=$store_query." store = '$rows[store_en]'"." || ";
                                        $store_fg=true;
                                    }
                                }
                              ?>
                            </select> 
                            </div>
                            
                            <div class="col-sm-3">
                            <label for="inputName1" class="pull-right control-label fields-name">  تحديد المنطقة </label>
                            <select name="arlist" class="form-control input-lg">
                              <?
                                echo "<option value='all'> كل المناطق </option>";
                               $permissions_ar= explode(" ",$qd_list[access_areas]);
                               $qd_list_ar=mysql_query("SELECT * FROM qd_areas");
                                $area_query='';
                                while($rows=mysql_fetch_array($qd_list_ar)){
                                  if (in_array($rows[id], $permissions_ar)){ 
                                    echo "<option value='".$rows[area_en]."'>".$rows[area_ar]." (".$rows[area_en].")</option>";
                                    $area_query=$area_query." area = '$rows[area_en]'"." || ";
                                    $area_fg=true;
                                  }
                                }
                              ?>
                            </select> 
                            </div>
                            
                            <div class="col-sm-3">
                            <label for="inputName1" class="pull-right control-label fields-name"> تحديد المدينة </label>
                            <select name="ctlist" class="form-control input-lg">
                              <?
                                echo "<option value='all'>  كل المدن </option>";
                               $permissions_ct= explode(" ",$qd_list[access_city]);
                               $qd_list_ct=mysql_query("SELECT * FROM qd_city");
                                $city_query='';
                                while($rows=mysql_fetch_array($qd_list_ct)){
                                  if (in_array($rows[id], $permissions_ct)){ 
                                    echo "<option value='".$rows[city_en]."'>".$rows[city_ar]." (".$rows[city_en].")</option>";
                                    $city_query=$city_query." city = '$rows[city_en]'"." || ";
                                    $city_fg=true;
                                  }
                                }
                              ?>
                            </select>                
                            </div>
                            
                            
                            
                        </div>
                        <hr>
                        
                            
                        <div class="form-group">
                        <div class="col-sm-12 pull-right">
                            
                        <?
                        $permissions_all= explode(" ",$qd_list[access_services]);
                        if (in_array('17', $permissions_all)){
                        $all_flag=true;
                        }

                            if (($store_fg && $state_fg && $area_fg && $city_fg)||($all_flag)){
                                    echo '<button name="login_utton" type="submit" class="btn btn-primary btn-lg"> البحث وفقاً للشروط </button>';
                                }else{
                                    echo '<button name="login_utton" type="submit" class="btn btn-primary btn-lg" disabled="disabled"> البحث وفقاً للشروط </button>';
                                }
                        if ($all_flag){
                            echo '<div class="checkbox-inline">
                               <label for="inputNamech"> Unlimited Access  </label>
                                <input type="checkbox" value="all" name="view_all" id="inputNamech">
                            </div>';
                            }
                         ?> 
                        </div>
                      </div>
                    </form>
                        
                    </div>
                    
<form action="do_del_selected_orders.php" method="post"  id="qd-form2" name="qd-form-nm2">
<div>                 

<?

if (in_array('19', $permissions_all)){
    $del_all_flag=true;
}

//----------- pagination
$sr_no=$site_information[rows];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 

echo "
<script type=\"text/javascript\">
$('#search_area').slideUp('slow');
flg=false;
</script>
";
    
    
unset($_SESSION[qu]);
$pp=0;
if ($view_all=$_POST['view_all']<>'all'){
$way_bill=$_POST['way_bill'];
$shipper_code=$_POST['shipper_code'];
$code=$_POST['code'];
$order_no=$_POST['order_no'];
$orlist=$_POST['orlist'];
$stlist=$_POST['stlist'];
$arlist=$_POST['arlist'];
$ctlist=$_POST['ctlist'];

$where_flag=false;

if ($way_bill==''){
$way_bill='';
}else{
$where_flag=true;
$way_bill=" (way_bill = '$way_bill')"." && ";
} 

if ($shipper_code==''){
$shipper_code='';
}else{
$where_flag=true;
$shipper_code=" (shipper_code = '$shipper_code')"." && ";
} 
    
if ($code==''){
$code='';
}else{
$where_flag=true;
$code=" (code = '$code')"." && ";
} 

    
if ($order_no==''){
$order_no='';
}else{
$where_flag=true;
$order_no=" (order_no = '$order_no')"." && ";
} 

    
if ($orlist=='all'){
$state_query=substr($state_query, 0, -3); 
$orlist="(".$state_query.") &&";
$where_flag=true;
}else{
$where_flag=true;
$orlist=" shipment_state_en = '$orlist'"." && ";
} 

    
if ($stlist=='all'){
$store_query=substr($store_query, 0, -3); 
$stlist="(".$store_query.") &&";
$where_flag=true;
}else{
$where_flag=true;
$stlist=" store = '$stlist'"." && ";
} 

    
if ($arlist=='all'){   
$area_query=substr($area_query, 0, -3); 
$arlist="(".$area_query.") &&";
$where_flag=true;
}else{
$where_flag=true;
$arlist=" area = '$arlist'"." && ";
} 

    
if ($ctlist=='all'){   
$city_query=substr($city_query, 0, -3); 
$ctlist="(".$city_query.") &&";
$where_flag=true;
}else{
$where_flag=true;
$ctlist=" city = '$ctlist'"." && ";
} 


if ($where_flag==true){ 
$string=$way_bill.$shipper_code.$code.$order_no.$orlist.$stlist.$arlist.$ctlist;
$st_qu=substr($string, 0, -3);
$st_qu_all="SELECT * FROM qd_orders WHERE ".$st_qu;
$st_qu_lm="SELECT * FROM qd_orders WHERE ".$st_qu." LIMIT $pp,$sr_no";
}else{
$st_qu_all="SELECT * FROM qd_orders";
$st_qu_lm="SELECT * FROM qd_orders LIMIT $pp,$sr_no";
}


}else{
    
echo '<div class="alert alert-danger" role="alert"  style="font-size: 16px; font-weight: bold; text-align: right">
    <i class="fa fa-info fa-lg"></i>
 ملاحظة: الوصول للبيانات غير محدد بشروط، تم جلب كل البيانات المتوفرة في قاعدة البيانات.
</div>';
    
$st_qu_all="SELECT * FROM qd_orders";
$st_qu_lm="SELECT * FROM qd_orders LIMIT $pp,$sr_no";
}
    
$_SESSION['qu']=$st_qu_all;
$qd_list=mysql_query($st_qu_lm);
 
    //echo $st_qu_all;    

echo '                    
<table class="table table-striped table-hover table-responsive">
  <thead>
    <tr>
      <th style="text-align:center; " class="success">ر.م</th>';
    if ($del_all_flag){
     echo '<th style="text-align:center; " class="success"> خاص بالحذف <br> <input name="checkall" type="checkbox" onclick="checkedAll();"></th>';
    }
     echo '<th style="text-align:center; " class="success">رقم البوليصة أو الباران</th>
      <th style="text-align:center; " class="success">المدينة</th>
      <th style="text-align:center; " class="success">رقم الطلبية</th>
      <th style="text-align:center; " class="success">الحالة</th>
      <th style="text-align:center;" class="success">العمليات المطلوب القيام بها</th>
    </tr>
  </thead>
  <tbody>';

if (mysql_numrows($qd_list) > 0){
$i=1;
while($rows=mysql_fetch_array($qd_list)){
    echo '<tr>
      <td style="text-align:center;vertical-align: middle">'.$i.'</td>';
      if ($del_all_flag){
      echo '<td style="text-align:center;vertical-align: middle">';
      echo '<input name="itm_id['.$rows[way_bill].']" value="'.$rows[way_bill].'" type="checkbox">'; 
      echo '</td>';
      }
      echo '<td style="text-align:center;vertical-align: middle">'.$rows[way_bill].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[city].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[order_no].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[shipment_state_en].'</td>
      <td style="text-align:center;vertical-align: middle">
        
        <a href="edit_order.php?id='.$rows[id].'" class="btn btn-info  btn-md navbar-btn">
                    تعديل&nbsp;
                <span class="fa fa-pencil-square-o"></span>
        </a>&nbsp;';
        
        
        echo '<a id="model-1" class="btn btn-danger btn-md navbar-btn" onclick="msg_info('.$rows[id].')" href="javascript:void(0);">
        حذف&nbsp;  <span class="fa fa-trash-o"></span>  </a>';
           
     echo ' </td>
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
    
}








if((isset($_SESSION['qu']))&&(($_SERVER['REQUEST_METHOD'] <> 'POST'))){
    
 echo "
<script type=\"text/javascript\">
$('#search_area').slideUp('slow');
flg=false;
</script>
";
  

$pp=$_GET['page'];
if ($pp=='' || $pp=='1'){
$pp=0;
}else{
$pp=($pp*$sr_no)-$sr_no;
}
$rs_qur=$_SESSION['qu'];
$rs_qur=$rs_qur." LIMIT $pp,$sr_no ";
$qd_list=mysql_query($rs_qur);
    

    
echo '                    
<table class="table table-striped table-hover table-responsive">
  <thead>
    <tr>
      <th style="text-align:center; " class="success">ر.م</th>';
    if ($del_all_flag){
     echo '<th style="text-align:center; " class="success"> خاص بالحذف <br> <input name="checkall" type="checkbox" onclick="checkedAll();"></th>';
    }
     echo' <th style="text-align:center; " class="success">رقم العنصر</th>
      <th style="text-align:center; " class="success">المدينة</th>
      <th style="text-align:center; " class="success">رقم الطلبية</th>
      <th style="text-align:center; " class="success">الحالة</th>
      <th style="text-align:center;" class="success">العمليات المطلوب القيام بها</th>
    </tr>
  </thead>
  <tbody>';

if (mysql_numrows($qd_list) > 0){
$i=$pp+1;
while($rows=mysql_fetch_array($qd_list)){
    echo '<tr>
      <td style="text-align:center;vertical-align: middle">'.$i.'</td>';
      if ($del_all_flag){
      echo '<td style="text-align:center;vertical-align: middle">';
      echo '<input name="itm_id['.$rows[way_bill].']" value="'.$rows[way_bill].'" type="checkbox">'; 
      echo '</td>';
      }
      echo '<td style="text-align:center;vertical-align: middle">'.$rows[way_bill].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[city].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[order_no].'</td>
      <td style="text-align:center;vertical-align: middle">'.$rows[shipment_state_en].'</td>
      <td style="text-align:center;vertical-align: middle">
        
        <a href="edit_order.php?id='.$rows[id].'" class="btn btn-info  btn-md navbar-btn">
                    تعديل&nbsp;
                <span class="fa fa-pencil-square-o"></span>
        </a>&nbsp;';
        
        
        echo '<a id="model-1" class="btn btn-danger btn-md navbar-btn" onclick="msg_info('.$rows[id].')" href="javascript:void(0);">
        حذف&nbsp;  <span class="fa fa-trash-o"></span>  </a>';
           
     echo ' </td>
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
    
    
<?
 echo "<br>"; 
if (($qd_list<>NULL)&&($del_all_flag)){
if (mysql_numrows($qd_list) > 0){
    echo '
       <div class="well"  style="height: 95px">            
                <div class="col-sm-3 col-sm-offset-4">
                    <a class="btn btn-danger btn-lg navbar-btn" id="model-2" onclick="msg_info_del()" href="javascript:void(0);" name="login_utton" class="btn btn-danger btn-lg"> حذف كل العناصر المحددة </a>

            </div>
        </div>'; 
    } 
}
?>
</form>
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
                      location.href = "do_del_order.php?id="+xx;
                  }
                }
              }
            });
        }
        
        
      function msg_info_del(){
    
            bootbox.dialog({
              message: "<span style='font-size:16px; font-weight: bold'>هل ترغب بالفعل في حذف البيانات المحددة</span>",
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
                      $('#qd-form2').submit();
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
