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
    <td colspan="7" align="center"><h1>Student Details</h1></td>
  </tr>
  <tr>
    <td colspan="7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7" align="center">
    <table width="619" border="0" style="font-size:24px;border:1px solid">
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="110">&nbsp;</td>
        <td width="154"><strong>Students' list&nbsp;:&nbsp;</strong></td>
        <td width="341">
          <input type="file" name="stu_list" required="required"/>
</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><strong>Class Id&nbsp;:&nbsp;</strong></td>
        <td>
          <input type="text" name="class_id" required="required"/></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" align="center"><input type="submit" name="submit" value="Submit" class="btn2" />
        <a href="view.php" style="text-decoration:none"><input type="button" value="View" class="btn2" /></a></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
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
if(isset($_POST['submit']))
{
$list = $_POST['class_id']."-".$_FILES['stu_list']['name'];
$path = "../list/".$list;
move_uploaded_file($_FILES["stu_list"]["tmp_name"],$path);
$class = $_REQUEST['class_id'];
/*mysql_query("insert into upload(question)values('$question')")or die(mysql_error());
$con=mysql_query("select * from upload");
while($row=mysql_fetch_array($con))
{
$name=$row['question'];
}
*/

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