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
		
	<link rel="stylesheet" href="themes/base/jquery.ui.all.css">
	<script src="jquery-1.10.2.js"></script>
	<script src="jquery.ui.core.js"></script>
	<script src="jquery.ui.widget.js"></script>
	<script src="jquery.ui.datepicker.js"></script>
	<script>
	$(function() {
		$( "#one" ).datepicker({dateFormat:'yy-mm-dd',changeMonth: true,changeYear: true}).val();
	});
	$(function() {
		$( "#two" ).datepicker({dateFormat:'yy-mm-dd',changeMonth: true,changeYear: true}).val();
	});
	</script>
		
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
							<li class="active selected"><a href="exambasicsettings">Basic Settings</a></li>
							<li><a href="exampromotestudent">Pro(De)mote Students</a></li>
							<li><a href="examviewreports">View Reports</a></li>
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
					<h2 style="font-size:1.7em;color:green;text-transform:uppercase;text-align:center;">select an option below</h2>
			<p>
            <center>
            <form action="" method="post">
            select an option:
            <select name="choice">
            <option>view streams</option>
            <option>view subjects</option>
            <option>view exams</option>
            <option>view grading system</option>
            <option>subject selection year</option>
            <option>lower class basic subjects</option>
			<option>set opening and closing dates</option>
			<option>set current term</option>
            </select>
            <input type="submit" value="perform action"/>
            </form>
            <hr />
            <?php
			error_reporting(E_ERROR);
			include("connection.php");
			$choice=$_POST['choice'];
			if($choice)
			{
				if($choice=="view streams")
				{
					//start of view streams
					streams();
					//end of view streams
				}
				elseif($choice=="view subjects")
				{
					//start of view subjects
					subject();
					//end of view subjects
				}
				elseif($choice=="view exams")
				{
					//start of view exams
					exams();
					//end of view exams
				}
				elseif($choice=="view grading system")
				{
					//start of view grades
					echo'
					<fieldset>
					<legend>You are currently viewing grading system</legend>';
					//internal code
					$stre=mysql_query("select * from gradingsystem order by subject DESC");
					$no=mysql_num_rows($stre);
					if($no > 0)
					{
						//code to view grades
						echo'
						<table border="1" style="width:100%;">
						<tr>
						<th>GRADE</th>
						<th>RANGE</th>
						<th>SUBJECT</th>
						<th>COMMENTS</th>
						<th></th>
						<th></th>
						</tr>
						';
					    while($eams=mysql_fetch_array($stre))
						{
							$grade=$eams['grade'];
							$range=$eams['rangee'];
							$subject=$eams['subject'];
							$comments=$eams['comments'];
							$id=$eams['gradingsystemid'];
							echo'<tr>';
							echo'<td>'.$grade.'</td>';
							echo'<td>'.$range.'</td>';
							echo'<td>'.$subject.'</td>';
							echo'<td>'.$comments.'</td>';
							echo'<form action="examgradeedit" method="post">';
							echo'<input type="hidden" value="'.$id.'" name="id"/>';
							echo'<td><input style="width:100%;background-color:green;color:white;" type="submit" value="edit"></td>';
							echo'</form>';
							echo'<form action="examgradedelete" method="post">';
							echo'<input type="hidden" value="'.$id.'" name="id"/>';
							echo'<td><input style="width:100%;background-color:red;color:white;" type="submit" value="delete"></td>';
							echo'</form>';
							echo'</tr>';
						}
						echo'</table><br/><br/>';
						echo'<form action="examgradeadd" method="post">';
						echo'<input style=";background-color:blue;color:white;" type="submit" value="add new grade"/>';
						echo'</form>';
						//end of code to view subjects
					}
					else
					{
						echo"there is no grading system in the database, please add grade and range<br/><br/>";
						echo'<form action="examgradeadd" method="post">';
						echo'<input style=";background-color:blue;color:white;" type="submit" value="add new grade"/>';
						echo'</form>';
					}
					//end of internal code
					echo'
					</fieldset>
					';
					//end of view grades
				}
				elseif($choice=="subject selection year")
				{
					//start of subject select class
					echo'
					<fieldset>
					<legend>You are currently viewing current subject-selection class</legend>';
					//internal code
					echo'<hr />';
					$selectt=mysql_query("select * from subjectchoiceclass");
					$mbus=mysql_fetch_array($selectt);
					$class=$mbus['class'];
					echo'<h2>The current subject-selection class is form: <font color="green">'.$class.'</font></h2>';
					echo'<hr />';
					echo'
					<form action="examupdatesubjectselectionclass" method="post">
					select school\'s subject-selection class:
					<select name="class">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					</select>
					<input style="background-color:purple;color:white;" type="submit" value="update subject-selection class" />
					</form>
					';
					//end of internal code
					echo'
					</fieldset>
					';
					//end of update subject choice class
				}
				elseif($choice=="lower class basic subjects")
				{
				    //start of basic subjects view
					echo'
					<fieldset>
					<legend>You are currently viewing lower basic subjects</legend>';
					//internal code
					basicsubject();
					//end of internal code
					echo'
					</fieldset>
					';
					//end of basic subjects view
				}
				elseif($choice=="set opening and closing dates")
				{
				     echo'
					 <fieldset>
					 <legend>Currently changing schoool opening and closing date</legend>
					 ';
					 $curre=mysql_query("select * from currentterm");
					 $nt=mysql_fetch_array($curre);
					 $openingd=$nt['openingdate'];
					 $closingd=$nt['closingdate'];
					 echo'<h3>CURRENT OPENING AND CLOSING DATE</h3>';
					 echo'Opening date: '.$openingd.'<br/>';
					 echo'Closing date: '.$closingd.'<br/>';
					 echo'
					 <br/>
					 <h3>EDIT OPENING AND CLOSING DATE BELOW</h3>
					 <form action="editdates" method="post">
					 opening date:<input id="one" type="text" name="openingdate" value="'.$openingd.'"/><br/><br/>
					 closing date:<input id="two" type="text" name="closingdate" value="'.$closingd.'"/><br/><br/>
					 <input type="submit" value="edit time"/>
					 </form>
					 </fieldset>
					 ';
				}
				elseif($choice=="set current term")
				{
				     echo'
					 <fieldset>
					 <legend>NOT ALLOWED TO CHANGE THE CURRENT TERM</legend>
					 You are not allowed to change the term in this packaged module, ask the finance manager to update the term for you 
					 in order for the financial records to be updated properly in case the term is inaccurately set.
					 </fieldset>
					 ';
				}
			}
			else
			{
				echo"
				<fieldset>
				<legend>Default Choice</legend>
				<p>
				No choice has been selected, please select a choice from above and perform action
				</p>
				</fieldset>
				";
			}
			
			
			//basic subject function
			function basicsubject()
			{
				$view=mysql_query("select * from studentbasicsubject");
				$all=mysql_fetch_array($view);
				$subjects=$all['subjects'];
				$yote=explode(",",$subjects);
				echo'
				<table border="1" style="width:100%;">
				<tr>
				<th>SUBJECT</th>
				</tr>
				';
				foreach($yote as $onebyone)
				{
					echo'
					<tr>
					<td>'.$onebyone.'</td>
					</tr>
					';
				}
				echo'
				</table>
				';
				echo'
				<form action="examupdatebasicsubjects" method="post">
				<input style="color:white;background-color:green;" type="submit" value="update basic subjects"/>
				</form>
				';
			}
			//end of basic subject function
			
			//start of function subject
			//start of view subjects
			function subject()
			{
					echo'
					<fieldset>
					<legend>You are currently viewing subjects</legend>';
					//internal code
					$stre=mysql_query("select * from subject");
					$no=mysql_num_rows($stre);
					if($no > 0)
					{
						//code to view grades
						echo'
						<table border="1" style="width:100%;">
						<tr>
						<th>SUBJECT NAME</th>
						<th>CATEGORY</th>
						<th></th>
						<th></th>
						</tr>
						';
					    while($eams=mysql_fetch_array($stre))
						{
							$grade=$eams['name'];
							$range=$eams['category'];
							$id=$eams['subjectid'];
							echo'<tr>';
							echo'<td>'.$grade.'</td>';
							echo'<td>'.$range.'</td>';
							echo'<form action="examsubjectedit" method="post">';
							echo'<input type="hidden" value="'.$id.'" name="id"/>';
							echo'<td><input style="width:100%;background-color:green;color:white;" type="submit" value="edit"></td>';
							echo'</form>';
							echo'<form action="examsubjectdelete" method="post">';
							echo'<input type="hidden" value="'.$id.'" name="id"/>';
							echo'<td><input style="width:100%;background-color:red;color:white;" type="submit" value="delete"></td>';
							echo'</form>';
							echo'</tr>';
						}
						echo'</table><br/><br/>';
						echo'<form action="examsubjectadd" method="post">';
						echo'<input style=";background-color:blue;color:white;" type="submit" value="add new subject"/>';
						echo'</form>';
						//end of code to view subjects
					}
					else
					{
						echo"there is no subject in the database, please add a new one<br/><br/>";
						echo'<form action="examgradeadd" method="post">';
						echo'<input style=";background-color:blue;color:white;" type="submit" value="add new subject"/>';
						echo'</form>';
					}
					//end of internal code
					echo'
					</fieldset>
					';
					}
			//end of function subject
			//start function streams
			function streams()
			{
			echo'
					<fieldset>
					<legend>You are currently viewing streams</legend>';
					//internal code
					$stre=mysql_query("select * from streams");
					$no=mysql_num_rows($stre);
					if($no > 0)
					{
						//code to view grades
						echo'
						<table border="1" style="width:100%;">
						<tr>
						<th>NAME</th>
						<th></th>
						<th></th>
						</tr>
						';
					    while($eams=mysql_fetch_array($stre))
						{
							$grade=$eams['name'];
							$id=$eams['streamsid'];
							echo'<tr>';
							echo'<td>'.$grade.'</td>';
							echo'<form action="examstreamedit" method="post">';
							echo'<input type="hidden" value="'.$id.'" name="id"/>';
							echo'<td><input style="width:100%;background-color:green;color:white;" type="submit" value="edit"></td>';
							echo'</form>';
							echo'<form action="examstreamdelete" method="post">';
							echo'<input type="hidden" value="'.$id.'" name="id"/>';
							echo'<td><input style="width:100%;background-color:red;color:white;" type="submit" value="delete"></td>';
							echo'</form>';
							echo'</tr>';
						}
						echo'</table><br/><br/>';
						echo'<form action="examstreamadd" method="post">';
						echo'<input style=";background-color:blue;color:white;" type="submit" value="add new stream"/>';
						echo'</form>';
						//end of code to view streams
					}
					else
					{
						echo"there is no stream in school, please add a new one if exists<br/><br/>";
						echo'<form action="examstreamadd" method="post">';
						echo'<input style=";background-color:blue;color:white;" type="submit" value="add new stream"/>';
						echo'</form>';
					}
					//end of internal code
					echo'
					</fieldset>
					';
			}
			//end function streams
			
			//start function exams
			function exams()
			{
			echo'
					<fieldset>
					<legend>You are currently viewing exams</legend>';
					//internal code
					$stre=mysql_query("select * from exams");
					$no=mysql_num_rows($stre);
					if($no > 0)
					{
						//code to view grades
						echo'
						<table border="1" style="width:100%;">
						<tr>
						<th>NAME</th>
						<th>CLASS</th>
						<th></th>
						<th></th>
						</tr>
						';
					    while($eams=mysql_fetch_array($stre))
						{
							$grade=$eams['name'];
							$class=$eams['class'];
							$id=$eams['examsid'];
							echo'<tr>';
							echo'<td>'.$grade.'</td>';
							echo'<td>'.$class.'</td>';
							echo'<form action="examedit" method="post">';
							echo'<input type="hidden" value="'.$id.'" name="id"/>';
							echo'<td><input style="width:100%;background-color:green;color:white;" type="submit" value="edit"></td>';
							echo'</form>';
							echo'<form action="examdelete" method="post">';
							echo'<input type="hidden" value="'.$id.'" name="id"/>';
							echo'<td><input style="width:100%;background-color:red;color:white;" type="submit" value="delete"></td>';
							echo'</form>';
							echo'</tr>';
						}
						echo'</table><br/><br/>';
						echo'<form action="examadd" method="post">';
						echo'<input style=";background-color:blue;color:white;" type="submit" value="add new exam"/>';
						echo'</form>';
						//end of code to view streams
					}
					else
					{
						echo"there is no exam found, please add a new one<br/><br/>";
						echo'<form action="examadd" method="post">';
						echo'<input style=";background-color:blue;color:white;" type="submit" value="add new exam"/>';
						echo'</form>';
					}
					//end of internal code
					echo'
					</fieldset>
					';
			}
			//end function exams
			?>
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