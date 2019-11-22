<?php
error_reporting(E_ERROR);
// start of database query
include('connection.php');
$query=mysqli_query($con,"select * from studentdetails where status='1'");
while($b=mysqli_fetch_array($query))
{
	$a[]=$b['admissionnumber'];
	}
//end of getting data from database
//get the q parameter from URL
$q=$_GET["q"];

//lookup all hints from array if length of q>0
if (strlen($q) > 0)
  {
  $hint="";
  for($i=0; $i<count($a); $i++)
    {
    //if (strtolower($q)==strtolower(substr($a[$i],0,strlen($q))))
	  if ($q==substr($a[$i],0,strlen($q)))
      {
      if ($hint=="")
        {
        $hint=$a[$i];
        }
      else
        {
        $hint=$hint." , ".$a[$i];
        }
      }
    }
  }

// Set output to "no suggestion" if no hint were found
// or to the correct values
if ($hint == "")
  {
  $response="<font color='red'>ADM. NO not found, check CAPSLOCK</font>";
  }
else
  {
  $response="<font color='green'>".$hint."</font>";
  }

//output the response
echo $response;
?>