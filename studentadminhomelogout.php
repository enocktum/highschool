<?php
ob_start();
session_start();
unset($_SESSION['studentregistrationlogin']);
header("location:admissionhome");
ob_flush();
?>