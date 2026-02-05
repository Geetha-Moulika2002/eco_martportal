<?php
$con = mysqli_connect("localhost","root","","eco_martportal");
if(!$con){
    die("Database connection failed");
}
session_start();
?>
