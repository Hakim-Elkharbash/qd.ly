<?php
include("db.php"); 
$site_information=mysql_fetch_assoc(mysql_query("SELECT * FROM setting WHERE id='1'"));
$time_zone=$site_information['zone_time'];
date_default_timezone_set($time_zone);
$dat_tim=date('d/m/Y  H:i:s');
ini_set('display_errors',1);
 if(isset($_POST['form_submit']))
 {
  require_once '/home/qdly/public_html/PHPExcel/Classes/PHPExcel.php';
  require_once '/home/qdly/public_html/PHPExcel/Classes/PHPExcel/IOFactory.php';

$file1 = $_FILES['excelfile']['tmp_name'];
try {
	$objPHPExcel = PHPExcel_IOFactory::load($file1);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}
     
$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
//print_r($allDataInSheet);


echo "<table><tr><th>Title</th><th>Price</th><th>Number</th></tr>";
foreach($allDataInSheet as $v){
    echo "<tr>";
    foreach($v as $vv){
        echo "<td>{$vv}</td>";
    }
    echo "<tr>";
}
echo "</table>";

/*
for($i=3;$i<=$arrayCount;$i++){
echo $userName = trim($allDataInSheet[$i]["A"]);
echo " ";    
echo $userMobile = trim($allDataInSheet[$i]["B"]);
echo "<br>";
}
/*     
$objPHPExcel = PHPExcel_IOFactory::load($file1);

foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
    $worksheetTitle     = $worksheet->getTitle();
    $highestRow         = $worksheet->getHighestRow(); // e.g. 10
    $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
    $nrColumns = ord($highestColumn) - 64;
    echo "<br>The worksheet ".$worksheetTitle." has ";
    echo $nrColumns . ' columns (A-' . $highestColumn . ') ';
    echo ' and ' . $highestRow . ' row.<BR><BR>';
}
   /*  
  $data = new Spreadsheet_Excel_Reader($file1);
  $sheet = $data->sheets[0];
  $rows = $sheet['cells'];
     print_r($rows);
  $rowCount = count($rows);
    echo $rowCount;
  for($i=2;$i<=$rowCount;$i++)
  {
    $name = $data->val($i,1);
    $email = $data->val($i,2);
    $password = $data->val($i,3);
    $sql = "insert into $tabel_name (`name`,`email`,`password`) values ('$name','$email','$password')";
    mysql_query($sql);
  }*/
 }
?>