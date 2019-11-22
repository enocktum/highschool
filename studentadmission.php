<?php
ob_start();
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
if(!isset($_SESSION['admissionlogin']))
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
		<meta name="description" content="enosoft company, highschool system, kenyan highschool management systems">
		<meta name="keywords" content="Enosoft Company Software, Management software, highschool management software">
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
							ADMISSIONS PAGE
							</a>
						<ul class="submenu visible">
							<li><a href="admissionhome">Admission Home</a></li>
							<li class="active selected"><a href="studentadmission">Student Admission</a></li>
							<li><a href="teacheradmission">Teacher Admission</a></li>
							<li><a href="admissionlogout">Logout</a></li>
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
					<form class="form-signin" style="width:50%;" action="studentsregistrationlogin" method="post">
					<h2 class="form-signin-heading">Student Admission Officer Login</h2>
					<label for="inputUsername" class="sr-only">Enter Username</label>
					<input type="text" name="username" class="form-control" placeholder="username" required autofocus>
					<br/><br/>
					<label for="inputPassword" class="sr-only">Enter Password</label>
					<input name="password" type="password" id="inputPassword" class="form-control" placeholder="password" required>
					<div class="checkbox">
					<label>
					<input type="checkbox" value="remember-me"> Remember me
					</label>
					</div>
					<input class="btn btn-lg btn-primary btn-block" type="submit" value="Login"/>
					</form>
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
