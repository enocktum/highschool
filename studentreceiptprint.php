<?php
session_start();
include("connection.php");
$query=mysql_query("select * from footer");
while($data=mysql_fetch_array($query))
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
$studentid=$_POST['studentid'];
$status=$_POST['status'];
$mbusi=$_POST['balance'];
$from=$_POST['from'];
$recieptno=$_POST['recieptno'];
$voteheads=$_POST['voteheads'];
$remaining=$_POST['remaining'];
$term=$_POST['term'];
$initial=$_POST['initial'];
$boarding=$_POST['boarding'];
if($amount && $studentid && $status && $from && $recieptno && $term && $boarding)
{
//student name
$tery=mysql_query("select * from studentdetails where admissionnumber='$studentid'");
$ry=mysql_fetch_array($tery);
$name=$ry['firstname']." ". $ry['middlename']." ".$ry['lastname'];
//end of student name
echo"<fieldset style='width:59em;'>";
echo"<h1 style='text-align:left;'>receipt no:".$recieptno."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date: ".date("Y-m-d")."</h1>";
echo "<h1 style='text-transform:uppercase;color:black;text-decoration:bold;'><a style='color:black;' href='industryhome'> <u>". $schoolname ." FEES PAYMENT RECIEPT</u><br/></a></h1>";
echo"<hr/>";
if($mbusi < 1)
{
	$balance="Carry Forward: ".($mbusi * -1);
}
elseif($mbusi>0)
{
	$balance="Balance: ".$mbusi;
}
echo"<div style='width:50em;'>";
echo"<p style='text-transform:uppercase;text-align:left;font-size:2em;'>";
echo"STUDENT NAME: ".$name."<br />";
echo"BOARDING STATUS: ".$boarding."<br />";
echo"STUDENT ID: ".$studentid."<br />";
echo"INITIAL BALANCE: ".$initial."<br/>";
echo"AMOUNT PAID: ".$amount."<br/>";
echo"FEES STATUS: ".$status."<br/>";
echo $balance;
echo"<br/>TERM: ".$term."<br/>";
echo"<hr/>";
//start of voteheads
echo"</p>";
echo"<h3>VOTEHEADS DESIGNATED</h3>";
echo"<p>";
echo"<table border='0'  style='width:100%;'>";
echo"<tr>";
echo"<th style='text-align:left;'>VOTEHEAD NAME</th>";
echo"<th style='text-align:left;'>VOTEHEAD AMOUNT</th>";
echo"</tr>";
$plode=explode(",",$voteheads);
foreach($plode as $many)
{
	$vote=mysql_query("select * from voteheads where name='$many' && termit='$term'&& boardingstatus='$boarding' ");
	while($head=mysql_fetch_array($vote))
	{
		echo"<tr>";
		echo "<td>".$pesa=$head['name']."</td>";
		echo "<td>".$votename=$head['amount']."</td>";
		echo"</tr>";
	}
}
echo"<tr>";
echo"<td>Remaining Amount( carried forward or compensating previous areas)</td>";
echo"<td>".($mbusi)."</td>";
echo"</tr>";
echo"</table>";
echo"</p>";
//end of voteheads
echo "<hr/>";
echo"</div>";
echo"<p style='text-align:left;font-size:1.5em;'>We appreciate you for being part of us and making your payments as required of you.</p>";
echo"<p style='text-align:right;'>SIGNATURE AND STAMP<img src='images/stamp.png' width='' height=''/>___________________________</p>";
echo"</fieldset>";
}
else
{
	echo"There is an error with the printing program temporarily, consult technician for more information<br/><a href='index'>Click here</a>";
}
?>
</div>
</center>
</body>
</html>