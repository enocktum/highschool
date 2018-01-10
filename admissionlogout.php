<?php
ob_start();
session_start();
if(isset($_SESSION['admissionlogin']))
{
	unset($_SESSION['admissionlogin']);
	header("location:index");
}
else
{
	echo"you are already logged out";
	header("location:index");
}
ob_flush();
?>