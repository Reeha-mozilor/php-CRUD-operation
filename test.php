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
$id=($_POST['userid']);



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

    

      } else {

          echo mysqli_stmt_error($stmt);
      }
  }
}



?>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>admin</title>
  <link rel='stylesheet' href="css/login.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="tab"   id="login">
  <table>
    <div class="top">
    <tr>
        <td><b>ID</b></td>
        <td><b>USERNAME</b></td>
        <td><b>EDIT</b></td>
        <td><b>DELETE</b></td>
        </tr>
    </div>
        <?php
require 'dbcon.php';

$sql="select id,user from users";

$result=mysqli_query($conn,$sql);

if ($result->num_rows > 0) {
   
    while($row = $result->fetch_assoc()) {
      $id=$row["id"];
    echo "<tr><td>" . $row["id"]. "</td>
              <td>" . $row["user"] . "</td><td><button id='$id'  onclick='openpop(this.id)'>Edit</button></td><td><button><a href='delete.php?id=".$row['id']."' id='btn'>Delete</a></button></td>";

    
    }
    } 

?>
    
  </form>
  
  
</div>
<!-- partial -->

<div class="login-form"  id="log" style="display:none">
  <form method="post" id="edit">
    <h1 id='user'></h1>
    <input type="text" name="userid" id="userid" style="display:none">
    <div class="content">
      <div class="input-field">
        <div class='label'><label>First Name</label></div>
        <input type="text"  name="fname" id="fname" value="" required>
      </div>
      <div class="input-field">
      <div class='label'><label>Last Name</label></div>
        <input type="text"  name="lname" id="lname" value="" required>
      </div>
      <div class="input-field">
      <div class='label'><label>Email</label></div>
        <input type="text"  name="email" id="email" value="" required>
      </div>
      
    </div>
    <div class="action">
      <button id="abc">Update</button>
    </div>
  </form>   
</div>
<!-- partial -->
<script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="script.js"></script>
</body>
</html>