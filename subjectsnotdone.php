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
							EXAMINATION SETUP
							</a>
						<ul class="submenu visible">
							<li><a href="examsetup">Exams Home</a></li>
							<li><a href="exambasicsettings">Basic Settings</a></li>
							<li><a href="exampromotestudent">Pro(De)mote Students</a></li>
							<li class="active selected"><a href="examviewreports">View Reports</a></li>
							<li><a href="examlogout">Logout</a></li>
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
					<p>
		<center>
<?php
include"connection.php";
error_reporting(E_ERROR);
$link=$_GET['link'];
if(isset($link))
{
     $linkarray=explode(",",$link);
	 $exam=$linkarray[0];
	 $studentid=$linkarray[1];
	 $term=$linkarray[2];
	 $gett=mysql_query("select * from studentdetails where admissionnumber='$studentid'");
	 $tteg=mysql_fetch_array($gett);
	 $year=date("Y");
	 $class=$tteg['currentclass'];
	 //start of getting all subjects done by student
	 $kn=mysql_query("select * from subjectchoiceclass");
	 $nk=mysql_fetch_array($kn);
	 $subselclass=$nk['class'];
	 if($class >= $subselclass)
	 {
	     //senior students
		 $sle=mysql_query("select * from studentselectedsubjects where studentid='$studentid'");
		 $howm=mysql_num_rows($sle);
		 if($howm==1)
		 {
		     $els=mysql_fetch_array($sle);
			 $subjex=$els['subjects'];
			 $subjexarray=explode(",",$subjex);
			 $ata=count($subjexarray);
			 //start of all subjects selected
			  echo"<br/><div style='width:100%;background-color:green;color:white;'>";
			  echo"<h3>SUBJECTS SELECTED BY STUDENT $studentid</h3>";
			  echo"<table border='1' style='width:100%;'>";
			  echo"<tr>";
			  foreach($subjexarray as $onebyone)
			  {
			     echo"<td> $onebyone </td>";
			  }
			  echo"</table>";
			  echo"</div>";
			  //end of all subjects selected
			 $ojei=mysql_query("SELECT * FROM studentgrades WHERE studentid='$studentid' && class='$class' && year='$year' && testname='$exam' && term='$term'");
			 $numberr=mysql_num_rows($ojei);
			 if($numberr==0)
			 {
			 //start of subjects not done
			  echo"<br/><br/><br/><div style='width:100%;background-color:black;color:red;'>";
			  echo"<h3>SUBJECTS NOT DONE BY STUDENT $studentid</h3>";
			  echo"<table border='1' style='width:100%;'>";
			  echo"<tr>";
			  foreach($subjexarray as $onebyone)
			  {
			     echo"<td> $onebyone </td>";
			  }
			  echo"</table>";
			  echo"</div>";
			  //end of subjects not done
			  //start of subjects done
			  echo"<br/><br/><br/><div style='width:100%;background-color:blue;color:white;'>";
			  echo"<h3>SUBJECTS DONE BY STUDENT $studentid</h3>";
			  echo"<table border='1' style='width:100%;text-align:center;'>";
			  echo"<tr>";
			  echo"<td>0 subjects done</td>";
			  echo"</table>";
			  echo"</div>";
			  //end of subjects done
			 }
			 elseif($numberr > 0)
			 {
			 //start of partially or fully done subjects
			 $done="";
			 while($aja=mysql_fetch_array($ojei))
			 {
			     $subjeci=$aja['subject'];
				 foreach($subjexarray as $onebyone)
				 {
				     if($subjeci==$onebyone)
					 {
						 if($done=="")
						 {
						     $done=$onebyone;
						 }
						 else
						 {
						     $done=$done.",".$onebyone;
						 }
					 }
				 }
			 }
			 $donearray=explode(",",$done);
			 
			 //subjects not done
			 $notdonearray=array_diff($subjexarray,$donearray);
			 echo "<br/>";
			  echo"<br/><br/><br/><div style='width:100%;background-color:black;color:red;'>";
			  echo"<h3>SUBJECTS NOT DONE BY STUDENT $studentid</h3>";
			  echo"<table border='1' style='width:100%;'>";
			  echo"<tr>";
			  foreach($notdonearray as $notdone)
			  {
			     echo"<td>$notdone</td>";
			  }
			  echo"</tr>";
			  echo"</table>";
			  echo"</div>";
			 //end of subjects not done
			  
			  //subjects done
			 echo"<br/><br/><br/><div style='width:100%;background-color:blue;color:white;'>";
			  echo"<h3>SUBJECTS DONE BY STUDENT $studentid</h3>";
			  echo"<table border='1' style='width:100%;'>";
			  echo"<tr>";
			  foreach($donearray as $onebyone)
			  {
			     echo"<td> $onebyone </td>";
			  }
			  echo"</table>";
			  echo"</div>";
			  //end of subjects done
			 //end of partially or fully done subjects
			 }
		 }
		 elseif($howm==0)
		 {
		     echo"student $studentid has not selected subjects<br/><a href='examviewreports'>try again</a>";
		 }
		 //end senior students
	 }
	 elseif($class < $subselclass)
	 {
	     //junior students
		 $sle=mysql_query("select * from studentbasicsubject");
		 $howm=mysql_num_rows($sle);
		 if($howm==1)
		 {
		     $els=mysql_fetch_array($sle);
			 $subjex=$els['subjects'];
			 $subjexarray=explode(",",$subjex);
			 $ata=count($subjexarray);
			 //start of all subjects selected
			  echo"<br/><div style='width:100%;background-color:green;color:white;'>";
			  echo"<h3>SUBJECTS SELECTED BY STUDENT $studentid</h3>";
			  echo"<table border='1' style='width:100%;'>";
			  echo"<tr>";
			  foreach($subjexarray as $onebyone)
			  {
			     echo"<td> $onebyone </td>";
			  }
			  echo"</table>";
			  echo"</div>";
			  //end of all subjects selected
			 $ojei=mysql_query("SELECT * FROM studentgrades WHERE studentid='$studentid' && class='$class' && year='$year' && testname='$exam' && term='$term'");
			 $numberr=mysql_num_rows($ojei);
			 if($numberr==0)
			 {
			 //start of subjects not done
			  echo"<br/><br/><br/><div style='width:100%;background-color:black;color:red;'>";
			  echo"<h3>SUBJECTS NOT DONE BY STUDENT $studentid</h3>";
			  echo"<table border='1' style='width:100%;'>";
			  echo"<tr>";
			  foreach($subjexarray as $onebyone)
			  {
			     echo"<td> $onebyone </td>";
			  }
			  echo"</table>";
			  echo"</div>";
			  //end of subjects not done
			  //start of subjects done
			  echo"<br/><br/><br/><div style='width:100%;background-color:blue;color:white;'>";
			  echo"<h3>SUBJECTS DONE BY STUDENT $studentid</h3>";
			  echo"<table border='1' style='width:100%;text-align:center;'>";
			  echo"<tr>";
			  echo"<td>0 subjects done</td>";
			  echo"</table>";
			  echo"</div>";
			  //end of subjects done
			 }
			 elseif($numberr > 0)
			 {
			 //start of partially or fully done subjects
			 $done="";
			 while($aja=mysql_fetch_array($ojei))
			 {
			     $subjeci=$aja['subject'];
				 foreach($subjexarray as $onebyone)
				 {
				     if($subjeci==$onebyone)
					 {
						 if($done=="")
						 {
						     $done=$onebyone;
						 }
						 else
						 {
						     $done=$done.",".$onebyone;
						 }
					 }
				 }
			 }
			 $donearray=explode(",",$done);
			 
			 //subjects not done
			 $notdonearray=array_diff($subjexarray,$donearray);
			 echo "<br/>";
			  echo"<br/><br/><br/><div style='width:100%;background-color:black;color:red;'>";
			  echo"<h3>SUBJECTS NOT DONE BY STUDENT $studentid</h3>";
			  echo"<table border='1' style='width:100%;'>";
			  echo"<tr>";
			  foreach($notdonearray as $notdone)
			  {
			     echo"<td>$notdone</td>";
			  }
			  echo"</tr>";
			  echo"</table>";
			  echo"</div>";
			 //end of subjects not done
			  
			  //subjects done
			 echo"<br/><br/><br/><div style='width:100%;background-color:blue;color:white;'>";
			  echo"<h3>SUBJECTS DONE BY STUDENT $studentid</h3>";
			  echo"<table border='1' style='width:100%;'>";
			  echo"<tr>";
			  foreach($donearray as $onebyone)
			  {
			     echo"<td> $onebyone </td>";
			  }
			  echo"</table>";
			  echo"</div>";
			  //end of subjects done
			 //end of partially or fully done subjects
			 }
		 }
		 elseif($howm==0)
		 {
		     echo"student $studentid has not selected subjects<br/><a href='examviewreports'>try again</a>";
		 }
		 //end junior students
	 }
	 //end of getting all subjects done by student
}
else
{
     echo"required variables not passed in<br/><a href='examviewreports'>Try Again</a>";
}
?>
</center>
</p>
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