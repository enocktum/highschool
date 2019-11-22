<?php
ob_start()
?>
<?php
session_start();
include("../connection.php");
$query=mysqli_query($con,"select * from footer");
while($data=mysqli_fetch_array($query))
{
$schoolname=$data['schoolname'];
$copyright=$data['copyright'];
$maintained=$data['maintained'];
}
?>
<?php
if(!isset($_SESSION['examsetup']))
{
	header("location:../aliens.php");
}
?>
<?php
error_reporting(E_ERROR);
include"connection.php.php";
$want=$_POST['want'];
$term=$_POST['term'];
$exam=$_POST['exam'];
$year=$_POST['year'];
$class=$_POST['class'];
?>
<html>
<title>REPORT FORM FOR FORM <?php echo $class?></title>
<script src="Chart.js"></script>
<meta name = "viewport" content = "initial-scale = 1, user-scalable = no">
<style>
canvas
{
}
</style>
<body>
<center>
<?php 

if($want && $term && $exam && $year && $class)
{
     if($want=="yes")
	 {
	     $examined=mysqli_query($con,"select * from individualmeangrade where class='$class' && year='$year' && term='$term'");
		 $loop=0;
		 while($onebyone=mysqli_fetch_array($examined))
		 {
		     $loop=$loop+1;
		     $studentidmean=$onebyone['studentid'];
			 $allstudents=mysqli_query($con,"select * from studentdetails where currentclass='$class' && status='1'");
			 while($studetail=mysqli_fetch_array($allstudents))
			 {
			     $studentidreal=$studetail['admissionnumber'];
				 $stream=$studetail['stream'];
				 $dorm=$studetail['dormitory'];
				 $kcpemarks=$studetail['kcpemarks'];
				 $studentname=$studetail['firstname']." ".$studetail['middlename']." ".$studetail['lastname'];
				 if($studentidmean == $studentidreal)
				 {
				 //checking if stream is set
				 if($stream!="")
				 {
				     $stream=$stream;
				 }
				 else
				 {
				     $stream="NOT AVAILABLE";
				 }
				 //end of checking if stream is set
				 //start of checking if dorm is set
				 if($dorm!="")
				 {
				     $dorm=$dorm;
				 }
				 else
				 {
				     $dorm="NOT AVAILABLE";
				 }
				 //end of checking if dorm is set
				 //start checking if kcpe marks is set
				 if($kcpemarks!=0)
				 {
				     $kcpemarks=$kcpemarks;
				 }
				 else
				 {
				     $kcpemarks="NOT AVAILABLE";
				 }
				 //end of checking if kcpe marks is set
				     echo"<div class='content' style='width:100%;page-break-before:always;'>";
					      echo'
						  <h2 style="text-transform:uppercase;">
						  <a style="color:black;" href="../examviewreports.php">'.$schoolname.'</a><br/>
						  PROGRESS REPORT FOR TERM '.$term.' YEAR '.$year.' FORM '.$class.'
					      </h2>';
                           //start						  
						  echo'
						  <table style="width:100%;" border="1">
						  <tr>
						  <td style="width:20%;">
						  <img style="width:100%;height:150px;" src="../images/logo.jpg" />
						  <p style="text-align:center;">KCPE MARKS: '.$kcpemarks.'</p>
						  </td>
						  <td style="width:80%;">
						  <p style="text-transform:uppercase;">STUDENT NAME: '.$studentname.'</p>
						  <p style="text-transform:lowercase;">ADMISSION NUMBER: '.$studentidmean.'&nbsp;&nbsp;&nbsp;CLASS: '.$class.'  &nbsp;&nbsp;&nbsp;&nbsp;DORM: '.$dorm.' &nbsp;&nbsp;&nbsp;STREAM: '.$stream.' </p>
						  <div style="float:left;width:49%;">
						  <table style="width:100%;" border="2">
						  <tr>
						  <td>OVERALL POSITION</td>
						  <td>
						  ';
						  //start of getting overall position
						  $outof=mysqli_num_rows($allstudents);
						  $sele=mysqli_query($con,"select * from individualmeangrade where class='$class' && year='$year' && term='$term' ORDER BY meangrade DESC");
						  $counter=0;
						  while($qr=mysqli_fetch_array($sele))
						  {
						     $counter=$counter+1;
							 $id=$qr['studentid'];
							 if($id==$studentidreal)
							 {
							     $currentposition=$counter;
								 $meangr=$qr['meangrade'];
								 $totalm=$qr['totalmarks'];
							 }
						  }
						  echo "<b>".$currentposition."</b> out of <b>". $outof."</b>";
						  //end of getting overall position
						  echo'
						  </td>
						  </tr>
						  <tr>
						  <td>CLASS POSITION</td>
						  <td>
						  <b>'.$currentposition.'</b> out of <b>'.$outof.'</b>
						  </td>
						  </tr>
						  <tr>
						  <td>KCPE RANK</td>
						  <td>
						  ';
						  //start of calculating rank at entry
						  $ol=mysqli_query($con,"select * from studentdetails where status='1' && currentclass='$class' ORDER BY kcpemarks DESC");
						  $wote=mysqli_num_rows($ol);
						  $hesabu=0;
						  while($lo=mysqli_fetch_array($ol))
						  {
						     $hesabu=$hesabu+1;
						     $idd=$lo['admissionnumber'];
							 $kcp=$lo['kcpemarks'];
							 if($studentidreal==$idd)
							 {
							     if($kcp!=0)
								 {
								     $rank=$hesabu;
								 }
								 else
								 {
								     $rank="unrated";
								 }
							 }
						  }
						     if($rank != "unrated")
							 {
						         echo $rank." out of ".$wote;
							 }
							 else
							 {
							     echo"unrated";
							 }
						  //end of calculating rank at entry
						  echo'
						  </td>
						  </tr>
						  </table>
						  </div>
						  <div style="float:right;width:49%;">
						  <table style="width:100%;" border="2">
						  <tr>
						  <td>TERM AVERAGE</td>
						  <td>'.round($meangr,2).'</td>
						  </tr>
						  <tr>
						  <td>TOTAL MARKS</td>
						  <td>'.round($totalm,2).'</td>
						  </tr>
						  <tr>
						  <td>MEAN GRADE</td>
						  <td>
						  ';
						  //start of calculating mean grade
					             $gradi=mysqli_query($con,"select * from meangradegrading");
								 $nu=mysqli_num_rows($gradi);
					             while($systim=mysqli_fetch_array($gradi))
					             {
					             $between=$systim['between'];
						         $grade=$systim['grade'];
						         $yote=explode("-",$between);
						         $firstrange=$yote[0];
						         $secondrange=$yote[1];
						         if(($meangr > $firstrange) && ($meangr <= $secondrange))
						         { 
						            $gradit=$grade;
						         }
					             }
					             $squi=mysqli_query($con,"select * from meangradegrading where grade='$gradit'");
					             while($rel=mysqli_fetch_array($squi))
					             {
						             $teachercomments=$rel['classteacherremarks'];
									 $principlecomments=$rel['principleremarks'];
					             }
								 if(isset($gradit))
								 {
								 echo $gradit;
								 }
								 else
								 {
								 echo"<font color='red'>ungraded</font>";
								 }
						  //end of calculating mean grade
						  echo'
						  </td>
						  </tr>
						  </table>
						  </div>
						  </td>
						  </tr>
						  </table>
						  ';
						  //end
						  
						  //start of dumping students subject perfomance
						  $dumpy=mysqli_query($con,"select * from studentgrades where studentid='$studentidreal'  && term='$term' && year='$year' && class='$class'");
						  $noin=mysqli_num_rows($dumpy);
						  if($noin==0)
						  {
						      echo"<h3><font color='red'>Student grades unavailable</font></h3>";
						  }
						  else
						  {
						     echo'
							<br/>
						    <table border="0" style="width:100%;font-size:15px;text-align:left;"> 
							<tr>
							<th>SUBJECT NAME</th>
							<th>EXAM NAME</th>
							<th>MARKS (%)</th>
							<th>GRADE</th>
							<th>TEACHER REMARKS</th>
							</tr>
							';
							while($datal=mysqli_fetch_array($dumpy))
						     {
							     $percentagemarks=round($datal['percentagemarks'],"1");
								 echo'
								 <tr>
								 <td>'.$datal['subject'].'</td>
								 <td>'.$datal['testname'].'</td>
								 <td>'.$percentagemarks.'</td>
								 <td>'.$datal['grade'].'</td>
								 <td>'.$datal['remarks'].'</td>
								 </tr>
								 ';
							 }
							echo"</table>";
						  }
						  //end of dumping students subject credentials
						  
						  //start of graphing the performance out
						  ?>
						  <canvas id="<?php echo $loop."canvas"; ?>" width="900" height="300" onload="window.print()"></canvas>
						  <?php
						  //form one term one
	                      $ck=mysqli_query($con,"select * from individualmeangrade where class='1' && term='one' && studentid='$studentidreal'");
						  $ngapi=mysqli_num_rows($ck);
						  if($ngapi!=0)
						  {
						  $kc=mysqli_fetch_array($ck);
						  $nayo=$kc['meangrade'];
						  $nayo=round($nayo,1);
						  $f1t1=$nayo;
						  }
						  else
						  {
						     $f1t1=0;
						  }
						  //end form one term one
						  
						  //form one term two
						  $ck=mysqli_query($con,"select * from individualmeangrade where class='1' && term='two' && studentid='$studentidreal'");
						  $ngapi=mysqli_num_rows($ck);
						  if($ngapi!=0)
						  {
						  $kc=mysqli_fetch_array($ck);
						  $nayo=$kc['meangrade'];
						  $nayo=round($nayo,1);
						  $f1t2=$nayo;
						  }
						  else
						  {
						     $f1t2=0;
						  }
						  //end form one term two
						  
						  //form one term three
						  $ck=mysqli_query($con,"select * from individualmeangrade where class='1' && term='three' && studentid='$studentidreal'");
						  $ngapi=mysqli_num_rows($ck);
						  if($ngapi!=0)
						  {
						  $kc=mysqli_fetch_array($ck);
						  $nayo=$kc['meangrade'];
						  $nayo=round($nayo,1);
						  $f1t3=$nayo;
						  }
						  else
						  {
						     $f1t3=0;
						  }
						  //end form one term three
						  
						  //form two term one
						  $ck=mysqli_query($con,"select * from individualmeangrade where class='2' && term='one' && studentid='$studentidreal'");
						  $ngapi=mysqli_num_rows($ck);
						  if($ngapi!=0)
						  {
						  $kc=mysqli_fetch_array($ck);
						  $nayo=$kc['meangrade'];
						  $nayo=round($nayo,1);
						  $f2t1=$nayo;
						  }
						  else
						  {
						     $f2t1=0;
						  }
						  //end form two term one
						  
						  //form two term two
						  $ck=mysqli_query($con,"select * from individualmeangrade where class='2' && term='two' && studentid='$studentidreal'");
						  $ngapi=mysqli_num_rows($ck);
						  if($ngapi!=0)
						  {
						  $kc=mysqli_fetch_array($ck);
						  $nayo=$kc['meangrade'];
						  $nayo=round($nayo,1);
						  $f2t2=$nayo;
						  }
						  else
						  {
						     $f2t2=0;
						  }
						  //end form two term two
						  
						  //form two term three
						  $ck=mysqli_query($con,"select * from individualmeangrade where class='2' && term='three' && studentid='$studentidreal'");
						  $ngapi=mysqli_num_rows($ck);
						  if($ngapi!=0)
						  {
						  $kc=mysqli_fetch_array($ck);
						  $nayo=$kc['meangrade'];
						  $nayo=round($nayo,1);
						  $f2t3=$nayo;
						  }
						  else
						  {
						     $f2t3=0;
						  }
						  //end form two term four
						  
						  //form three term one
						  $ck=mysqli_query($con,"select * from individualmeangrade where class='3' && term='one' && studentid='$studentidreal'");
						  $ngapi=mysqli_num_rows($ck);
						  if($ngapi!=0)
						  {
						  $kc=mysqli_fetch_array($ck);
						  $nayo=$kc['meangrade'];
						  $nayo=round($nayo,1);
						  $f3t1=$nayo;
						  }
						  else
						  {
						     $f3t1=0;
						  }
						  //end form three term one
						  
						  //form three term two
						  $ck=mysqli_query($con,"select * from individualmeangrade where class='3' && term='two' && studentid='$studentidreal'");
						  $ngapi=mysqli_num_rows($ck);
						  if($ngapi!=0)
						  {
						  $kc=mysqli_fetch_array($ck);
						  $nayo=$kc['meangrade'];
						  $nayo=round($nayo,1);
						  $f3t2=$nayo;
						  }
						  else
						  {
						     $f3t2=0;
						  }
						  //end form three term two
						  
						  //form three term three
						  $ck=mysqli_query($con,"select * from individualmeangrade where class='3' && term='three' && studentid='$studentidreal'");
						  $ngapi=mysqli_num_rows($ck);
						  if($ngapi!=0)
						  {
						  $kc=mysqli_fetch_array($ck);
						  $nayo=$kc['meangrade'];
						  $nayo=round($nayo,1);
						  $f3t3=$nayo;
						  }
						  else
						  {
						     $f3t3=0;
						  }
						  //end form three term three
						  
						  //form four term one
						  $ck=mysqli_query($con,"select * from individualmeangrade where class='4' && term='one' && studentid='$studentidreal'");
						  $ngapi=mysqli_num_rows($ck);
						  if($ngapi!=0)
						  {
						  $kc=mysqli_fetch_array($ck);
						  $nayo=$kc['meangrade'];
						  $nayo=round($nayo,1);
						  $f4t1=$nayo;
						  }
						  else
						  {
						     $f4t1=0;
						  }
						  //end form four term one
						  
						  //form four term two
						  $ck=mysqli_query($con,"select * from individualmeangrade where class='4' && term='two' && studentid='$studentidreal'");
						  $ngapi=mysqli_num_rows($ck);
						  if($ngapi!=0)
						  {
						  $kc=mysqli_fetch_array($ck);
						  $nayo=$kc['meangrade'];
						  $nayo=round($nayo,1);
						  $f4t2=$nayo;
						  }
						  else
						  {
						     $f4t2=0;
						  }
						  //end form four term two
						  
						  //form four term three
						  $ck=mysqli_query($con,"select * from individualmeangrade where class='4' && term='three' && studentid='$studentidreal'");
						  $ngapi=mysqli_num_rows($ck);
						  if($ngapi!=0)
						  {
						  $kc=mysqli_fetch_array($ck);
						  $nayo=$kc['meangrade'];
						  $nayo=round($nayo,1);
						  $f4t3=$nayo;
						  }
						  else
						  {
						     $f4t3=0;
						  }
						  //end form four term three
	?>
						  <script>

		                    var barChartData = 
							{
								labels : ["F1T1(<?php echo $f1t1; ?>)","F1T2(<?php echo $f1t2; ?>)","F1T3(<?php echo $f1t3; ?>)","F2T1(<?php echo $f2t1; ?>)","F2T2(<?php echo $f2t2; ?>)","F2T3(<?php echo $f2t3; ?>)","F3T1(<?php echo $f3t1; ?>)","F3T2(<?php echo $f3t2; ?>)","F3T3(<?php echo $f3t3; ?>)","F4T1(<?php echo $f4t1; ?>)","F4T2(<?php echo $f4t2; ?>)","F4T3(<?php echo $f4t3; ?>)","target(<?php echo "100"; ?>)"],
								datasets : 
								[
				
								{
									fillColor : "rgba(151,187,205,0.5)",
									strokeColor : "rgba(151,187,205,1)",
									data : [ <?php echo $f1t1; ?>,<?php echo $f1t2; ?>,<?php echo $f1t3; ?>,<?php echo $f2t1; ?>,<?php echo $f2t2; ?>,<?php echo $f2t3; ?>,<?php echo $f3t1; ?>,<?php echo $f3t2; ?>,<?php echo $f3t3; ?>,<?php echo $f4t1; ?>,<?php echo $f4t2; ?>,<?php echo $f4t3; ?>,<?php echo "100"; ?> ]
								}
								]
			
							}

							var myLine = new Chart(document.getElementById("<?php echo $loop;?>canvas").getContext("2d")).Bar(barChartData);
	
						   </script>
						  <?php
						  //end of graphing the performance out
						  
						  //start of footer details
								 echo'
								 <br/><br/><br/>
								 <div class="mguu">
								 <table border="0" style="width:100%;"> 
								 <tr>
								 <td>CLASS TEACHERS COMMENTS: '.$teachercomments.'</td>
								 </tr>
								 <tr>
								 <td>PRINCIPAL\'S MESSAGE: '.$principlecomments.'</td>
								 </tr>
								 <tr>
								 <td style="width:20%;">PRINCIPAL\'S SIGN: <img src="../images/sign.png" style="width:50px;height:18px;"/></td>
								 </tr>
								 </table>
								 </div>
								 <br/><br/>
								 <p style="float:left;width:40%;">
								 ';
								 $chq=mysqli_query($con,"select * from currentterm");
								 $q=mysqli_fetch_array($chq);
								 $currentopening=$q['openingdate'];
								 $currentclosing=$q['closingdate'];
								 echo'
								 Closing Date:';
								 echo $currentclosing;
								 echo'
								 </p>
								 <p style="float:right;width:40%;">
								 Opening Date:';
								 echo $currentopening;
								 echo'
								 </p>
								 ';
								 echo"</div>
								 <br/><br/><br/>
								 ";	
						  //end of footer details
					 echo"</div>";
				 }
			 }
		 }
	 }
	 elseif($want=="no")
	 {
	     header("location:../examviewreports.php");
	 }
}
else
{
echo"necessary variables not sent in<br/><a href='../examviewreports.php'>Try Again</a>";
}
?>
</center>
</body>
</html>
<?php
ob_flush()
?>