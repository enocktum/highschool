<?php
$host="localhost";
$user="root";
$pass="nockstar92";
$db="highschool";
$con=mysql_connect($host,$user,$pass);
if($con)
{
$database=mysql_select_db($db);
if($database)
{

}
else
{
echo"database not found";
}
}
else
{
echo"Server not found";
}
?>