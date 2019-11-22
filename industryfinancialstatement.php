<?php
ob_start();
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
session_start();
if(!isset($_SESSION['industrylogin']))
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
							FINANCE SCREEN
							</a>
						<ul class="submenu visible">
							<li><a href="industryhome">Finance Home</a></li>
							<li class="active selected"><a href="industryfinancialstatement">Financial Statement</a></li>
							<li><a href="industryaddfees">Add Fees</a></li>
							<li><a href="industrymanagefees">Manage Fees</a></li>
							<li><a href="industrystartterm">Start Term(Update Fees)</a></li>
							<li><a href="industrylogout">Logout</a></li>
						</ul>
					</li>
					<li>
						<a href="">
							<i class="fa fa-desktop icon-sidebar"></i>
							<i class="fa fa-angle-right chevron-icon-sidebar"></i>
							SYSTEM EXTRAS
							</a>
						<ul class="submenu visible">
							<li><a href="systemhelp">System Help</a></li>
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
            Choose an option and submit: <select name="choice">
            <option>cleared students</option>
            <option>uncleared students</option>
            <option>search student</option>
            </select>
            &nbsp;&nbsp;&nbsp;<input type="submit" value="Submit Action"/>
            </form><br/>
            <hr/>
            </center>
			<p>
            <center>
              <?php
			     error_reporting(E_ERROR);
				 $choice=$_POST['choice'];
				 if($choice)
				 {
					 if($choice=="cleared students")
					 {
						 //start of cleared students
						 echo"<h1>CLEARED STUDENTS FINANCIALLY</h1><br/>";
						 //start of printing cleared students
				echo'
				<form action="industryclearedstudentsprint" method="post">
				select the class or form: <select name="class">
				<option>all</option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="formstatus" value="cleared"/>
				<input type="submit" value="print cleared students"/>
				</form><br/><Br/><br/>
				';
				//end of printing cleared students
				include("connection.php");
				$query=mysqli_query($con,"select * from currentcharges where status='1' ORDER BY studentid");
				$no=mysqli_num_rows($query);
				if($no > 0)
				{
				echo"<table border='0' style='width:100%;text-align:left;'>";
				echo"<tr>";
				echo"<th><b>STUDENT_NAME</b></th>";
				echo"<th><b>STUDENT_ID</b></th>";
				echo"<th><b>CARRY FORWARD</b></th>";
				echo"<th><b>TERM</b></u></th>";
				echo"<th><b>DATE</b></u></th>";
				echo"<th><b>BOARDING_STATUS</b></u></th>";
				echo"</tr>";
				while($data=mysqli_fetch_array($query))
				{
				$balance=$data['balance'];
				if($balance<1)
				{
				$studentid=$data['studentid'];
				$student=mysqli_query($con,"select * from studentdetails where admissionnumber='$studentid'");
				$nam=mysqli_fetch_array($student);
				$bal=$balance * -1;
				$checkstat=$nam['status'];
				if($checkstat=="1")
				{
				echo"<tr>";
				$name=$nam['firstname']." ".$nam['middlename']." ".$nam['lastname'];
				$boarding=$nam['boardingstatus'];
				echo"<td style='text-transform:uppercase;'>".$name."</td>";
				echo"<td>".$data['studentid']."</td>";
				echo"<td>".$bal."</td>";
				echo"<td><font color='brown'>".$data['term']."</font></td>";
				echo"<td><font color='red'>".date("Y-m-d")."</font></td>";
				echo"<td>".$boarding."</td>";
				echo"</tr>";
				}
				}
				}
				echo"</table>";
				}
				else
				{
					echo"Financial statement are not available for now. This may be due to 0 students in the school or all students have been discontinued";
				}
				
						 //end of cleared students
					 }
					 if($choice=="uncleared students")
					 {
						 //start of uncleared students
						 echo"<h1>UNCLEARED STUDENTS FINANCIALLY</h1><br/>";
						  //start of printing uncleared students
				echo'
				<form action="industryclearedstudentsprint" method="post">
				select the class or form: <select name="class">
				<option>all</option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="formstatus" value="uncleared"/>
				<input type="submit" value="print uncleared students"/>
				</form><br/><Br/><br/>
				';
				//end of printing uncleared students
						 include("connection.php");
				$query=mysqli_query($con,"select * from currentcharges where status='1' ORDER BY studentid");
				$no=mysqli_num_rows($query);
				if($no > 0)
				{
				echo"<table border='0' style='width:100%;text-align:left;'>";
				echo"<tr>";
				echo"<th><b>STUDENT_NAME</b></th>";
				echo"<th><b>STUDENT_ID</b></th>";
				echo"<th><b><font color='brown'>BALANCE</font></b></th>";
				echo"<th><b>TERM</b></u></th>";
				echo"<th><b>DATE</b></u></th>";
				echo"<th><b>BOARDING_STATUS</b></u></th>";
				echo"</tr>";
				while($data=mysqli_fetch_array($query))
				{
				$balance=$data['balance'];
				if($balance>0)
				{
				
				$studentid=$data['studentid'];
				$student=mysqli_query($con,"select * from studentdetails where admissionnumber='$studentid'");
				$nam=mysqli_fetch_array($student);
				$checkstat=$nam['status'];
				if($checkstat=="1")
				{
				echo"<tr>";
				$name=$nam['firstname']." ".$nam['middlename']." ".$nam['lastname'];
				$boarding=$nam['boardingstatus'];
				echo"<td style='text-transform:uppercase;'>".$name."</td>";
				echo"<td>".$data['studentid']."</td>";
				echo"<td>".$data['balance']."</td>";
				echo"<td><font color='brown'>".$data['term']."</font></td>";
				echo"<td><font color='red'>".date("Y-m-d")."</font></td>";
				echo"<td>".$boarding."</td>";
				echo"</tr>";
				}
				}
				}
				echo"</table>";
				}
				else
				{
					echo"Financial statement are not available for now. This may be due to 0 students in the school or all students have been discontinued";
				}
						 //end of uncleared students
					 }
					 if($choice=="search student")
					 {
						 //you are searching a student
						 echo'
						 <h1>STUDENT FINANCIAL STATEMENT SEARCH</h1><br/>
						 <form action="industrysearchfinance" method="post">
						 <span id="txtHint"></span><br/>
						 enter student admission number:
						 <input type="text" name="admissionnumber" id="txt1" onKeyUp="showHint(this.value)" placeholder="enter admission number" size="40"/>
						 &nbsp;&nbsp;&nbsp;&nbsp;
						 <input type="submit" value="Search Statement" />
						 </form>
						 ';
						 //end of searching a student
					 }
				 }
				 else
				 {
					 echo"<h1>ALL CURRENT STUDENTS FINANCIAL STATEMENT</h1><br/>";
					 //start of printing all students
					 echo'
				<form action="industryclearedstudentsprint" method="post">
				select the class or form: <select name="class">
				<option>all</option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="formstatus" value="allstudents"/>
				<input type="submit" value="print all students"/>
				</form><br/><Br/><br/>
				';
				//end of printing all students
			    include("connection.php");
				$query=mysqli_query($con,"select * from currentcharges where status='1' ORDER BY studentid");
				$no=mysqli_num_rows($query);
				if($no > 0)
				{
				echo"<table border='0' style='width:100%;text-align:left;'>";
				echo"<tr>";
				echo"<th><b>STUDENT_NAME</b></th>";
				echo"<th><b>STUDENT_ID</b></th>";
				echo"<th><b>BALANCE</b></th>";
				echo"<th><b>TERM</b></u></th>";
				echo"<th><b>DATE</b></u></th>";
				echo"<th><b>BOARDING_STATUS</b></u></th>";
				//echo"<th><b>EDIT AMOUNT</b></u></th>";
				echo"</tr>";
				while($data=mysqli_fetch_array($query))
				{
				$studentid=$data['studentid'];
				$student=mysqli_query($con,"select * from studentdetails where admissionnumber='$studentid'");
				$nam=mysqli_fetch_array($student);
				$checkstat=$nam['status'];
				if($checkstat=="1")
				{
				$balance=$data['balance'];
				if($balance < 0)
				{
					$balance=$balance * -1;
					$balue=$balance."(carried forward)";
				}
				else if($balance > 0)
				{
					$balue=$balance;
				}
				else if($balance == 0)
				{
					$balue=$balance;
				}
				echo"<tr>";
				$name=$nam['firstname']." ".$nam['middlename']." ".$nam['lastname'];
				echo"<td style='text-transform:uppercase;'>".$name."</td>";
				$boarding=$nam['boardingstatus'];
				echo"<td>".$data['studentid']."</td>";
				echo"<td>".$balue."</td>";
				echo"<td>".$data['term']."</td>";
				echo"<td>".date("Y-m-d")."</td>";
				echo"<td>".$boarding."</td>";
				//echo'
				//<form action="industryamountedit" method="post">
				//<input type="hidden" name="studentid" value="'.$studentid.'"/>
				//<td><input style="background-color:green;color:white;width:100%;" type="submit" value="edit '.$studentid.'"/></td>
				//</form>
				//';
				echo"</tr>";
				}
				}
				echo"</table>";
				}
				else
				{
					echo"Financial statement are not available for now. This may be due to 0 students in the school or all students have been discontinued";
				}
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