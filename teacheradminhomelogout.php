<?php
ob_start();
session_start();
unset($_SESSION['teacherregistrationlogin']);
header("location:admissionhome");
ob_flush();
?>