<?php
session_start();
$con = mysqli_connect("localhost","root","","crm");
$uid = $_SESSION['userid'];
$cid = $_SESSION['customerid'];
$sid = $_SESSION['staffid'];
$aid = $_SESSION['adminid'];
if(isset($_POST['submit'])){
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"]; 
       if($password===$cpassword)
        {
          $sql1= "UPDATE `customer` SET `password`='$password' WHERE c_id= '$cid'";
          $sql2 = "UPDATE `user` SET `password`='$password' WHERE `u_id`='$uid' ";
          $sql3= "UPDATE `admin` SET `password`='$password' WHERE a_id= '$aid'";
          $sql4 = "UPDATE `staff` SET `password`='$password' WHERE `s_id`='$sid' "; 
          $query1 = mysqli_query($con,$sql1);
          $query2 = mysqli_query($con,$sql2);		  
          $query3 = mysqli_query($con,$sql3);
          $query4 = mysqli_query($con,$sql4);
			echo '<script>alert("Your password havebeen changed")</script>';
            header("location:login.php");
		}
        else{
          echo '<script>alert("Password does not match ")</script>';
        }
        }
    mysqli_close($con);
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Your Awesome Company </title>
      <link rel="stylesheet" href="login.css">
    </head>
    <body>
        <div class="login-title">
            <h2 style="font-size: 14px; font-family: cursive; color:black; text-align: center;">Give all the information carefully</h2>
        </div>
        <div class="login-form">
            <form id="login-form" method="POST" action="changepassword.php" enctype="multipart/form-data">
                <input name="password" type="password" class="form-login" placeholder="Password" required><br />
                <input name="cpassword" type="password" class="form-login" placeholder="Repeat Password" required><br />
                <input type="submit" name="submit" class="form-login submit" value="Save">
            </form>
        </div>
    </body>
</html>