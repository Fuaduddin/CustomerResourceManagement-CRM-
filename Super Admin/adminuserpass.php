<?php
    session_start();
?>
<?php
$con = mysqli_connect("localhost","root","","crm");

if(isset($_GET['token'])){
    
    $token=$_GET['token'];
    $c = "UPDATE `admin` SET `status`= 'active'  WHERE token='$token'";
    $u = "UPDATE `user` SET `status`= 'active'  WHERE token='$token'";
    $query1 = mysqli_query($con,$c);
    $query2 = mysqli_query($con,$c);
}
?>
<?php
$token=$_SESSION['stafftoken'];
$con = mysqli_connect("localhost","root","","crm");
    if(isset($_POST['submit'])){
    $email = $_POST["email"];  
    $name = $_POST["name"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
         $uid=bin2hex(random_bytes(15));
    $exit= "select * from user where u_name='$name'" ;
    $query1=mysqli_query($con,$exit);
    $row = mysqli_fetch_assoc($query1);
    if(mysqli_num_rows($query1)==1)
    {
       echo '<script>alert("An account is already exist")</script>';
    }
        else{
    if($password===$cpassword)
        {
    $c = "UPDATE `admin` SET `user`= '$name', `password`='$password',`a_idd`='$uid'  WHERE email='$email'";
    $u = "UPDATE `user` SET `u_name`= '$name',`u_password`='$password'   WHERE email='$email'";
    $query1 = mysqli_query($con,$c);
        $query2 = mysqli_query($con,$c);
        if($query1 & $query2){
			echo '<script>alert("Your account is updated.")</script>';
            header("location:http://localhost/CRM/customer/confirmcode/login.php");
		}
        else
        {
            echo '<script>alert("ERROR!!!!")</script>';
        }
    }
        else{
          echo '<script>alert("Password does not match ")</script>';
        }
}
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Your Awesome Company </title>
       <link rel="stylesheet" href="login.css"> 
    </head>
    <body>
        <div class="login-title">
            <h2>Give all the information carefully</h2>
        </div>
        <div class="login-form">
            <form id="login-form" method="POST" action="staffuserpass.php" enctype="multipart/form-data">
                <label ><b>Your mail ID</b></label> <br/>
                   <input name="email" type="email" class="form-login" placeholder="Your mail" required><br />
                 <label ><b>User Name</b></label> <br/>
                   <input name="name" type="text" class="form-login" placeholder="User Name" required><br />
                  <label ><b>Password</b></label><br/>
                   <input name="password" type="text" class="form-login" placeholder="Password" required><br />
                    <label><b>Confirm Password</b></label><br/>
                   <input name="cpassword" type="text" class="form-login" placeholder="Confirm Password" required><br />
                <input type="submit" name="submit" class="form-login submit" value="Save">
            </form>
        </div>
    </body>
</html>