<?php
session_start();
include("connection.php");
$query=mysqli_query($con,"select * from footer");
while($data=mysqli_fetch_array($query))
{
$schoolname=$data['schoolname'];
$copyright=$data['copyright'];
$maintained=$data['maintained'];
}
?>
<?php
if(!isset($_SESSION['industrylogin']))
{
	header("location:aliens");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" href="images/icon.ico"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $schoolname; ?>-Industry Print Reciept</title>
</head>

<body onload="window.print()">
<center>
<div>
<?php
error_reporting(E_ERROR);
include("connection.php");
$amount=$_POST['amount'];
$name=$_POST['name'];
$votehead=$_POST['votehead'];
$paymentno=$_POST['paymentno'];
if($amount && $name && $votehead && $paymentno)
{
echo"<fieldset style='width:59em;'>";
echo"<h1 style='text-align:left;color:#00CC33;'>Payment No:".$paymentno."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date: ".date("Y-m-d")."</h1>";
echo "<h1 style='text-transform:uppercase;color:#0033FF;text-decoration:bold;'><a href='industrymanagefees'> <u>". $schoolname ." ACCOUNT WITHDRAWAL</u><br/></a></h1>";
echo"<hr/>";
echo"<div style='width:50em;'>";
echo"<p style='text-transform:uppercase;text-align:left;color:#009900;font-size:2em;'>";
echo"PAID TO: ".$name."<br />";
echo"AS PAYMENT OF: ".$votehead."<br />";
echo"AMOUNT PAID: Kshs.".$amount."<br/>";
echo"</p>";
echo"</div>";
echo"<p style='text-align:left;font-size:1.5em;'>You are officially accounted for the amount stated above.</p>";
echo"<p style='text-align:right;'>SIGNATURE AND STAMP<img src='images/stamp.png' width='' height=''/>___________________________</p>";
echo"</fieldset>";
}
else
{
	echo"There is an error with the printing program temporarily, consult technician for more information<br/><a href='index'>Click Here</a>";
}
?>
</div>
</center>
</body>
</html>