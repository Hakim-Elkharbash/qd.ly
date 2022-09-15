<?php
 if(isset($_POST['form_submit']))
 {
  include("db.php"); 
  require_once 'excel/excel_reader2.php';
  $file1 = $_FILES['excelfile']['tmp_name'];
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
  }
 }
?>