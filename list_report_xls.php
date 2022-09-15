<?
ob_start();
session_start();
require_once 'PHPExcel/Classes/PHPExcel.php';
include("db.php");
$site_information=mysql_fetch_assoc(mysql_query("SELECT * FROM setting WHERE id='1'"));
//-------------------------
$time_zone=$site_information[zone_time];
date_default_timezone_set($time_zone);
$xls_file=$_SESSION['xls_file_se'];
// Instantiate a new PHPExcel object
$objPHPExcel = new PHPExcel(); 
// Set the active Excel worksheet to sheet 0
$objPHPExcel->setActiveSheetIndex(0); 
// Initialise the Excel row number

$rowCount=1;
foreach($xls_file as $key=>$val){
    $colCount = 'A'; 
        foreach($val as $k=>$v){
            $objPHPExcel->getActiveSheet()->SetCellValue($colCount.$rowCount, $v);
            $colCount++;
        }
    $rowCount++;
}
$objPHPExcel->getActiveSheet()->getStyle("A1:AM1")->getFont()->setBold(true);
$dat_time=date('d-m-Y');
$fname="QD_Reports_".$dat_time.'.xlsx';
   header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
   header('Content-Disposition: attachment; filename="'.$fname.'"');
  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save('php://output');

?>