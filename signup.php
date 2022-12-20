
<?php


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
$uname=validates($_POST['uname']);
$password_hash = password_hash($_POST["pass"], PASSWORD_DEFAULT);
$type='user';


$sql = "INSERT INTO users (firstname,lastname,email,user,password,type)
        VALUES (?, ?, ?,?,?,?)";
     
$stmt = mysqli_prepare($conn, $sql);

if ($stmt === false) {

        echo mysqli_error($conn);

    } else {
        mysqli_stmt_bind_param($stmt,"ssssss",
                  $fname,
                  $lname,
                  $email,
                  $uname,
                  $password_hash,
                  $type);
        if (mysqli_stmt_execute($stmt)) {

          echo '<script>if(confirm("Account created successfully.Press Ok to continue")){
            location.href ="login.php";
          }</script>';

        } else {

            echo mysqli_stmt_error($stmt);
        }
    }
}

?>

<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>signup</title>
  <link rel='stylesheet' href="css/login.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="login-form" id="login">
  <form method="post" id="signup">
    <h1>Sign Up</h1>
    <div class="content">
      <div class="input-field">
        <input type="text" placeholder="First name" name="fname" id="fname" required>
      </div>
      <div class="input-field">
        <input type="text" placeholder="Last name" name="lname" id="lname" required>
      </div>
      <div class="input-field">
        <input type="text" placeholder="Email" name="email" id="email" required>
      </div>
      <div class="input-field">
        <span id="check-username"></span>
        <input type="text" placeholder="Username" name="uname" id="uname" required oninput="checkUsername()">
      </div>
      <div class="input-field">
        <input type="password" placeholder="Password" name="pass" id="pass" minlength="8" required>
      </div>
    </div>
    <div class="action">
      <button id= "submit">Sign up</button>
    </div>
  </form>
</div>
<!-- partial -->
<script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="script.js"></script>
</body>
</html>