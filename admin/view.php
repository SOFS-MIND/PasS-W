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
<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="">
  <select name="stu_class" required>
  <option value="">Select</option>
<?php
$sel2 = "select * from student group by stu_class";
$from2 = mysql_query($sel2);
while($res2 = mysql_fetch_object($from2))
{
?>
  <option value="<?php echo $res2->stu_class; ?>"><?php echo $res2->stu_class; ?></option>
 <?php } ?>
 </select>
<input type="submit" class="btn2" name="view" value="View"/>
<input type="submit" class="btn2" name="delete" value="Delete"/>
</form>
<br />
   <table width="90%" border="1">
  	<tr style="color:#000000;background-color:#FFFFFF">
    <td width="14%" height="37" align="center"><strong>Register No</strong></td>
    <td width="16%" align="center"><strong>Name</strong></td>
    <td width="13%" align="center"><strong>Department</strong></td>
    <td width="10%" align="center"><strong>Year</strong></td>
    <td width="15%" align="center"><strong>Class Id</strong></td>
    </tr>
<?php
if(isset($_REQUEST['view']))
{
	$sel = "select * from student where stu_class = '".$_REQUEST['stu_class']."' order by stu_regno asc";
	
}
elseif(isset($_REQUEST['delete']))
{
	$del = "DELETE FROM `student` where stu_class = '".$_REQUEST['stu_class']."'";
	mysql_query($del);
	echo "<script type='text/javascript'> alert('Deleted Successfully');</script>";
	$sel = "select * from student order by stu_regno asc";
}
else
{
	$sel = "select * from student order by stu_regno asc";
}
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