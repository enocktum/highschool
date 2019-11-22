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
	header("location:../aliens");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="../images/icon.ico"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Enosoft, making software that amazes you">
		<meta name="keywords" content="highschool systems, school management software">
		<meta name="author" content="Enock Tum">
		<title><?php echo $schoolname; ?></title>
 
		<!-- BOOTSTRAP CSS (REQUIRED ALL PAGE)-->
		<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
		
		<!-- PLUGINS CSS -->
		<link href="../assets/plugins/weather-icon/css/weather-icons.min.css" rel="stylesheet">
		<link href="../assets/plugins/prettify/prettify.min.css" rel="stylesheet">
		<link href="../assets/plugins/magnific-popup/magnific-popup.min.css" rel="stylesheet">
		<link href="../assets/plugins/owl-carousel/owl.carousel.min.css" rel="stylesheet">
		<link href="../assets/plugins/owl-carousel/owl.theme.min.css" rel="stylesheet">
		<link href="../assets/plugins/owl-carousel/owl.transitions.min.css" rel="stylesheet">
		<link href="../assets/plugins/chosen/chosen.min.css" rel="stylesheet">
		<link href="../assets/plugins/icheck/skins/all.css" rel="stylesheet">
		<link href="../assets/plugins/datepicker/datepicker.min.css" rel="stylesheet">
		<link href="../assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
		<link href="../assets/plugins/validator/bootstrapValidator.min.css" rel="stylesheet">
		<link href="../assets/plugins/summernote/summernote.min.css" rel="stylesheet">
		<link href="../assets/plugins/markdown/bootstrap-markdown.min.css" rel="stylesheet">
		<link href="../assets/plugins/datatable/css/bootstrap.datatable.min.css" rel="stylesheet">
		<link href="../assets/plugins/morris-chart/morris.min.css" rel="stylesheet">
		<link href="../assets/plugins/c3-chart/c3.min.css" rel="stylesheet">
		<link href="../assets/plugins/slider/slider.min.css" rel="stylesheet">
		<link href="../assets/plugins/salvattore/salvattore.css" rel="stylesheet">
		<link href="../assets/plugins/toastr/toastr.css" rel="stylesheet">
		<link href="../assets/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet">
		<link href="../assets/plugins/fullcalendar/fullcalendar/fullcalendar.print.css" rel="stylesheet" media="print">
		
		<!-- MAIN CSS (REQUIRED ALL PAGE)-->
		<link href="../assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<link href="../assets/css/style.css" rel="stylesheet">
		<link href="../assets/css/style-responsive.css" rel="stylesheet">
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
						<a href="../index"><img src="../assets/img/enosoft.png" alt="Sentir logo"></a>
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
		include("../connection.php");
		error_reporting(E_ERROR);
		$date=date("Y-m-d");
		$heri=mysqli_query($con,"select * from currentterm");
		$ri=mysqli_fetch_array($heri);
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
							EXAMINATION SETUP
							</a>
						<ul class="submenu visible">
							<li><a href="../examsetup">Exams Home</a></li>
							<li><a href="../exambasicsettings">Basic Settings</a></li>
							<li><a href="../exampromotestudent">Pro(De)mote Students</a></li>
							<li class="active selected"><a href="../examviewreports">View Reports</a></li>
							<li><a href="../examlogout">Logout</a></li>
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
					<h2 style="font-size:1.7em;color:green;text-transform:uppercase;text-align:center;">EXAM REPORT FORM RESULTS</h2>
<center>
<?php
include"../connection.php";
error_reporting(E_ERROR);
$exam=$_POST['exam'];
$class=$_POST['class'];
$year=$_POST['year'];
$term=$_POST['term'];
if(isset($exam) && isset($class) && isset($year) && isset($term))
{
$allstudents=mysqli_query($con,"select * from studentdetails where currentclass='$class' && status='1'");
$noofstudents=mysqli_num_rows($allstudents);
     //checking if there are students in that specified class
     if($noofstudents != 0)
     {
	     //start checking if all students have done exams
		 $counter=0;
		 //start of getting active students examinations records
         $allexamined=mysqli_query($con,"select * from individualmeangrade where class='$class' && year='$year' && term='$term' ");
		 while($walal=mysqli_fetch_array($allexamined))
		 {
		     $kita=$walal['studentid'];
			 $ona=mysqli_query($con,"select * from studentdetails where currentclass='$class' && status='1'");
			 while($nao=mysqli_fetch_array($ona))
			 {
			     $kitabuli=$nao['admissionnumber'];
				 if($kitabuli == $kita)
				 {
				    $counter=$counter + 1;
				 }
				 else
				 {
				     
				 }
			 }
		  }
		 //end of getting active students examinations records
		 
		 $noofstudentsexamined=$counter;
		 if($noofstudents == $noofstudentsexamined)
		 {
		     echo"
			 <fieldset>
			 <legend>ALL STUDENTS HAVE FINISHED THEIR EXAMS</legend>
			 <div style='border:solid blue 2px;width:70%;'>
			 <h4><u><strong>BELOW IS/ARE THE STUDENT(S)</strong></u></h4>
			 ";
			 echo"<table border='0' style='width:100%;text-align:left;'>
			 <tr>
			 <th>NAME</th>
			 <th>STUDENT ID</th>
			 </tr>
			 ";
			 while($tata=mysqli_fetch_array($allstudents))
			 {
			    echo"
				<tr>
				<td>".$tata['firstname']." ".$tata['middlename']." ".$tata['lastname']."</td>
				<td>".$tata['admissionnumber']."</td>
				</tr>
				";
			 }
			 echo"</table>";
			 echo"
			 </div>
			 <br/><br/>
			 <form action='printreportform' method='post'>
			 DO YOU WANT TO PRINT THEIR RESPECTIVE REPORT FORMS?<br/>
			 <input type='radio' name='want' value='yes'/> Yes
			 <input type='radio' name='want' value='no'/> No
			 <br/>
			 <input type='hidden' name='term' value='".$term."'/>
			 <input type='hidden' name='class' value='".$class."'/>
			 <input type='hidden' name='year' value='".$year."'/>
			 <input type='hidden' name='exam' value='".$exam."'/>
			 <input type='submit' value='SUBMIT CHOICE' style='background-color:green;color:white;'/>
			 </form>
			 </fieldset>
			 ";
		 }
		 elseif($noofstudents > $noofstudentsexamined)
		 {
		     $notexamined=$noofstudents-$noofstudentsexamined;
		     echo"
			 <fieldset>
			 <legend style='text-transform:uppercase;font-size:2em;'><b>$notexamined student(s)</b> out of <b>$noofstudents student(s)</b> not examined in <b>form $class</b></legend>
			 <div style='width:70%;'>
			 <h4><u><strong>BELOW IS/ARE THE STUDENT(S)</strong></u></h4>
			 ";
			 echo"<table border='0' style='width:100%;text-align:left;'>
			 <tr>
			 <th>NAME</th>
			 <th>STUDENT ID</th>
			 <th>EXAM DONE</th>
			 </tr>
			 ";
			 $n=mysqli_query($con,"select * from individualmeangrade where class='$class' && year='$year' && term='$term'");
			 while($w=mysqli_fetch_array($n))
			 {
			     $id=$w['studentid'];
				 while($h=mysqli_fetch_array($allstudents))
				 {
				     $k=$h['admissionnumber'];
					 $q=$h['firstname']." ".$h['middlename']." ".$h['lastname'];
					 if($k==$id)
					 {
					     echo"
						 <tr style='background-color:green;color:white;'>
						 <td>$k</td>
						 <td>$q</td>
						 <td>YES</td>
						 </tr>
						 ";
					 }
					 else
					 {
					     echo"
						 <tr style='background-color:red;color:white;'>
						 <td>$k</td>
						 <td>$q</td>
						 <td>NO</td>
						 </tr>
						 ";
					 }
				 }
			 }
			 echo"</table>
			 <br/><br/>
			 ";
			 echo"
			 </div>
			 <br/><br/>
			 <form action='printreportform' method='post'>
			 DO YOU WANT TO GO AHEAD AND PRINT THE RESPECTIVE REPORT FORMS OF THE STUDENTS WHO HAVE DONE EXAMS?<br/>
			 <input type='radio' name='want' value='yes'/> Yes
			 <input type='radio' name='want' value='no'/> No
			 <br/>
			 <input type='hidden' name='term' value='".$term."'/>
			 <input type='hidden' name='class' value='".$class."'/>
			 <input type='hidden' name='year' value='".$year."'/>
			 <input type='hidden' name='exam' value='".$exam."'/>
			 <input type='submit' value='SUBMIT CHOICE' style='background-color:green;color:white;'/>
			 </form>
			 </fieldset>
			 ";
		 }
		 
		 //end of checking if all students have done exams
     }
	 else
	 {
	     echo"There are no students in form $class qualified for report forms. This may be due to all students have been suspended, graduated or there are no students in the database. Consult the admission officer for more information<br/><a href='../examviewreports'>Try Again</a>";
	 }
	 //end of checking if there are students in the specified class
}
else
{
echo"necessary variables not sent in<br/><a href='../examviewreports'>Try Again</a>";
}
?>
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