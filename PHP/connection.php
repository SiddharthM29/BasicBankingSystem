<?php
$server="localhost";
$username="root";
$password="sidhu@2904";
$db="tsf_bank";
$con=mysqli_connect($server,$username,$password,$db);
if(!$con)
{
    die("connection unsuccessfull due to ".mysqli_conncect_error());
}
?>