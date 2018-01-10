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
if(!isset($_SESSION['admissionlogin']))
{
	header("location:aliens");
}
?>
<?php
if(!isset($_SESSION['studentregistrationlogin']))
{
	header("location:admissionhome");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="images/icon.ico"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="enosoft company, highschool system, kenyan highschool management systems">
		<meta name="keywords" content="highschool management system">
		<meta name="author" content="Enock Tum, Enosoft Company">
		
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
						<a href="http://www.enocktum.tk" target="_blank"><img src="assets/img/enosoft.png" alt="enosoft logo"></a>
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
							STUDENT ADMISSION
							</a>
						<ul class="submenu visible">
							<li><a href="studentadminhome">Student Admin Home</a></li>
							<li><a href="addstudent">Add Student</a></li>
							<li class="active selected"><a href="viewstudent">View Student</a></li>
							<li><a href="editstudent">Edit Student</a></li>
							<li><a href="studentadminhomelogout">Logout</a></li>
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
					<center>
            <?php
			error_reporting(E_ERROR);
			include("connection.php");
			$studentid=$_POST['studentid'];
			$mathematics=$_POST['mathematics'];
			$english=$_POST['english'];
			$kiswahili=$_POST['kiswahili'];
			$chemistry=$_POST['chemistry'];
			$biology=$_POST['biology'];
			$physics=$_POST['physics'];
			$agriculture=$_POST['agriculture'];
			$businessstudies=$_POST['businessstudies'];
			$geography=$_POST['geography'];
			$historyandgovernment=$_POST['historyandgovernment'];
			$cre=$_POST['cre'];
			if($mathematics && $english && $kiswahili && $chemistry && $studentid)
			{
			     if($agriculture && $businessstudies)
				 {
				     echo"You can not select both agriculture and business studies<br/><a href='viewstudent'>Try Again</a>";
				 }
                 elseif($agriculture=="" && $businessstudies=="")
                 {
				     echo"you have to select one applied subject<br/><a href='viewstudent'>Try Again</a>";
				 }				 
				 else
				 {
				     if($agriculture)
					 {
					    $applied=$agriculture;
					 }
					 elseif($businessstudies)
					 {
					    $applied=$businessstudies;
					 }
					 if($geography && $cre && $historyandgovernment)
					 {
					     echo"You can not select all the humanities,select only two or one<br/><a href='viewstudent'>Try Again</a>";
					 }
					 else
					 {
					     //start of humanities selection
						 if($geography && $historyandgovernment)
						 {
						     $humanities=$geography.",".$historyandgovernment;
						 }
						 elseif($geography && $cre)
						 {
						     $humanities=$geography.",".$cre;
						 }
						 elseif($historyandgovernment && $cre)
						 {
						     $humanities=$cre.",".$historyandgovernment;
						 }
						 elseif($cre)
						 {
						     $humanities=$cre;
						 }
						 elseif($historyandgovernment)
						 {
						     $humanities=$historyandgovernment;
						 }
						 elseif($geography)
						 {
						     $humanities=$geography;
						 }
						 else
						 {
						     echo"choose at least one subject in humanities section<br/><a href='viewstudent'>Try Again</a>";
						 }
						 
						 
						 //end of humanities selection
						 //start of sciences
						 if($chemistry && $biology && $physics)
						 {
						     $sciences=$chemistry.",".$biology.",".$physics;
						 }
						 elseif($chemistry && $biology)
						 {
						     $sciences=$chemistry.",".$biology;
						 }
						 elseif($chemistry && $physics)
						 {
						     $sciences=$chemistry.",".$physics;
						 }
						 else
						 {
						     echo"choose at least one non-compulsory subject in sciences section<br/><a href='viewstudent'>Try Again</a>";
						 }
						 //end of sciences
						 
						 //putting up all subjects into derivated string
						 $subjectsinscience=explode(",",$sciences);
						 $subjectsinhumanities=explode(",",$humanities);
						 $scihum=array_merge($subjectsinscience,$subjectsinhumanities);
						 $stringall=implode(",",$scihum);
						 //add basic subjects
						 $stringall=$stringall.",".$applied.",".$english.",".$mathematics.",".$kiswahili;
						 //end of adding basic subjects
						 
						 //adding of data to database
						 $checksu=mysql_query("select * from studentdetails where admissionnumber='$studentid' && status='1'");
						 $numb=mysql_num_rows($checksu);
						 if($numb>0)
						 {  
						     $studails=mysql_fetch_array($checksu);
							 $currentclass=$studails['currentclass'];
						     $che=mysql_query("select * from studentselectedsubjects where studentid='$studentid'");
							 $ata=mysql_num_rows($che);
							 if($ata == 0)
							 {
							     $checkk=mysql_query("select * from subjectchoiceclass");
								 $k=mysql_fetch_array($checkk);
								 $subjectsclass=$k['class'];
								 if($currentclass >= $subjectsclass)
								 {
								     $insert=mysql_query("insert into studentselectedsubjects (studentid,subjects) values('$studentid','$stringall')");
									 if($insert)
									 {
									     header("location:viewstudent");
									 }
									 else
									 {
									     echo"student has not been added successfully to table <br/><a href='viewstudent'>Try Again</a>";
									 }
								 }
								 else
								 {
								     echo"student is in lower level and not qualified for subject selection <br/><a href='viewstudent'>Try Again</a>";
								 }
							 }
							 else
							 {
							     echo"student subjects already exists<br/><a href='viewstudent'>Try Again</a>";
							 }
						 }
						 else
						 {
						     echo"student does not exist in the school database either due to unregistration,discontinuation or graduation<br/><a href='viewstudent'>Try Again</a>";
						 }
						 //end of adding data to database
					 }
				 }
			}
			else
			{
			     echo"Fill the compulsory fields<br/><a href='viewstudent'>Try Again</a>";
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
