<?php
$host_name="localhost";
$user_name="test";
$db_name="test";
$pass="test1234";

$conn=mysqli_connect($host_name,$user_name,$pass,$db_name);

if(mysqli_connect_error()){
    echo mysqli_connect_error();
    exit;
}
?>