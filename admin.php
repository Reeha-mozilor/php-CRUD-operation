
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>admin</title>
  <link rel='stylesheet' href="css/login.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="login-form" id="login">
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
    echo "<tr><td>" . $row["id"]. "</td>
              <td>" . $row["user"] . "</td><td><a href='edit.php?id=".$row['id']."' id='btn'>Edit</a></td><td><a href='delete.php?id=".$row['id']."' id='btn'>Delete</a></td>";

    
    }
    } 

?>
    
  </form>
  
  
</div>
<!-- partial -->
<script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="script.js"></script>
</body>
</html>