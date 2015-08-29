<?php 
session_start();
include_once "../db/db.php";

if($_REQUEST['Mode']=='Edit')
{
$sel="select * from `security` where sec_id = '".$_REQUEST['sec_id']."'";
$from=mysql_query($sel);
$res=mysql_fetch_object($from);
}
if($_REQUEST['Mode']=='Delete')
{
$sql = "DELETE FROM `security` WHERE `sec_id` = '".$_REQUEST['sec_id']."'";
mysql_query($sql);
echo "<meta http-equiv='refresh' content='0;url=secview.php'>";
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
    <td colspan="7" align="center"><h1>Security Details</h1></td>
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
  <td width="19%" height="84" align="right"><strong>Name&nbsp;:&nbsp;</strong></td>
  <td width="28%" align="left"><input type="text" name="sec_name" value="<?php echo $res->sec_name; ?>" required="required" /></td>
  <td width="24%" align="right"><strong>Security Id. No.&nbsp;:&nbsp;</strong></td>
  <td width="29%" align="left"><input type="text" name="sec_idno" value="<?php echo $res->sec_idno; ?>" required="required" /></td>
  </tr>
  <tr>
    <td height="63" align="right"><strong>Contact&nbsp;:&nbsp;</strong></td>
    <td align="left"><input type="text" name="sec_con" value="<?php echo $res->sec_con; ?>" required="required" pattern="[0-9]{10}"/></td>
    <td align="right"><strong>Password&nbsp;:&nbsp;</strong></td>
    <td align="left"><input type="password" name="sec_pwd" value="<?php echo $res->sec_pwd; ?>" required="required" /></td>
  </tr>
  <tr>
    <td height="72" colspan="4" align="center">
    <?php
	if($_REQUEST['Mode']=='Edit')
	{
	?>
    <input type="submit" name="update" value="UPDATE" class="btn2">
    <?php } else { ?>
    <input type="submit" name="submit" value="SUBMIT" class="btn2">
    <?php } ?>
    <a href="secview.php" style="text-decoration:none"><input type="button" value="View" class="btn2" /></a> </td>
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
$sql="INSERT INTO `security` (`sec_name` ,
							`sec_idno`,
							`sec_con`,
							`sec_pwd` )
					VALUES ('".$_REQUEST['sec_name']."',
							'".$_REQUEST['sec_idno']."', 
							'".$_REQUEST['sec_con']."',
							'".$_REQUEST['sec_pwd']."')";

mysql_query($sql);
echo "<script type='text/x-javascript'>alert('Added Sucessfully');</script>";
echo "<meta http-equiv='refresh' content='0;url=security.php'>";
}
elseif(isset($_REQUEST['update']))
{

$sql="update `security` set sec_name = '".$_REQUEST['sec_name']."',
						  sec_idno = '".$_REQUEST['sec_idno']."',
						  sec_con = '".$_REQUEST['sec_con']."',
						  sec_pwd = '".$_REQUEST['sec_pwd']."'						  
					where sec_id = '".$_REQUEST['sec_id']."'";

mysql_query($sql);
echo "<script type='text/x-javascript'>alert('Updated Sucessfully');</script>";
echo "<meta http-equiv='refresh' content='0;url=secview.php'>";

}
?>