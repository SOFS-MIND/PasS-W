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
<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="">
<table width="100%" border="0">
  <tr>
    <td colspan="7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7" align="center"><h1>Staff Details</h1></td>
  </tr>
  <tr>
    <td colspan="7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7" align="center">
   <table width="90%" border="1">
  	<tr style="color:#000000;background-color:#FFFFFF">
    <td width="14%" height="37" align="center"><strong>Employee No</strong></td>
    <td width="16%" align="center"><strong>Name</strong></td>
    <td width="13%" align="center"><strong>Department</strong></td>
    <td width="10%" align="center"><strong>Contact No</strong></td>
    <td width="15%" align="center"><strong>Class Id</strong></td>
    <td width="15%" align="center"><strong>Action</strong></td>
  	</tr>
<?php
$sel = "select * from staff order by sf_empno asc";
$from = mysql_query($sel);
while($res=mysql_fetch_object($from))
{
?>   
    <tr>
    <td height="43" align="center"><strong><?php echo $res->sf_empno; ?></strong></td>
    <td align="center"><strong><?php echo $res->sf_name; ?></strong></td>
    <td align="center"><strong><?php echo $res->sf_dept; ?></strong></td>
    <td align="center"><strong><?php echo $res->sf_con; ?></strong></td>
    <td align="center"><strong><?php echo $res->sf_class; ?></strong></td>
    <td align="center">
     <a href="staff.php?sf_id=<?php echo $res->sf_id; ?>&Mode=Edit" style="text-decoration:none">
    <img src="../images/edit.png" width="35" height="36" /></a>&nbsp;&nbsp;&nbsp;
    <a href="staff.php?sf_id=<?php echo $res->sf_id; ?>&Mode=Delete" style="text-decoration:none" onclick="return confirm('Are You Sure To Delete')">
    <img src="../images/delete.png" width="35" height="36" /></a>     </td>
  	</tr>
    
<?php } ?>
  </table>
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
</form>
</div>
<br />
<?php include('../footer.php') ?>
</body>
</html>
<?php
if(isset($_POST['submit']))
{
$list = $_POST['class_id']."-".$_FILES['stu_list']['name'];
$path = "../list/".$list;
move_uploaded_file($_FILES["stu_list"]["tmp_name"],$path);
$class = $_REQUEST['class_id'];
$fileTemp = $path;
$fp = fopen($fileTemp,'r');
$datas = array();
while(($data = fgetcsv($fp)) !== FALSE)
{
$data['name'] = trim($data[1]);
$data['regno'] = trim($data[2]);
$data['dept'] = trim($data[3]);
$data['year'] = trim($data[4]);
$sql = "insert into student(stu_name,stu_regno,stu_dept,stu_year,stu_class)
					values('".$data['name']."','".$data['regno']."','".$data['dept']."','".$data['year']."','".$class."')";
mysql_query($sql);
}
	echo "<script type='text/javascript'> alert('Added Successfully');</script>";
	echo "<meta http-equiv='refresh' content='0;url=index.php'>";

}
?>