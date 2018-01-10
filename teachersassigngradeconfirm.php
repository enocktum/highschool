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
if(!isset($_SESSION['teacherlogin']))
{
	header("location:aliens");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="images/icon.ico"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Enosoft, making software that amazes you">
		<meta name="keywords" content="highschool systems, school management software">
		<meta name="author" content="Enock Tum">
		<title><?php echo $schoolname; ?></title>
 
		<!-- BOOTSTRAP CSS (REQUIRED ALL PAGE)-->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		
		<!-- PLUGINS CSS -->
		<link href="assets/plugins/weather-icon/css/weather-icons.min.css" rel="stylesheet">
		<link href="assets/plugins/prettify/prettify.min.css" rel="stylesheet">
		<link href="assets/plugins/magnific-popup/magnific-popup.min.css" rel="stylesheet">
		<link href="assets/plugins/owl-carousel/owl.carousel.min.css" rel="stylesheet">
		<link href="assets/plugins/owl-carousel/owl.theme.min.css" rel="stylesheet">
		<link href="assets/plugins/owl-carousel/owl.transitions.min.css" rel="stylesheet">
		<link href="assets/plugins/chosen/chosen.min.css" rel="stylesheet">
		<link href="assets/plugins/icheck/skins/all.css" rel="stylesheet">
		<link href="assets/plugins/datepicker/datepicker.min.css" rel="stylesheet">
		<link href="assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
		<link href="assets/plugins/validator/bootstrapValidator.min.css" rel="stylesheet">
		<link href="assets/plugins/summernote/summernote.min.css" rel="stylesheet">
		<link href="assets/plugins/markdown/bootstrap-markdown.min.css" rel="stylesheet">
		<link href="assets/plugins/datatable/css/bootstrap.datatable.min.css" rel="stylesheet">
		<link href="assets/plugins/morris-chart/morris.min.css" rel="stylesheet">
		<link href="assets/plugins/c3-chart/c3.min.css" rel="stylesheet">
		<link href="assets/plugins/slider/slider.min.css" rel="stylesheet">
		<link href="assets/plugins/salvattore/salvattore.css" rel="stylesheet">
		<link href="assets/plugins/toastr/toastr.css" rel="stylesheet">
		<link href="assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet">
		<link href="assets/plugins/fullcalendar/fullcalendar/fullcalendar.print.css" rel="stylesheet" media="print">
		
		<!-- MAIN CSS (REQUIRED ALL PAGE)-->
		<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="assets/css/style.css" rel="stylesheet">
		<link href="assets/css/style-responsive.css" rel="stylesheet">
 
	</head>
 
	<body class="tooltips">
		
		
		
		<!--
		===========================================================
		BEGIN PAGE
		===========================================================
		-->
		<div class="wrapper">
			<!-- BEGIN TOP NAV -->
			<div class="top-navbar">
				<div class="top-navbar-inner">
					
					<!-- Begin Logo brand -->
					<div class="logo-brand">
						<a href="index"><img src="assets/img/enosoft.png" alt="kabisa"></a>
					</div><!-- /.logo-brand -->
					<!-- End Logo brand -->
					
					<div class="top-nav-content no-right-sidebar">
						
						<!-- Begin button sidebar left toggle -->
						<div class="btn-collapse-sidebar-left">
							<i class="fa fa-bars"></i>
						</div><!-- /.btn-collapse-sidebar-left -->
						<!-- End button sidebar left toggle -->
						
						<!-- Begin button nav toggle -->
						<div class="btn-collapse-nav" data-toggle="collapse" data-target="#main-fixed-nav">
							<i class="fa fa-plus icon-plus"></i>
						</div><!-- /.btn-collapse-sidebar-right -->
						<!-- End button nav toggle -->
						<!-- Begin Collapse menu nav -->
						<div class="collapse navbar-collapse" id="main-fixed-nav">
						<h1><?php echo $schoolname;?>
						<?php
		include("connection.php");
		error_reporting(E_ERROR);
		$date=date("Y-m-d");
		$heri=mysql_query("select * from currentterm");
		$ri=mysql_fetch_array($heri);
		$term=$ri['term'];
		if($term)
		{
		echo "(term: $term and date: $date)";
		}
		else
		{
		echo"CURRENT TERM: unavailable";	
		}
		?>
						</h1>
						</div><!-- /.navbar-collapse -->
						<!-- End Collapse menu nav -->
					</div><!-- /.top-nav-content -->
				</div><!-- /.top-navbar-inner -->
			</div><!-- /.top-navbar -->
			<!-- END TOP NAV -->
			
			
			
			<!-- BEGIN SIDEBAR LEFT -->
			<div class="sidebar-left sidebar-nicescroller">
				<ul class="sidebar-menu">
					<li class="active selected">
						<a href="">
							<i class="fa fa-desktop icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							TEACHER SCREEN
							</a>
						<ul class="submenu visible">
							<li><a href="teachershome">Teacher Home</a></li>
							<li class="active selected"><a href="teachersassigngrade">Assign Grades</a></li>
							<li><a href="teachersperformancereport">Perfomance Report</a></li>
							<li><a href="teacherslogout">Logout</a></li>
						</ul>
					</li>
					<li>
						<a href="">
							<i class="fa fa-desktop icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							SYSTEM EXTRAS
							</a>
						<ul class="submenu visible">
							<li
							><a href="">System Help</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.sidebar-left -->
			<!-- END SIDEBAR LEFT -->
			
			<!-- BEGIN PAGE CONTENT -->
			<div class="page-content">
			<br/><br/>
				<div class="container-fluid">
					<!-- BEGIN CAROUSEL ITEM -->
					<div class="the-box no-border">
					<h2 style="font-size:1.7em;color:green;text-transform:uppercase;text-align:center;">Teacher assign student grade results</h2>
			<center>
			<p>
			<?php
			error_reporting(E_ERROR);
			$subject=$_POST['subject'];
            $string=$_POST['string'];
			$exam=$_POST['exam'];
			$rawmarks=$_POST['rawmarks'];
			if($subject && $string && $exam && $rawmarks)
			{
			if($rawmarks > 0)
			{
			
			        //start of getting current term
			        $perry=mysql_query("select * from currentterm");
			        $erry=mysql_fetch_array($perry);
			        $term=$erry['term'];
			        //end of getting term info
			//exploding the string into an array
			$divide=explode("|",$string);
			//end of exploding the string into an array
			for($counter=0;$counter<=count($divide);$counter++)
			{
				$two=$divide[$counter];
				$onearray=explode(",",$two);
				$stuid=$onearray[0];
				$studentid=$_POST[$stuid];
				$mar=$onearray[1];
				$marks=$_POST[$mar];
				//checking for empty important variables
				if($studentid && isset($marks))
				{
					//start of insertion of marks and checking for marks exceeding the raw marks
					if($marks <= $rawmarks)
					{
					if(($marks > -1))
					{
					//start of calculating student details
					$cla=mysql_query("select * from studentdetails where admissionnumber='$studentid'");
					$no=mysql_num_rows($cla);
					if($no > 0)
					{
					$ss=mysql_fetch_array($cla);
					$class=$ss['currentclass'];
					$name=$ss['firstname']." ".$ss['middlename']." ".$ss['lastname'];
					//end of calculating student details
					$percentage=($marks/$rawmarks) * 100;
					//start of calculating grade
					$gradi=mysql_query("select * from gradingsystem");
					while($systim=mysql_fetch_array($gradi))
					{
					     $rangee=$systim['rangee'];
						 $grade=$systim['grade'];
						 $yote=explode("-",$rangee);
						 $firstrange=$yote[0];
						 $secondrange=$yote[1];
						 if(($percentage > $firstrange) && ($percentage <= $secondrange))
						 { 
						      $gradit=$grade;
						 }
					}
					$squi=mysql_query("select * from gradingsystem where grade='$gradit' && subject='$subject'");
					while($rel=mysql_fetch_array($squi))
					{
						$comments=$rel['comments'];
					}
					//end of calculating grade
					$year=date("Y");
					$info=mysql_query("select * from studentgrades where term='$term' && year='$year' && testname='$exam' && subject='$subject' && class='$class' && studentid='$studentid'");
					$rows=mysql_num_rows($info);
					if($rows < 1)
					{
					$arai=mysql_query("select * from exams where class='$class' && name='$exam'");
					$araata=mysql_num_rows($arai);
					if($araata>0)
					{
					//checking for students who have not selected classes
					$myme=mysql_query("select * from subjectchoiceclass");
					$memy=mysql_fetch_array($myme);
					$subjectchoiceclass=$memy['class'];
					if($class >= $subjectchoiceclass)
					{
					     //code for senior classes subject check
						 $wochei=mysql_query("select * from studentselectedsubjects where studentid='$studentid'");
						 $wocheiata=mysql_num_rows($wochei);
						 if($wocheiata > 0)
						 {
						     $subjectselected="selected";
						 }
						 else
						 {
						    $subjectselected="notselected";
						 }
						 //end code for senior classes subject check
					}
					elseif($class < $subjectchoiceclass)
					{
					     //code for junior classes subject check
						 $wochei=mysql_query("select * from studentbasicsubject");
						 $wocheiata=mysql_num_rows($wochei);
						 if($wocheiata > 0)
						 {
						     $subjectselected="selected";
						 }
						 else
						 {
						    $subjectselected="notselected";
						 }
						 //end code for junior classes subject check
					}
					if($subjectselected=="selected")
					{
					
					//start of subject recognition software
					if($class >= $subjectchoiceclass)
					{
					     $neismu=mysql_query("select * from studentselectedsubjects where studentid='$studentid'");
						 $mus=mysql_fetch_array($neismu);
						 $subjex=$mus['subjects'];
						 $allinarray=explode(",",$subjex);
						 foreach($allinarray as $oneinarray)
						 {
						     if($oneinarray == $subject)
							 {
							     $ndip=1;
							 }
						 }
					}
					//end of subject recognition software
					
					if($class >= $subjectchoiceclass)
					{
					if(isset($ndip))
					{
					//start of insertion of grades into the software
					$insert=mysql_query("insert into studentgrades (term,testname,marksgained,rawmarks,studentid,subject,year,percentagemarks,class,grade,remarks) values ('$term','$exam','$marks','$rawmarks','$studentid','$subject','$year','$percentage','$class','$gradit','$comments')");
				    if($insert)
				    {
						echo"<font color='#0000FF'>grades for student $studentid has been successfully submitted</font><br/>";
				    }
				    else
				    {
						echo"Grades not submited<br/><a href='teachersassigngrade'>Try Again</a><br/>";
				    }
					//end of insertion of grades into the software
					}
					else
					{
					     echo"<font color='#990000'>grades for student $studentid who is in $class has not been successfully submitted. The student who is in form $class does not take subject named $subject which you have assigned him/her.</font><br/>";
					}
					}
					elseif($class < $subjectchoiceclass)
					{
					//start of insertion of grades into the software
					$insert=mysql_query("insert into studentgrades (term,testname,marksgained,rawmarks,studentid,subject,year,percentagemarks,class,grade,remarks) values ('$term','$exam','$marks','$rawmarks','$studentid','$subject','$year','$percentage','$class','$gradit','$comments')");
				    if($insert)
				    {
						echo"<font color='#0000FF'>grades for student $studentid has been successfully submitted</font><br/>";
				    }
				    else
				    {
						echo"Grades not submited<br/><a href='teachersassigngrade'>Try Again</a><br/>";
				    }
					//end of insertion of grades into the software
					}
					
					}
					else
					{
					     if($class >= $subjectchoiceclass)
						 {
						 echo"<font color='#990000'>grades for student $studentid has not been successfully submitted. The student who is in form $class has not selected subjects.</font><br/>";
					     }
						 elseif($class < $subjectchoiceclass)
						 {
						     echo"<font color='#990000'>grades for student $studentid who is in $class has not been successfully submitted. The student's lower class subjects has not been set.</font><br/>";
						 }
					}
					}
					else
					{
					     echo"<font color='#990000'>grades for student $studentid has not been successfully submitted. The exam is not offered to class $class students in which the student belongs to.</font><br/>";
					}
					}
					else
					{
						//code to insert marks for repeaters if exists
						echo"<font color='#FF0000'>grades for student $studentid has not been successfully submitted because the record already exists</font><br/>";
						//end of code to insert marks for repeaters
					}
					}
					else
					{
						echo"<font color='#FF0000'>grades for student $studentid has not been successfully submitted because the student IS NOT REGISTERED in the system</font><br/>";
					}
					//end of if and start of else
					}
					else
					{
						echo"<font color='#990000'>grades for student $studentid has not been successfully submitted due to a negative mark $marks given</font><br/>";
					}
					//end of else
					}
					else
					{
						echo"<font color='#990000'>grades for student $studentid has not been successfully submitted due to marks: $marks being greater than raw marks: $rawmarks</font><br/>";
					}
				//end of insertion of marks and checking for marks exceeding the raw marks
				}
				//end of checking for empty important variable
				
				
			}
			}
			else
			{
				echo"Grades not submited because rawmarks $rawmarks is a negative number or zero<br/><a href='teachersassigngrade'>Try Again</a>";
			}
			}
			else
			{
				echo"Grades not submited due to variable problems<br/><a href='teachersassigngrade'>Try Again</a>";
			}
			echo"<br/><br/><a href='teachershome'>Go Home</a>
			";
			?>
			</p>
			</center>
					</div><!-- /.the-box .no-border -->
					<!-- END CAROUSEL ITEM -->
				</div><!-- /.container-fluid -->
				
				<!-- BEGIN FOOTER -->
				<footer style="text-align:left;" class="navbar navbar-default navbar-fixed-bottom">
					<div style="text-align:center;" class="container-fluid">&copy; <?php echo date("Y");?> <a href=""><?php echo $schoolname;?></a> 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					Design by <a href="http://www.enosoft.tk" target="_blank">Enock Tum</a>.</div>
				</footer>
				<!-- END FOOTER -->
				
				
			</div><!-- /.page-content -->
		</div><!-- /.wrapper -->
		<!-- END PAGE CONTENT -->
		
		
		<!--
		===========================================================
		END PAGE
		===========================================================
		-->
		
		<!--
		===========================================================
		Placed at the end of the document so the pages load faster
		===========================================================
		-->
		<!-- MAIN JAVASRCIPT (REQUIRED ALL PAGE)-->
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/plugins/retina/retina.min.js"></script>
		<script src="assets/plugins/nicescroll/jquery.nicescroll.js"></script>
		<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		<script src="assets/plugins/backstretch/jquery.backstretch.min.js"></script>
 
		<!-- PLUGINS -->
		<script src="assets/plugins/skycons/skycons.js"></script>
		<script src="assets/plugins/prettify/prettify.js"></script>
		<script src="assets/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
		<script src="assets/plugins/owl-carousel/owl.carousel.min.js"></script>
		<script src="assets/plugins/chosen/chosen.jquery.min.js"></script>
		<script src="assets/plugins/icheck/icheck.min.js"></script>
		<script src="assets/plugins/datepicker/bootstrap-datepicker.js"></script>
		<script src="assets/plugins/timepicker/bootstrap-timepicker.js"></script>
		<script src="assets/plugins/mask/jquery.mask.min.js"></script>
		<script src="assets/plugins/validator/bootstrapValidator.min.js"></script>
		<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
		<script src="assets/plugins/datatable/js/bootstrap.datatable.js"></script>
		<script src="assets/plugins/summernote/summernote.min.js"></script>
		<script src="assets/plugins/markdown/markdown.js"></script>
		<script src="assets/plugins/markdown/to-markdown.js"></script>
		<script src="assets/plugins/markdown/bootstrap-markdown.js"></script>
		<script src="assets/plugins/slider/bootstrap-slider.js"></script>
		
		<script src="assets/plugins/toastr/toastr.js"></script>
		
		<!-- C3 JS -->
		<script src="assets/plugins/c3-chart/d3.v3.min.js" charset="utf-8"></script>
		<script src="assets/plugins/c3-chart/c3.min.js"></script>
		
		<!-- MAIN APPS JS -->
		<script src="assets/js/apps.js"></script>
		<script src="assets/js/demo-panel.js"></script>
		
	</body>
</html>
<?php 
ob_flush();
?>