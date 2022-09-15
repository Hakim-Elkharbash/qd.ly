<?
$libyapages_host="localhost";
$libyapages_dbname="qdly_store"; 
$libyapages_username="qdly_libyapages"; 
$libyapages_password="FB*vTTy8LU%V"; 
mysql_connect("$libyapages_host", "$libyapages_username", "$libyapages_password")or die("Could not connect to the server!"); 
mysql_select_db("$libyapages_dbname")or die("Could not select database!"); 
mysql_query("SET NAMES 'utf8'"); 
mysql_query('SET CHARACTER SET utf8'); 
?>