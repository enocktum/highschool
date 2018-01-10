<?php
ob_start();
session_start();
unset($_SESSION['industrylogin']);
header("location:index");
ob_flush();
?>