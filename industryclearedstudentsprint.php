<?php
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
session_start();
if(!isset($_SESSION['industrylogin']))
{
	header("location:aliens");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $schoolname; ?>-Industry print financial statement</title>
</head>
<body onload="window.print()">
<center>
              <?php
			  error_reporting(E_ERROR);
			  include("connection.php");
			  $formstatus=$_POST['formstatus'];
			  $cclass=$_POST['class'];
			  if($formstatus && $cclass)
			  {
				  if($formstatus=="cleared")
				  {
				  //start of cleared students
				  if($cclass=="all")
				  {
					  echo"<h3 style='text-transform:uppercase;'><a style='text-transform:uppercase;color:black;' href='industryfinancialstatement'>$schoolname</a><br/>CLEARED STUDENTS AS AT <u>".date("d-m-Y")."</u> for all forms</h3>";
					  echo"<hr/>";
					  $query=mysql_query("select * from currentcharges where status='1' && balance<'1' ORDER BY studentid");
				$no=mysql_num_rows($query);
				if($no > 0)
				{
				echo"<table border='1' style='width:100%;text-align:left;'>";
				echo"<tr>";
				echo"<th><b>STUDENT NAME</b></th>";
				echo"<th><b>STUDENT ID</b></th>";
				echo"<th><b>CARRY FORWARD</b></th>";
				echo"<th><b>TERM</b></u></th>";
				echo"<th><b>CLASS</b></u></th>";
				echo"<th><b>STREAM</b></u></th>";
				echo"</tr>";
				while($data=mysql_fetch_array($query))
				{
				$balance=$data['balance'];
				if($balance<1)
				{
				echo"<tr>";
				$studentid=$data['studentid'];
				$student=mysql_query("select * from studentdetails where admissionnumber='$studentid'");
				$nam=mysql_fetch_array($student);
				$name=$nam['firstname']." ".$nam['middlename']." ".$nam['lastname'];
				echo"<td style='text-transform:uppercase;'>".$name."</td>";
				echo"<td>".$data['studentid']."</td>";
				$bala=$data['balance'];
				$finalbal=$bala * -1;
				echo"<td>".$finalbal."</td>";
				echo"<td>".$data['term']."</td>";
				echo"<td>".$nam['currentclass']."</td>";
				echo"<td>".$nam['stream']."</td>";
				echo"</tr>";
				}
				}
				echo"</table>";
				}
				else
				{
					echo"There are no financially cleared students in the system.";
				}
				}
				else
				{
					//code for specific classes
					echo"<h3 style='text-transform:uppercase;'><a style='text-transform:uppercase;color:black;' href='industryfinancialstatement'>$schoolname</a><br/>CLEARED STUDENTS AS AT <u>".date("d-m-Y")."</u> for form $cclass</h3>";
					echo"<hr/>";
					$terry=mysql_query("select * from currentcharges where status='1' && balance<'1'");
					$no=mysql_num_rows($terry);
					if($no>0)
					{
						echo"<table border='1' style='width:100%;text-align:left;'>";
						echo"<tr>";
						echo"<th><b>STUDENT NAME</b></th>";
						echo"<th><b>STUDENT ID</b></th>";
						echo"<th><b>CARRY FORWARD</b></th>";
						echo"<th><b>TERM</b></u></th>";
						echo"<th><b>CLASS</b></u></th>";
						echo"<th><b>STREAM</b></u></th>";
						echo"</tr>";
						while($rabbit=mysql_fetch_array($terry))
						{
							$studentid=$rabbit['studentid'];
							$studentquery=mysql_query("select * from studentdetails where status='1' && currentclass='$cclass' && admissionnumber='$studentid'");
							$ata=mysql_num_rows($studentquery);
							if($ata <= 0)
							{
								//do nothing
								
								//end do nothing
							}
							else if($ata >= 1)
							{
								//do something code
								$studentdata=mysql_fetch_array($studentquery);
								$name=$studentdata['firstname']." ".$studentdata['middlename']." ".$studentdata['lastname'];
								$admissionnumber=$studentdata['admissionnumber'];
								$stream=$studentdata['stream'];
								$chargesquery=mysql_query("select * from currentcharges where studentid='$admissionnumber' && status='1'");
								$chargesdata=mysql_fetch_array($chargesquery);
								$balance=$chargesdata['balance'];
								$term=$chargesdata['term'];
								$balancehuman=$balance * -1;
								echo"
								<tr>
									<td>".$name."</td>
									<td>".$admissionnumber."</td>
									<td>".$balancehuman."</td>
									<td>".$term."</td>
									<td>".$cclass."</td>
									<td>".$stream."</td>
								</tr>
								";
								//end do something code
							}
						}
					}
					else
					{
						echo"there are no cleared students to show in the financial statement";
					}
					//end code for specific classes
				}
				//end of cleared students
				  }
				  elseif($formstatus=="uncleared")
				  {
					  //start of uncleared students
				  if($cclass=="all")
				  {
					  echo"<h3 style='text-transform:uppercase;'><a style='text-transform:uppercase;color:black;' href='industryfinancialstatement'>$schoolname</a><br/>UNCLEARED STUDENTS AS AT <u>".date("d-m-Y")."</u> for all forms</h3>";
					  echo"<hr/>";
					  $query=mysql_query("select * from currentcharges where status='1' && balance>'0' ORDER BY studentid");
				$no=mysql_num_rows($query);
				if($no > 0)
				{
				echo"<table border='1' style='width:100%;text-align:left;'>";
				echo"<tr>";
				echo"<th><b>STUDENT NAME</b></th>";
				echo"<th><b>STUDENT ID</b></th>";
				echo"<th><b>BALANCE</b></th>";
				echo"<th><b>TERM</b></u></th>";
				echo"<th><b>CLASS</b></u></th>";
				echo"<th><b>STREAM</b></u></th>";
				echo"</tr>";
				while($data=mysql_fetch_array($query))
				{
				$balance=$data['balance'];
				if($balance>0)
				{
				echo"<tr>";
				$studentid=$data['studentid'];
				$student=mysql_query("select * from studentdetails where admissionnumber='$studentid'");
				$nam=mysql_fetch_array($student);
				$name=$nam['firstname']." ".$nam['middlename']." ".$nam['lastname'];
				echo"<td style='text-transform:uppercase;'>".$name."</td>";
				echo"<td>".$data['studentid']."</td>";
				$bala=$data['balance'];
				echo"<td>".$bala."</td>";
				echo"<td>".$data['term']."</td>";
				echo"<td>".$nam['currentclass']."</td>";
				echo"<td>".$nam['stream']."</td>";
				echo"</tr>";
				}
				}
				echo"</table>";
				}
				else
				{
					echo"There are no financially uncleared students in the system.";
				}
				}
				else
				{
					//code for specific classes
					echo"<h3 style='text-transform:uppercase;'><a style='text-transform:uppercase;color:black;' href='industryfinancialstatement'>$schoolname</a><br/>UNCLEARED STUDENTS AS AT <u>".date("d-m-Y")."</u> for form $cclass</h3>";
					echo"<hr/>";
					$terry=mysql_query("select * from currentcharges where status='1' && balance>'0'");
					$no=mysql_num_rows($terry);
					if($no>0)
					{
						echo"<table border='1' style='width:100%;text-align:left;'>";
						echo"<tr>";
						echo"<th><b>STUDENT NAME</b></th>";
						echo"<th><b>STUDENT ID</b></th>";
						echo"<th><b>BALANCE</b></th>";
						echo"<th><b>TERM</b></u></th>";
						echo"<th><b>CLASS</b></u></th>";
						echo"<th><b>STREAM</b></u></th>";
						echo"</tr>";
						while($rabbit=mysql_fetch_array($terry))
						{
							$studentid=$rabbit['studentid'];
							$studentquery=mysql_query("select * from studentdetails where status='1' && currentclass='$cclass' && admissionnumber='$studentid'");
							$ata=mysql_num_rows($studentquery);
							if($ata <= 0)
							{
								//do nothing
								
								//end do nothing
							}
							else if($ata >= 1)
							{
								//do something code
								$studentdata=mysql_fetch_array($studentquery);
								$name=$studentdata['firstname']." ".$studentdata['middlename']." ".$studentdata['lastname'];
								$admissionnumber=$studentdata['admissionnumber'];
								$stream=$studentdata['stream'];
								$chargesquery=mysql_query("select * from currentcharges where studentid='$admissionnumber' && status='1'");
								$chargesdata=mysql_fetch_array($chargesquery);
								$balancehuman=$chargesdata['balance'];
								$term=$chargesdata['term'];
								echo"
								<tr>
									<td>".$name."</td>
									<td>".$admissionnumber."</td>
									<td>".$balancehuman."</td>
									<td>".$term."</td>
									<td>".$cclass."</td>
									<td>".$stream."</td>
								</tr>
								";
								//end do something code
							}
						}
					}
					else
					{
						echo"there are no financially uncleared students to show in the financial statement";
					}
					//end code for specific classes
				}
				//end of uncleared students
				  }
				  elseif($formstatus=="allstudents")
				  {
					  //start of all students
				  if($cclass=="all")
				  {
					  echo"<h3 style='text-transform:uppercase;'><a style='text-transform:uppercase;color:black;' href='industryfinancialstatement'>$schoolname</a><br/>ALL STUDENTS AS AT <u>".date("d-m-Y")."</u> for all forms</h3>";
					  echo"<hr/>";
					  $query=mysql_query("select * from currentcharges where status='1' ORDER BY studentid");
				$no=mysql_num_rows($query);
				if($no > 0)
				{
				echo"<table border='1' style='width:100%;text-align:left;'>";
				echo"<tr>";
				echo"<th><b>STUDENT NAME</b></th>";
				echo"<th><b>STUDENT ID</b></th>";
				echo"<th><b>BALANCE</b></th>";
				echo"<th><b>TERM</b></u></th>";
				echo"<th><b>CLASS</b></u></th>";
				echo"<th><b>STREAM</b></u></th>";
				echo"</tr>";
				while($data=mysql_fetch_array($query))
				{
				echo"<tr>";
				$studentid=$data['studentid'];
				$balance=$data['balance'];
				if($balance > 0)
				{
					$balue=$balance;
				}
				else if($balance < 0)
				{
					$balue=$balance * -1;
					$balue=$balue."(Carried Forward)";
				}
				else if($balance == 0)
				{
					$balue=$balance;
				}
				$student=mysql_query("select * from studentdetails where admissionnumber='$studentid'");
				$nam=mysql_fetch_array($student);
				$name=$nam['firstname']." ".$nam['middlename']." ".$nam['lastname'];
				echo"<td style='text-transform:uppercase;'>".$name."</td>";
				echo"<td>".$data['studentid']."</td>";
				echo"<td>".$balue."</td>";
				echo"<td>".$data['term']."</td>";
				echo"<td>".$nam['currentclass']."</td>";
				echo"<td>".$nam['stream']."</td>";
				echo"</tr>";
				}
				echo"</table>";
				}
				else
				{
					echo"There are no students in the system qualified for financial statements, register students first.";
				}
				}
				else
				{
					//code for specific classes
					echo"<h3 style='text-transform:uppercase;'><a style='text-transform:uppercase;color:black;' href='industryfinancialstatement'>$schoolname</a><br/>ALL STUDENTS AS AT <u>".date("d-m-Y")."</u> for form $cclass</h3>";
					echo"<hr/>";
					$terry=mysql_query("select * from currentcharges where status='1'");
					$no=mysql_num_rows($terry);
					if($no>0)
					{
						echo"<table border='1' style='width:100%;text-align:left;'>";
						echo"<tr>";
						echo"<th><b>STUDENT NAME</b></th>";
						echo"<th><b>STUDENT ID</b></th>";
						echo"<th><b>BALANCE</b></th>";
						echo"<th><b>TERM</b></u></th>";
						echo"<th><b>CLASS</b></u></th>";
						echo"<th><b>STREAM</b></u></th>";
						echo"</tr>";
						while($rabbit=mysql_fetch_array($terry))
						{
							$studentid=$rabbit['studentid'];
							$studentquery=mysql_query("select * from studentdetails where status='1' && currentclass='$cclass' && admissionnumber='$studentid'");
							$ata=mysql_num_rows($studentquery);
							if($ata <= 0)
							{
								//do nothing
								
								//end do nothing
							}
							else if($ata >= 1)
							{
								//do something code
								$studentdata=mysql_fetch_array($studentquery);
								$name=$studentdata['firstname']." ".$studentdata['middlename']." ".$studentdata['lastname'];
								$admissionnumber=$studentdata['admissionnumber'];
								$stream=$studentdata['stream'];
								$chargesquery=mysql_query("select * from currentcharges where studentid='$admissionnumber' && status='1'");
								$chargesdata=mysql_fetch_array($chargesquery);
								$balance=$chargesdata['balance'];
								if($balance==0)
								{
									$balancehuman=$balance;
								}
								else if($balance>0)
								{
									$balancehuman=$balance;
								}
								else if($balance<0)
								{
									$balancehuman=$balance * -1;
									$balancehuman=$balancehuman."(Carried Forward)";
								}
								echo"
								<tr>
									<td>".$name."</td>
									<td>".$admissionnumber."</td>
									<td>".$balancehuman."</td>
									<td>".$term."</td>
									<td>".$cclass."</td>
									<td>".$stream."</td>
								</tr>
								";
								//end do something code
							}
						}
					}
					else
					{
						echo"there are no student financial statements to show";
					}
					//end code for specific classes
				}
				//end of all students
				  }
			  }
			  else
			  {
				  echo"Printing software did not recieve all variables<br/><br/><a href='industryfinancialstatement'>Try Again</a>";
			  }
			   ?>
</center>
</body>
</html>