<?php

if (isset($_GET['id'])) {
    $id=$_GET['id'];
    
require 'dbcon.php';
$sql="select * from users where id=$id";
$result=mysqli_query($conn,$sql);


if(mysqli_num_rows($result)===1){

    $row=mysqli_fetch_assoc($result);
    echo $id;
}
}

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


$sql = "update users 
              set   firstname=?,
                    lastname=?,
                    email=?
                    where id='$id'";
     
$stmt = mysqli_prepare($conn, $sql);

if ($stmt === false) {

        echo mysqli_error($conn);

    } else {
        mysqli_stmt_bind_param($stmt,"sss",
                  $fname,
                  $lname,
                  $email);
        if (mysqli_stmt_execute($stmt)) {
          /*may give code */
           $sql="select * from users where id=$id";
           $result=mysqli_query($conn,$sql);
           if(mysqli_num_rows($result)===1){
            $row=mysqli_fetch_assoc($result);
           }

          header("refresh;url=userdetails.php");
      

        } else {

            echo mysqli_stmt_error($stmt);
        }
    }
}



?>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>edit</title>
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