<?php

if (isset($_GET['id'])) {
    $id=$_GET['id'];
    
require 'dbcon.php';
$sql="select * from users where id=$id";
$result=mysqli_query($conn,$sql);


if(mysqli_num_rows($result)===1){

    $row=mysqli_fetch_assoc($result);
    echo json_encode($row);
}
}