<?php
session_start();
include_once 'db/db.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php include('title.php') ?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="total">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="250" align="center"><img src="images/banner.png" width="980" /></td>
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
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center"><h1>Staff Log In</h1></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td width="5%" align="center">&nbsp;</td>
    <td align="center" bgcolor="#266a43">
<br />
      <p style="padding:0px 20px 20px 20px;color:#FFFFFF;text-align:justify">
        <form action="" method="post">    
          <h3 style="color:#FFFFFF">EMP. ID NO</h3>
          <input name="user_uname" type="text" required />
          <br />
          <br />
          <h3 style="color:#FFFFFF">PASSWORD</h3>
          <input name="user_pwd" type="password" required />
          <br />
          <br />
          <input value="LOG IN" name="submit" type="submit" class="btn"/>
          
  </form></p>  <p style="padding:20px 20px 20px 20px;color:#FFFFFF;text-align:justify">&nbsp;</p></td>
    <td width="5%" align="center">&nbsp;</td>
  </tr>
  <tr>
     <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
</div>
<br />
<?php include('footer.php') ?>
</body>
</html>
<?php
if(isset($_REQUEST['submit']))
{
$user_uname=$_REQUEST['user_uname'];
$user_pwd=$_REQUEST['user_pwd'];


$sqlup="Select * from staff
	where sf_empno='".$user_uname."' AND sf_pwd='".$user_pwd."'";

	$we=mysql_query($sqlup);
	$res=mysql_fetch_object($we);

if($res > 0)
{
$_SESSION['user_id'] = $res->sf_id;
$_SESSION['user_name'] = $res->sf_name;
$_SESSION['user_class'] = $res->sf_class;

	echo "<script type='text/javascript'> alert('Login Successfully');</script>";

	echo "<meta http-equiv='refresh' content='0;url=staff/index.php'>";

}
else{ 	echo "<script type='text/javascript'> alert('Invalid Login');</script>";	}
}

?>