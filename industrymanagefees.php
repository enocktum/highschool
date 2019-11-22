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
							<li><a href="industryfinancialstatement">Financial Statement</a></li>
							<li><a href="industryaddfees">Add Fees</a></li>
							<li class="active selected"><a href="industrymanagefees">Manage Fees</a></li>
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
					<h2 style="font-size:1.7em;color:green;text-transform:uppercase;text-align:center;">Finance Manage fees</h2>
			<p align="center">
            <center>
            <form action="" method="post">
            Choose an option in the drop down:
            <select name="choice">
            <option>account withdrawal</option>
            <option>view grand total</option>
            <option>view cashbook</option>
            <option>view withdrawals</option>
            <option>voteheads</option>
            </select><br/><br/>
            <input type="submit" value="perform action"  />
            </form><br /><br />
            <fieldset style="">
            <legend>Results</legend>
            <?php
			error_reporting(E_ERROR);
			$choice=$_POST['choice'];
			if($choice)
			{
				if($choice=="account withdrawal")
				{
					//make payments
					accountwithdrawal();
					//end of make payments
				}
				elseif($choice=="view cashbook")
				{
					//view cashbook
					viewcashbook();
					//end of viewing cashbook
				}
				elseif($choice=="view withdrawals")
				{
					//view ledger
					viewwithdrawals();
					//end of ledger viewing
				}
				elseif($choice=="view grand total")
				{
					//grand total
					viewgrandtotal();
					//end of grand total
				}
				elseif($choice=="voteheads")
				{
					//voteheads
					voteheads();
					//end of voteheads
				}
			}
			else
			{
				echo"no choice selected,please make a choice above";
			}
			function accountwithdrawal()
			{
				//start of making payments
				echo"<h3>You are withdrawing from main account</h3>";
				echo"<br/><hr/>";
				echo"<form action='industrynemurabinik' method='post' style=''>";
				echo"Given to:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='nameofperson' placeholder='enter name of person assigned' size='32' required='required'/><br/><br/>";
				echo"enter amount<input type='text' name='amount' placeholder='enter amount to withdraw' size='32' required='required'/><br/><br/>";
				
				$vote=mysqli_query($con,"select * from voteheads where termit='one'");
				echo"amount use: <select name='votehead' style='width:39%;'>";
				while($head=mysqli_fetch_array($vote))
				{
					echo"<option>".$head['name']."</option>";
				}
				echo"<option>other</option>";
				echo"</select><br/><br/>";
				echo"<input type='submit' value='withdraw cash'/>";
				echo"</form>";
				//end of making payments
			}
			function viewcashbook()
			{
				//start viewing cashbook
				echo"<h2>School Cash Book</h2>";
				$cash=mysqli_query($con,"select * from cashbook");
				$nu=mysqli_num_rows($cash);
				if($nu > 0)
				{
					echo"<table border='1' style='width:100%;'>";
					echo"<tr>";
					echo"<th>DATE</th>";
					echo"<th>FROM</th>";
					echo"<th>RECEIPT_NO</th>";
					echo"<th>CASH</th>";
					echo"<th>BANK</th>";
					echo"<th>TOTAL</th>";
					echo"<th>VOTEHEAD</th>";
					echo"</tr>";
					while($book=mysqli_fetch_array($cash))
					{
						echo"<tr>";
						$id=$book['origin'];
						$student=mysqli_query($con,"select * from studentdetails where admissionnumber='$id'");
						$identity=mysqli_fetch_array($student);
						$name=$identity['firstname']." ".$identity['middlename']." ".$identity['lastname'];
						echo"<td>".$book['date']."</td>";
						echo"<td style='text-transform:uppercase;'>".$name."</td>";
						echo"<td>".$book['recieptno']."</td>";
						echo"<td>".$book['cash']."</td>";
						echo"<td>".$book['bank']."</td>";
						echo"<td>".$book['total']."</td>";
						echo"<td>".$book['votehead']."</td>";
						echo"</tr>";
					}
					echo"</table>";
				}
				else
				{
					echo"No records have been recorded in the cashbook";
				}
				//end of viewing cashbook
			}
			function viewwithdrawals()
			{
				//viewing withdrawals
				echo"<h2>School Withdrawals</h2>";
				$cash=mysqli_query($con,"select * from paymentbook");
				$nu=mysqli_num_rows($cash);
				if($nu > 0)
				{
					echo"<table border='1' style='width:100%;'>";
					echo"<tr>";
					echo"<th>DATE</th>";
					echo"<th>PAID TO</th>";
					echo"<th>PAYMENT_NO</th>";
					echo"<th>AMOUNT</th>";
					echo"<th>PURPOSE</th>";
					echo"<th>TERM</th>";
					echo"</tr>";
					while($book=mysqli_fetch_array($cash))
					{
						echo"<tr>";
						echo"<td>".$book['date']."</td>";
						echo"<td>".$book['personresponsible']."</td>";
						echo"<td>".$book['paymentno']."</td>";
						echo"<td>".$book['amount']."</td>";
						echo"<td>".$book['votehead']."</td>";
						echo"<td>".$book['term']."</td>";
						echo"</tr>";
					}
					echo"</table>";
				}
				else
				{
					echo"No records have been recorded in the payment record";
				}
				//end of viewing withdrawals
			}
			function viewgrandtotal()
			{
				//viewing grand total	
				$grand=mysqli_query($con,"select * from total");
				$total=mysqli_fetch_array($grand);
				$grandtotal=$total['amount'];
				echo"<h2>The total amount in the school account is <u><b>kshs.".$grandtotal."</u></b></h2>";
				//end of viewing grand total
			}
			function voteheads()
			{
				//start voteheads
				echo '
				<h3>VOTEHEAD OPTIONS</h3>
				<br/>
				<fieldset>
				<legend>fill all the fields</legend>
				<form action="industryvoteheadpage" method="post"><br/><br/>
				choose boarding status:
				<select name="boardingstatus">
				<option>oncampus</option>
				<option>offcampus</option>
				</select><br/><br/>
				select option:
				<select name="option">
				<option>view voteheads</option>
				<option>add voteheads</option>
				</select><br/><br/>
				select term:
				<select name="term">
				<option>one</option>
				<option>two</option>
				<option>three</option>
				</select><br/><br/>
				<input type="submit" value="Perform Action"/><br/>
				</form>
				</fieldset>
				';
				//end voteheads
			}
			?>
            </fieldset>
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