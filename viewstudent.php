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
		
		<script type="text/javascript">
function showHint(str)
{
if (str.length==0)
  { 
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","grade?q="+str,true);
xmlhttp.send();
}
</script>

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
            <form action="" method="post">
            <h3>choose an option in students menu:
            <select name="choice" style="width:50%;">
            <option>change status</option>
			<option>search student</option>
            <option>boarding status</option>
			<option>subject selection</option>
			<option>retire graduating students</option>
            </select>&nbsp;&nbsp;&nbsp;&nbsp;
            <input  type="submit" value="apply choice"/>
            </form>
            </h3><br/><br/>
            <?php
			error_reporting(E_ERROR);
			include("connection.php");
			$choice=$_POST['choice'];
			if($choice)
			{
				if($choice=="change status")
				{
					$check=mysql_query("select * from studentdetails where status='1'");
			          echo"<table border='1'  style='width:100%;'>";
			          echo"<tr>";
			          echo"<th>name</th>";
			          echo"<th>admission number</th>";
			          echo"<th>current status</th>";
					  echo"<th></th>";
			          echo"</tr>";
		              while($data=mysql_fetch_array($check))
			         {
				      echo"<tr>";
				      echo"<td>".$data['firstname']." ".$data['lastname']." ".$data['middlename']."</td>";
				      echo"<td>".$data['admissionnumber']."</td>";
					  $status=$data['status'];
					  if($status=="1")
					  {
						  $currentstatus="<font color='#009933'>Ongoing Student</font>";
						  $submt="<input type='submit' value='discontinue' style='width:100%;background-color:purple;color:white;'/>";
					  }
					  elseif($status=="2")
					  {
						  $currentstatus="<font color='#330066'>Discontinued Student</font>";
						  $submt="<input type='submit' value='Restore' style='width:100%;background-color:green;color:white;'/>";
					  }
					  elseif($status=="3")
					  {
						  $currentstatus="<font color='#330066'>Graduated Student</font>";
						  $submt="<input type='submit' value='Undo Retire' style='width:100%;background-color:brown;color:white;'/>";
					  }
				      echo"<td>".$currentstatus."</td>";
					  echo'
					  <form action="admissionchangestatus" method="post">
					  <input type="hidden" value="'.$data["admissionnumber"].'" name="admissionnumber"/>
					  <input type="hidden" value="'.$data["status"].'" name="status"/>
					  <td>'.$submt.'</td>
					  </form>
					  ';
				      echo"</tr>";
			          }
			          echo"</table><br/><br/>";
			    }
				elseif($choice=="search student")
			    {
					echo'
					<form action="admissionsearchstudent" method="post">
					<span id="txtHint"></span><Br/>
					student id:<input type="text" id="txt1" onKeyUp="showHint(this.value)" name="studentid" placeholder="student admission number" size="30"/>
					<input type="submit" value="search student"/>
					</form>
					';
			    }
				elseif($choice=="boarding status")
			    {
					  $check=mysql_query("select * from studentdetails where status='1'");
			          echo"<table border='1'  style='width:100%;'>";
			          echo"<tr>";
			          echo"<th>name</th>";
			          echo"<th>admission number</th>";
			          echo"<th>boarding status</th>";
					  echo"<th></th>";
			          echo"</tr>";
		              while($data=mysql_fetch_array($check))
			         {
				      echo"<tr>";
				      echo"<td>".$data['firstname']." ".$data['lastname']." ".$data['middlename']."</td>";
				      echo"<td>".$data['admissionnumber']."</td>";
					  $status=$data['boardingstatus'];
					  if($status=="oncampus")
					  {
						  $currentstatus="<font color='blue'>Boarding Student</font>";
						  $submt="<input type='submit' value='Make Offcampus' style='width:100%;background-color:purple;color:white;'/>";
					  }
					  elseif($status=="offcampus")
					  {
						  $currentstatus="<font color='purple'>Day Scholar</font>";
						  $submt="<input type='submit' value='Make Oncampus' style='width:100%;background-color:blue;color:white;'/>";
					  }
				      echo"<td>".$currentstatus."</td>";
					  echo'
					  <form action="admissionchangeboardingstatus" method="post">
					  <input type="hidden" value="'.$data["admissionnumber"].'" name="admissionnumber"/>
					  <input type="hidden" value="'.$data["boardingstatus"].'" name="boardingstatus"/>
					  <td>'.$submt.'</td>
					  </form>
					  ';
				      echo"</tr>";
			          }
			          echo"</table><br/><br/>";
				}
				elseif($choice=="subject selection")
			    {
				    echo'
					<form action="studentsubjectselect" method="post">
					<fieldset>
					<legend>basic detail</legend>
				    student id:<input type="text" value="" placeholder="student admission number" name="studentid" style="width:50%;text-align:center;"/><br/>
					</fieldset>
					<fieldset>
					<legend>COMPULSORY SUBJECTS</legend> 
					<input type="checkbox" value="english" name="english" checked="checked"/>english &nbsp;&nbsp;&nbsp;
					<input type="checkbox" value="kiswahili" name="kiswahili" checked="checked"/>kiswahili &nbsp;&nbsp;&nbsp;
					<input type="checkbox" value="mathematics" name="mathematics" checked="checked"/>mathematics &nbsp;&nbsp;&nbsp;
					</fieldset>
					<fieldset>
					<legend>HUMANITIES(choose 2 or 1)</legend> 
					<input type="checkbox" value="geography" name="geography"/>geography &nbsp;&nbsp;&nbsp;
					<input type="checkbox" value="history and government" name="historyandgovernment"/>history and government&nbsp;&nbsp;&nbsp;
					<input type="checkbox" value="christian religious education" name="cre"/>christian religious education &nbsp;&nbsp;&nbsp;
					</fieldset>
					<fieldset>
					<legend>APPLIED(choose 1)</legend> 
					<input type="checkbox" value="agriculture" name="agriculture"/>agriculture &nbsp;&nbsp;&nbsp;
					<input type="checkbox" value="business studies" name="businessstudies"/>business studies&nbsp;&nbsp;&nbsp;
					</fieldset>
					<fieldset>
					<legend>SCIENCES(chemistry compulsory,Choose all, or between physics and biology)</legend> 
					<input type="checkbox" value="chemistry" name="chemistry" checked="checked"/>chemistry &nbsp;&nbsp;&nbsp;
					<input type="checkbox" value="biology" name="biology"/>biology&nbsp;&nbsp;&nbsp;
					<input type="checkbox" value="physics" name="physics"/>physics &nbsp;&nbsp;&nbsp;
					</fieldset><br/>
					<input type="submit" value="Submit Selected Subjects"/>
					</form><br/><br/>
					';
				}
				elseif($choice=="retire graduating students")
				{
				     include"connection.php";
					 $pery=mysql_query("select * from studentdetails where currentclass='4' && status='1'");
					 $no=mysql_num_rows($pery);
					 if($no!=0)
					 {
					    $yote=array();
					     //start of changing status of selected students
						 echo"<form action='retirestudent' method='post'>";
						 echo'
						 <table border="0" style="width:100%;text-align:left;"/>
						 <tr>
						 <th>NAME</th>
						 <th>ADMISSION NUMBER</th>
						 <th>CURRENT FORM</th>
						 <th>RETIRE?</th>
						 </tr>
						 ';
						 while($yeah=mysql_fetch_array($pery))
						 {
						     $username=$yeah['admissionnumber'];
							 $yote[$username]=$username;
							 echo'
							 <tr>
							 <td>'.$yeah['firstname']." ".$yeah['middlename']." ".$yeah['lastname'].'</td>
							 <td>'.$username.'</td>
							 <td>'.$yeah['currentclass'].'</td>
							 <td><input type="checkbox" name="'.$username.'" checked="checked" value="'.$username.'"/></td>
							 </tr>
							 ';
						 }
						 $string='';
						 foreach($yote as $onebyone)
						 {
						     if($string=='')
							 {
							     $string=$onebyone;
							 }
							 else
							 {
							     $string=$string.",".$onebyone;
							 }
						 }
						 echo"
						 </table>
						 <input type='hidden' name='string' value='".$string."'/>
						 <br/><input type='submit' value='retire selected student(s)' />
						 </form><br/><br/>
						 
						 ";
						 
					     //end of changing status of selected students
					 }
					 else
					 {
					     echo"there are no students who are in form four currently, update the student classes in the exams module<br/><br/>";
					 }
				}
			}
			else
			{
			$check=mysql_query("select * from studentdetails where status='1'");
			$no=mysql_num_rows($check);
			if($no>0)
			{
			echo"<table border='1' style='width:100%;'>";
			echo"<tr>";
			echo"<th>name</th>";
			echo"<th>admission number</th>";
			echo"<th>student password</th>";
			echo"<th>Parent Phonenumber</th>";
			echo"<th>parent name</th>";
			echo"<th>current class</th>";
			echo"</tr>";
			while($data=mysql_fetch_array($check))
			{
				echo"<tr>";
				echo"<td>".$data['firstname']." ".$data['middlename']." ".$data['lastname']."</td>";
				echo"<td>".$data['admissionnumber']."</td>";
				echo"<td>".$data['password']."</td>";
				echo"<td>".$data['parentphonenumber']."</td>";
				echo"<td>".$data['parentname']."</td>";
				echo"<td>".$data['currentclass']."</td>";
				echo"</tr>";
			}
			echo"</table><br/><br/>";
			}
			else
			{
				echo"There are no continuing students in the school database<br/><br/>";
			}
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
