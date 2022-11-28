<?php
$con = new mysqli("localhost","admin","admin1234","user_management_php");

if(!$con){
    die(mysqli_error($con));
}
?>