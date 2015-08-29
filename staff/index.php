<?php 
session_start();
include_once "../db/db.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include('../title.php') ?></title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="total">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="250" align="center"><img src="../images/banner.png" width="980" /></td>
    </tr>
</table>
<table width="100%" border="0" class="table2">
  <tr>
    <td height="60" align="center">
<span class="menu"><?php include('menu.php') ?> </span></td>
  </tr>
</table>
<table width="100%" border="0">
  <tr>
    <td colspan="7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7" align="center"><h1>Student Details</h1></td>
  </tr>
  <tr>
    <td colspan="7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7" align="center">
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
   <table width="90%" border="1">
  	<tr style="color:#000000;background-color:#FFFFFF">
    <td width="17%" height="37" align="center"><strong>Register No</strong></td>
    <td width="19%" align="center"><strong>Name</strong></td>
    <td width="16%" align="center"><strong>Department</strong></td>
    <td width="13%" align="center"><strong>Year</strong></td>
    <td width="23%" align="center"><strong>Class Id</strong></td>
    <td width="12%" align="center"><strong>OD</strong></td>
    </tr>
<?php
$sel = "select * from student where stu_class = '".$_SESSION['user_class']."' order by stu_regno asc";
$from = mysql_query($sel);
while($res=mysql_fetch_object($from))
{
?>   
    <tr>
    <td height="43" align="center"><strong><?php echo $res->stu_regno; ?></strong></td>
    <td align="center"><strong><?php echo $res->stu_name; ?></strong></td>
    <td align="center"><strong><?php echo $res->stu_dept; ?></strong></td>
    <td align="center"><strong><?php echo $res->stu_year; ?></strong></td>
    <td align="center"><strong><?php echo $res->stu_class; ?></strong></td>
    <td align="center">
    <input type="checkbox" name="stu_id_<?php echo $res->stu_id; ?>" value="<?php echo $res->stu_id; ?>" />
	</td>
    </tr>
    
<?php } ?>
  </table>
  <br />
<br />
<strong>Date&nbsp;:&nbsp;</strong><input name="od_date" type="text" required="required"/> &nbsp;&nbsp;&nbsp;&nbsp; 
<strong>Time&nbsp;:&nbsp;</strong><input name="od_time" type="text" required="required"/>
<br />
<strong>Reason&nbsp;:&nbsp;</strong><textarea name="od_reason" cols="" rows="" required="required"></textarea> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="submit" type="submit" value="Submit" class="btn2" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</form>
    </td>
  </tr>
  
  <tr>
     <td colspan="7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7">&nbsp;</td>
  </tr>
</table>
</div>
<br />
<?php include('../footer.php') ?>
</body>
</html>
<?php
if(isset($_REQUEST['submit']))
{
$sel = "select * from student where stu_class = '".$_SESSION['user_class']."' order by stu_regno asc";
$from = mysql_query($sel);
$date = $_REQUEST['od_date'];
$time = $_REQUEST['od_time'];
$reason = $_REQUEST['od_reason'];
while($res=mysql_fetch_object($from))
{
$re='stu_id_'.$res->stu_id;
if($_REQUEST[$re] !='')
{
$ins="insert into `od` (`od_stu`,`od_sf`,`od_date`,`od_time`,`od_reason`)
						VALUES ('".$_REQUEST[$re]."','".$_SESSION['user_id']."','".$date."','".$time."','".$reason."')";
mysql_query($ins);
}
}
	echo "<script type='text/javascript'> alert('Added Successfully');</script>";
	echo "<meta http-equiv='refresh' content='0;url=view.php'>";

}
?>