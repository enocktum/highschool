<?php
ob_start();
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
							FINANCE SCREEN
							</a>
						<ul class="submenu visible">
							<li><a href="industryhome">Finance Home</a></li>
							<li><a href="industryfinancialstatement">Financial Statement</a></li>
							<li class="active selected"><a href="industryaddfees">Add Fees</a></li>
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
					<h2 style="font-size:1.7em;color:green;text-transform:uppercase;text-align:center;">Finance Add Student Fees Progress</h2>
			<p>
			<?php
            error_reporting(E_ERROR);
			include("connection.php");
			$studentid=$_POST['studentid'];
			$amountpaid=$_POST['amountpaid'];
			$datepaid=date("Y-m-d");
			$paymenttype=$_POST['paymenttype'];
			if($studentid && $amountpaid && $datepaid && $paymenttype)
			{
			//start of calculating fees payable and term
			$serry=mysql_query("select * from currentcharges where studentid='$studentid' and status='1'");
			$no=mysql_num_rows($serry);
			if($no>0)
			{
			$erry=mysql_fetch_array($serry);
			//getting term
			$jung=mysql_query("select * from currentterm");
			$nguj=mysql_fetch_array($jung);
			$term=$nguj['term'];
			//end of term
			$balance=$erry['balance'];
			$feespayable=$balance-$amountpaid;
			//reciept no
			$ng=mt_rand(1000,10000);
            $gn=mt_rand(100,1000);
			$recieptno=$studentid . "_".$ng."/".$gn;//receipt no
			//end of receipt no
			//purpose
			$purpose="fees";
			//end of purpose
			//start from
			$from=$studentid;//from
			//end from
			
			//payment type
			if($paymenttype=="bank slip" || $paymenttype=="cheque" || $paymenttype=="money order")
			{
			     $cash=0;
				 $bank=$amountpaid;
				 $total=$cash + $bank;
			}
			else
			{
			     $bank=0;
			     $cash=$amountpaid;
			     $total=$cash + $bank;
			}
			
			//end payment type
			
			//end of calculating fees payable
			//start of checking student status
			if($feespayable<0)
			{
			$studentstatus="Fully Paid, excess carried forward";
			}
			elseif($feespayable>0)
			{
			$studentstatus="Partially Paid";
			}
			elseif($feespayable==0)
			{
			$studentstatus="Fully Paid";
			}
			else
			{
			$studentstatus="Unpaid or Unconfirmed";
			}
			//end of checking student status
			
			//start setting balance == fees payable in currentcharges
			$shery=mysql_query("select * from currentcharges where studentid='$studentid' && status='1'");
			$pery=mysql_num_rows($shery);
			if($pery>0)
			{
			$terry=mysql_query("update currentcharges set balance='$feespayable' where studentid='$studentid' && status='1'");
			if($terry)
			{
			if($studentid && $amountpaid)
			{
			//START INSERTING DATA TO DATABASE
			$query=mysql_query("insert into financestatement (feespaid,term,studentid,datedeposited,studentstatus,feespayable) values ('$amountpaid','$term','$studentid','$datepaid','$studentstatus','$feespayable')");
			if($query)
			{
				//start of updating total amount
				$que=mysql_query("select * from total");
				$datsa=mysql_fetch_array($que);
				$justamount=$datsa['amount'];
				$newtotalamount=$amountpaid + $justamount;
				$updatetotal=mysql_query("update total set amount='$newtotalamount'");
				if($updatetotal)
				{
					echo"financial statement for <font color='green'>".$studentid."</font> has been successfully added and updated<br/><a href='industryaddfees'>add next</a>&nbsp;&nbsp;<a href='industryhome'>Am Done</a><br/><br/>";
					
					
					//start of new code
            //start of looping voteheads with while loop
			$remaining=$amountpaid;
			$board=mysql_query("select * from studentdetails where admissionnumber='$studentid'");
			$ing=mysql_fetch_array($board);
			$boarding=$ing['boardingstatus'];
			$vote=mysql_query("select * from voteheads where termit='$term' && boardingstatus='$boarding'");
			$counter=0;
	        while($head = mysql_fetch_array($vote))
	       {
			   $votehead=$head['name'];
			   $voteamount=$head['amount'];
			   if($voteamount < $remaining)
			   {
				   $remaining=$remaining-$voteamount;
				   $voteheads[$counter]=$votehead;
			   }
			   elseif($voteamount == $remaining)
			   {
				     $remaining=$remaining-$remaining;
					 $voteheads[$counter]=$votehead;
					 break;
			   }
			   elseif($voteamount > $remaining)
			   {
				   $remaining=$remaining;
				   break;
			   }
			   
           $counter++;
		   }
			//end of looping voteheads with while loop
			echo "<hr />";
			foreach($voteheads as $areas)
			{
				if($votee != "")
				{
					$votee=$votee.",".$areas;
				}
				else
				{
					$votee=$areas;
				}
			 }
			echo"<hr/>";
			if($votee != "")
			{
			$ingiza=mysql_query("insert into cashbook (date,origin,recieptno,cash,bank,total,term,votehead) values ('$datepaid','$from','$recieptno','$cash','$bank','$total','$term','$votee')");
			if($ingiza)
			{
				echo"The following voteheads have been updated:<br/> <u><font color='#009933'>".$votee."</font></u><br/>";
			}
			else
			{
				echo"<font color='#990033'>value not added to cash book for votehead</font>.<br/>Contact technician for rectification<br/>";
			}
			}
			else
			{
				echo"voteheads addition not possible due to minimal fees payment";
			}
					//end of new code
					
					
			//start of printing code
				echo"<br/><form action='studentreceiptprint' method='post'>";
				echo"<input type='hidden' value='$from' name='from'/>";
				echo"<input type='hidden' value='$studentid' name='studentid'/>";
				echo"<input type='hidden' value='$feespayable' name='balance'/>";
				echo"<input type='hidden' value='$studentstatus' name='status'/>";
				echo"<input type='hidden' value='$amountpaid' name='amount'/>";
				echo"<input type='hidden' value='$recieptno' name='recieptno'/>";
				echo"<input type='hidden' value='$votee' name='voteheads'/>";
				echo"<input type='hidden' value='$remaining' name='remaining'/>";
				echo"<input type='hidden' value='$term' name='term'/>";
				echo"<input type='hidden' value='$balance' name='initial'/>";
				echo"<input type='hidden' value='$boarding' name='boarding'/>";
				echo"<input style='background-color:green;color:white;border:solid cream 2px;' type='submit' value='print reciept'/>";
				echo"</form>";
				//end of printing code
				}
				else
				{
					echo"amount not added to the total amount<br/>Contact technician for rectification";
				}
				//end of udpating total amount
			}
			else
			{
			echo"Grades not successfully assigned to ".$studentid."<br/><a href='industryaddfees'>Try Again</a>";
			}
			//END OF INSERTING DATA TO DATABASE
			}
			else
			{
			echo"<a href='industryaddfees'>fill all the fields</a>";
			}
			}
			else
			{
			echo"updating current charges of student ".$studentid." failed<br/><a href='industryaddfees'>Try Again</a>";
			}
			}
			else
			{
			echo"no such id exists <br/><a href='industryaddfees'>Try Again</a>";
			}
			//end setting balance == fees payable in currentcharges
			}
			else
			{
				echo"The student you are trying to add fees for is not registered or is currently discontinued either due to suspension, expalsion or graduation. Send the student to admissions officer to be continued momentarily for his/her financial account to be activated.";
			}
			
			}
			else
			{
			     echo"necessary variables such as student id, amount, payment type e.tc not passed through <br/><a href='industryaddfees'>Try Again</a>";
			}
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