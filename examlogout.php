<?php
ob_start();
session_start();
unset($_SESSION['examsetup']);
header("location:boardadmission");
ob_flush();
?>