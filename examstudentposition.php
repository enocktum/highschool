<?php
ob_start()
?>
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
if(!isset($_SESSION['examsetup']))
{
	header("location:aliens");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $schoolname; ?>-exam setup home</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body onload="window.print()">
<center>
            <?php
			include "connection.php";
			error_reporting(E_ERROR);
			$class=$_POST['class'];
			$term=$_POST['term'];
			$year=$_POST['year'];
			if($class && $term && $year)
			{
			      $eggs=mysql_query("select * from individualmeangrade where class='$class' && term='$term' && year='$year' order by meangrade DESC");
				  $num=mysql_num_rows($eggs);
				  
				  if($num > 0)
				  {
				  echo'<h1 style="text-transform:uppercase;"><a style="color:black;" href="examviewreports"><font size="5">'.$schoolname.'</font></a><br/>
								 <font size="4">STUDENTS CLASS POSITION FOR  TERM '.$term.' YEAR '.$year.' FORM '.$class.'
								 </font></h1>';
				  echo'
				  <table border="1" style="width:100%;">
				  <tr style="text-align:left;">
				  <th>POSITION</th>
				  <th>NAME</th>
				  <th>ADMISSION NUMBER</th>
				  <th>TOTAL MARKS</th>
				  <th>MEAN GRADE</th>
				  </tr>
				  ';
				  $position=1;
				  $totalmeangrade=0;
				  while($allstudents=mysql_fetch_array($eggs))
				  {
				    $meangrade=$allstudents['meangrade'];
					$studentid=$allstudents['studentid'];
					$hey=mysql_query("select * from studentdetails where admissionnumber='$studentid'");
					$ha=mysql_fetch_array($hey);
					$name=$ha['firstname']." ".$ha['middlename']." ".$ha['lastname'];
				     echo'
					 <tr>
					 <td>'.$position.'</td>
					 <td>'.$name.'</td>
					 <td>'.$allstudents['studentid'].'</td>
					 <td>'.$allstudents['totalmarks'].'</td>
					 <td>'.$allstudents['meangrade'].'</td>
					 </tr>
					 ';
					 $position=$position + 1;
					 $totalmeangrade=$totalmeangrade+$meangrade;
				  }
				  $classmeangrade=$totalmeangrade/$num;
				  echo"
				  </table>
				  <br/>
				  <h5>CLASS MEAN GRADE FOR $exam FORM $class IS ".round($classmeangrade,4)."</h5>
				  ";
				  }
				  else
				  { 
				     echo"selected class position not available. Exam records not populated inside.<br/><br/><a href='examviewreports'>Try Again</a>";
				  }
			}
			else
			{
			     echo"all necessary variables not passed in<br /><a href='examviewreports'>Try Again</a>";
			}
			?>
</center>
</body>
</html>
<?php
ob_flush()
?>