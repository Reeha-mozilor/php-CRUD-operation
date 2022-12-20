<?php
session_start();
require 'dbcon.php';

$id=$_SESSION["user_id"];

$sql="select * from users where id=$id";
$result=mysqli_query($conn,$sql);


if(mysqli_num_rows($result)===1){

    $row=mysqli_fetch_assoc($result);
}