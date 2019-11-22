<?php
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
session_start();
if(!isset($_SESSION['industrylogin']))
{
	header("location:aliens");
}
?>
<html>
<title>financial statement</title>
<body onload="window.print()" style="width:90%;">
<center>
                <?php
				$date=date("d-m-Y");
				echo'<h1><a style="text-transform:uppercase;color:black;" href="industryfinancialstatement">'.$schoolname.'</a></h1>';
			    error_reporting(E_ERROR);
			    include("connection.php");
				$studentid=$_POST['studid'];
				if($studentid)
				{
				$perry=mysqli_query($con,"select * from studentdetails where admissionnumber='$studentid'");
				$erry=mysqli_fetch_array($perry);
				$name=$erry['firstname']." ".$erry['middlename']." ".$erry['lastname'];
				echo"<h1 style='text-transform:uppercase;font-size:0.9em;'><b>financial statements FOR $name as at $date</b></h1>";
			    //start of displaying current charges
				echo"<h3 style='text-transform:uppercase;'>CURRENT CHARGES</h3>";
				$yerry=mysqli_query($con,"select * from currentcharges where status='1' && studentid='$studentid'");
				$no=mysqli_num_rows($yerry);
				if($no > 0)
				{
				echo"<table border='1' style='width:100%;text-align:left;'>";
				echo"<tr>";
				echo"<th><b>STUDENT_NAME</b></th>";
				echo"<th><b>STUDENT_ID</b></th>";
				echo"<th><b><font color='brown'>BALANCE</font></b></th>";
				echo"<th><b>TERM</b></u></th>";
				echo"<th><b>DATE</b></u></th>";
				echo"<th><b>BOARDING_STATUS</b></u></th>";
				echo"</tr>";
				while($pata=mysqli_fetch_array($yerry))
				{
				echo"<tr>";
				$studentid=$pata['studentid'];
				$student=mysqli_query($con,"select * from studentdetails where admissionnumber='$studentid'");
				$nam=mysqli_fetch_array($student);
				$course=$nam['course'];
				$boarding=$nam['boardingstatus'];
				$name=$nam['firstname']." ".$nam['middlename']." ".$nam['lastname'];
				echo"<td style='text-transform:uppercase;font-size:0.6em;'>".$name."</td>";
				echo"<td>".$pata['studentid']."</td>";
				echo"<td>".$pata['balance']."</td>";
				echo"<td><font color='brown'>".$pata['term']."</font></td>";
				echo"<td><font color='red'>".date("Y-m-d")."</font></td>";
				echo"<td>".$boarding."</td>";
				echo"</tr>";
				}
				echo"</table>";
				}
				else
				{
					echo"current charges are not available for now. This may be due to 0 students in the school or all students have been discontinued<br/><br/>";
				}
				//end of displaying current charges
				
				echo"";
				
				echo"<h3 style='text-transform:uppercase;'>Financial statement</h3><br/>";
				$query=mysqli_query($con,"select * from financestatement where studentid='$studentid' ORDER BY financestatementid");
				$number=mysqli_num_rows($query);
				if($number > 0)
				{
				echo"<table border='1' style='width:100%;text-align:left;'>";
				echo"<tr>";
				echo"<th><b>DATE_DEPOSITED</b></th>";
				echo"<th><b><font color='green'>AMOUNT_DEPOSITED</font></b></th>";
				echo"<th><b><font color='brown'>FEES_AMOUNT</font></b></th>";
				echo"<th><b><font color='red'>FEES_STATUS</font></b></th>";
				echo"<th><b>TERM</b></u></th>";
				echo"</tr>";
				while($data=mysqli_fetch_array($query))
				{
				echo"<tr>";
				echo"<td>".$data['datedeposited']."</td>";
				echo"<td><font color='green'>".$data['feespaid']."</font></td>";
				echo"<td><font color='brown'>".$data['feespayable']."</font></td>";
				echo"<td><font color='red'>".$data['studentstatus']."</font></td>";
				echo"<td>".$data['term']."</td>";
				echo"</tr>";
				}
				echo"</table><br/><br/>";
				}
				else
				{
					echo"financial records have not been posted to the student account";
				}
				}
				else
				{
					echo"Student id not selected<br/><a href='industryfinancialstatement'>Try again</a>";	
				}
			    ?>
</center>
</body>
</html>