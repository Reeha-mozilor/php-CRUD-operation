<?php
require 'dbcon.php';

if(!empty($_POST["uname"])){
    $sql="Select * from users where user='" . $_POST["uname"] . "'";
    $stmt = mysqli_query($conn, $sql);
    $count=mysqli_num_rows($stmt);
    
    if($count>0){
        echo "<span style='color:red'> Sorry User already exists </span>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
       }
    else{
        echo "<span style='color:green'> User available for Registration </span>";
        echo "<script>$('#submit').prop('disabled',false);</script>";
  }
    
}


?>