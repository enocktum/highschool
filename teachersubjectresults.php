<?php
error_reporting(E_ERROR);
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
if(!isset($_SESSION['teacherlogin']))
{
	header("location:aliens");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>subject results</title>
<style type="text/css">
body{
	width:80em;
}
#table
{
	 width:70%;
	 text-align:left;
}
</style>
</head>

<body onload="window.print()">
<center>
<h1 style="text-transform:uppercase;"><a style='color:black;' href='teachersperformancereport'><?php echo $schoolname; ?></a>
<br/><?php classandsubject(); ?></h1>
<?php
error_reporting(E_ERROR);
$year=$_POST['year'];
$exam=$_POST['exam'];
$term=$_POST['term'];
$class=$_POST['class'];
$subject=$_POST['subject'];
//start of function
function classandsubject()
{
error_reporting(E_ERROR);
$class=$_POST['class'];
$subject=$_POST['subject'];
echo "STUDENTS $subject RESULTS FOR FORM $class";
}
//end of function
if($year && $exam && $term && $class && $subject)
{
	//echo $year." ".$exam." ".$term." ".$class." ".$subject;
	$perry=mysqli_query($con,"select * from studentgrades where year='$year' && term='$term' && class='$class' && subject='$subject' && testname='$exam' order by percentagemarks DESC");
	$number=mysqli_num_rows($perry);
	if($number > 0)
	{
		echo
		'
		<table border="1" id="table">
		<tr>
		<th>POSITION</th>
		<th>STUDENT_NAME</th>
		<th>STUDENT_ID</th>
		<th>TEST_NAME</th>
		<th>MARKS_GAINED</th>
		<th>OUT_OF</th>
		<th>PERCENTAGE</th>
		<th>GRADE</th>
		</tr>
		';
		$position=1;
		$totalmarks=0;
		while($yerry=mysqli_fetch_array($perry))
		{
			$percenta=$yerry['percentagemarks'];
			$studid=$yerry['studentid'];
			//checking for student name
			$summer=mysqli_query($con,"select * from studentdetails where admissionnumber='$studid'");
			$mix=mysqli_fetch_array($summer);
			$studentname=$mix['firstname']." ".$mix['middlename']." ".$mix['lastname'];
			//end of checking for student name
			echo
			'
			<tr>
			<td>'.$position.'</td>
			<td>'.$studentname.'</td>
			<td>'.$yerry['studentid'].'</td>
			<td>'.$yerry['testname'].'</td>
			<td>'.$yerry['marksgained'].'</td>
			<td>'.$yerry['rawmarks'].'</td>
			<td>'.$yerry['percentagemarks'].'</td>
			<td>'.$yerry['grade'].'</td>
			</tr>
			';
			$position=$position+1;
			$totalmarks=$totalmarks+$percenta;
		}
		echo'</table>';
		$meanpercentage=($totalmarks/($number*100)) * 100;
		$meanpercentage=round($meanpercentage,"2");
		echo"<br/><br/><br/><h2 style='text-align:center;text-transform:uppercase;'>Mean Marks for ".$subject." Form ".$class." for term ".$term." is : <u>".$meanpercentage."</u></h2>";
		
	}
	else
	{
		echo"There are not students qualifying the criteria selected. Respective marks not submitted<br/><br/><a href='teachersperformancereport'>Try Again</a>";
	}
}
else
{
	echo"important variables not passed in<br/><br/><a href='teachersperformancereport'>Try Again</a>";
}
?>
</center>
</body>
</html>