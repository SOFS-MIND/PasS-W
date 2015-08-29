<?php 
session_start();
include_once "../db/db.php";

if($_REQUEST['Mode']=='Edit')
{
$sel="select * from `staff` where sf_id = '".$_REQUEST['sf_id']."'";
$from=mysql_query($sel);
$res=mysql_fetch_object($from);
}
if($_REQUEST['Mode']=='Delete')
{
$sql = "DELETE FROM `staff` WHERE `sf_id` = '".$_REQUEST['sf_id']."'";
mysql_query($sql);
echo "<meta http-equiv='refresh' content='0;url=sfview.php'>";
}

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
    <table width="80%" border="0" style="font-size:24px;border:1px solid">
    <tr>
    <td  colspan="4" align="right">&nbsp;</td>
    </tr>
  <tr>
  <td width="25%" height="63" align="right"><strong>Name&nbsp;:&nbsp;</strong></td>
  <td width="26%" align="left"><input type="text" name="sf_name" value="<?php echo $res->sf_name; ?>" required="required" /></td>
  <td width="17%" align="right"><strong>Emp. Id.&nbsp;:&nbsp;</strong></td>
  <td width="32%" align="left"><input type="text" name="sf_empno" value="<?php echo $res->sf_empno; ?>" required="required" /></td>
  </tr>
  <tr>
  <td width="25%" height="62" align="right"><strong>Department&nbsp;:&nbsp;</strong></td>
  <td width="26%" align="left">
  <select name="sf_dept" required>
  <option value="<?php echo $res->sf_dept; ?>"><?php echo $res->sf_dept; ?></option>
<?php
$sel1 = "select * from student group by stu_dept";
$from1 = mysql_query($sel1);
while($res1 = mysql_fetch_object($from1))
{
?>
  <option value="<?php echo $res1->stu_dept; ?>"><?php echo $res1->stu_dept; ?></option>
 <?php } ?>
 </select>
  </td>
  <td width="17%" align="right"><strong>Class Id&nbsp;:&nbsp;</strong></td>
  <td width="32%" align="left">
  <select name="sf_class" required>
  <option value="<?php echo $res->sf_class; ?>"><?php echo $res->sf_class; ?></option>
<?php
$sel2 = "select * from student group by stu_class";
$from2 = mysql_query($sel2);
while($res2 = mysql_fetch_object($from2))
{
?>
  <option value="<?php echo $res2->stu_class; ?>"><?php echo $res2->stu_class; ?></option>
 <?php } ?>
 </select>
  </td>
  </tr>
  <tr>
    <td height="63" align="right"><strong>Contact&nbsp;:&nbsp;</strong></td>
    <td align="left"><input type="text" name="sf_con" value="<?php echo $res->sf_con; ?>" required="required" pattern="[0-9]{10}"/></td>
    <td align="right"><strong>Password&nbsp;:&nbsp;</strong></td>
    <td align="left"><input type="password" name="sf_pwd" value="<?php echo $res->sf_pwd; ?>" required="required" /></td>
  </tr>
  <tr>
    <td height="50" colspan="4" align="center">
    <?php
	if($_REQUEST['Mode']=='Edit')
	{
	?>
    <input type="submit" name="update" value="UPDATE" class="btn2">
    <?php } else { ?>
    <input type="submit" name="submit" value="SUBMIT" class="btn2">
    <?php } ?>
    <a href="sfview.php" style="text-decoration:none"><input type="button" value="View" class="btn2" /></a> </td>
    </tr>
    <tr>
    <td  colspan="4" align="center">&nbsp;</td>
    </tr>
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
if(isset($_REQUEST['submit']))
{
$sql="INSERT INTO `staff` (`sf_name` ,
							`sf_empno` ,
							`sf_dept` ,
							`sf_class`,
							`sf_con`,
							`sf_pwd` )
					VALUES ('".$_REQUEST['sf_name']."',
							'".$_REQUEST['sf_empno']."', 
							'".$_REQUEST['sf_dept']."', 
							'".$_REQUEST['sf_class']."', 
							'".$_REQUEST['sf_con']."',
							'".$_REQUEST['sf_pwd']."')";

mysql_query($sql);
echo "<script type='text/x-javascript'>alert('Added Sucessfully');</script>";
echo "<meta http-equiv='refresh' content='0;url=staff.php'>";
}
elseif(isset($_REQUEST['update']))
{

$sql="update `staff` set sf_name = '".$_REQUEST['sf_name']."',
						  sf_empno = '".$_REQUEST['sf_empno']."',
						  sf_dept = '".$_REQUEST['sf_dept']."',
						  sf_class = '".$_REQUEST['sf_class']."',
						  sf_con = '".$_REQUEST['sf_con']."',
						  sf_pwd = '".$_REQUEST['sf_pwd']."'						  
					where sf_id = '".$_REQUEST['sf_id']."'";

mysql_query($sql);
echo "<script type='text/x-javascript'>alert('Updated Sucessfully');</script>";
echo "<meta http-equiv='refresh' content='0;url=sfview.php'>";

}
?>