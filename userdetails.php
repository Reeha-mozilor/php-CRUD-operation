<?php

require 'session.php';



if  ($_SERVER["REQUEST_METHOD"]=="POST"){
    require 'dbcon.php';
        function validates($data){

            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            
            return $data;
        }


$fname=validates($_POST['fname']);
$lname=validates($_POST['lname']);
$email=validates($_POST['email']);
$_SESSION["password"]=$_POST['pass'];
$password_hash = password_hash($_POST["pass"], PASSWORD_DEFAULT);


$sql = "update users 
              set   firstname=?,
                    lastname=?,
                    email=?,
                    password=?
                    where id='$id'";
     
$stmt = mysqli_prepare($conn, $sql);

if ($stmt === false) {

        echo mysqli_error($conn);

    } else {
        mysqli_stmt_bind_param($stmt,"ssss",
                  $fname,
                  $lname,
                  $email,
                  $password_hash);
        if (mysqli_stmt_execute($stmt)) {
          require 'session.php';
          header("refresh;url=userdetails.php");
          echo '<script>alert("User details updated successfully");</script>';
      

        } else {

            echo mysqli_stmt_error($stmt);
        }
    }
}



?>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Update</title>
  <link rel='stylesheet' href="css/login.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="login-form" id="login">
  <form method="post" id="update">
    <h1><?= $row['user'];?></h1>
    <div class="content">
      <div class="input-field">
        <div class='label'><label>First Name</label></div>
        <input type="text"  name="fname" id="fname" required value="<?= $row['firstname'];?>" >
      </div>
      <div class="input-field">
      <div class='label'><label>Last Name</label></div>
        <input type="text"  name="lname" id="lname" required value="<?=$row['lastname'];?>">
      </div>
      <div class="input-field">
      <div class='label'><label>Email</label></div>
        <input type="text"  name="email" id="email" required value="<?=$row['email'];?>">
      </div>
      <div class="input-field">
      <div class='label'><label class='label'>Password</label></div>
        <input type="password" name="pass" id="pass" minlength="8" required value="<?=$_SESSION["password"];?>">
      </div>
    </div>
    <div class="action">
      <button>Update</button>
    </div>
  </form>   
</div>
<!-- partial -->
<script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="script.js"></script>
</body>
</html>