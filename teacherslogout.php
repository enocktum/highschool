<?php
ob_start();
session_start();
unset($_SESSION['teacherlogin']);
header("location:index");
ob_flush();
?>