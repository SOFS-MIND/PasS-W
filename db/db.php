<?php 
ob_start();
error_reporting(0);
date_default_timezone_set('asia/calcutta');
$con=mysql_connect('localhost','root','');
mysql_select_db("outpass",$con);
?>
