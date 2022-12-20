<?php

if ($_SERVER["REQUEST_METHOD"]=="POST"){
  require 'dbcon.php';



if(isset($_POST['uname'])&& isset($_POST['pass'])){

    function validate($data){

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        
        return $data;
    }
}

$uname=validate($_POST['uname']);
$pass=validate($_POST['pass']);

$sql="select * from users where user='$uname'";

$result=mysqli_query($conn,$sql);

if(mysqli_num_rows($result)===1){

    $row=mysqli_fetch_assoc($result);

    if ($row['type']=='admin'&& $pass==$row['password']){
      header("Location:test.php");
    }
    elseif ($row['user']===$uname && password_verify($pass,$row['password'])){

      session_start();
      $_SESSION["user_id"]=$row['id'];
      $_SESSION["password"]=$pass;

      header("Location:userdetails.php");
    

    }
    else{
      echo '<script>alert("Incorrect credentials");</script>';
  }
}
else{
    echo '<script>alert("Incorrect credentials");</script>';
}
    

    
    
} 
?>


<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel='stylesheet' href="css/login.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="login-form" id="login">
  <form method="post" id="log">
    <h1>Login</h1>
    <div class="content">
      <div class="input-field">
        <input type="text" placeholder="Username" name="uname" id="uname" required>
      </div>
      <div class="input-field">
        <input type="password" placeholder="Password" name="pass" id="pass" required>
      </div>
    </div>
    <div class="action">
      <button>Sign in</button>
    </div>
  </form>
  
  
</div>
<h4 class="foot" style="color: #777;">Do not have an account?<a style="color:white" href="signup.php">Register here</a><h4>
<!-- partial -->
<script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="script.js"></script>
</body>
</html>