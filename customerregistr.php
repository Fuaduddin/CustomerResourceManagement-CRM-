<?php
$con = mysqli_connect("localhost","root","","crm");
if(isset($_POST['submit'])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $user = $_POST["user"];
    $address = $_POST["address"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"]; 
    $imagename = $_FILES["profilepic"]["name"]; //storing file name
    $tempimagename = $_FILES["profilepic"]["tmp_name"]; //storing temp name  
    move_uploaded_file($tempimagename,"imgs/$imagename"); //storing file in image file
    $gender = $_POST["gender"]; 
    $type = "customer";
    $uid=0;
    $status = "inactive";
    $token=bin2hex(random_bytes(15));
    $uid=bin2hex(random_bytes(10));
    $exit= "select * from user where u_name='$user'" ;
    $query1=mysqli_query($con,$exit);
    $row = mysqli_fetch_assoc($query1);
    if(mysqli_num_rows($query1)==1)
    {
       echo '<script>alert("An account is already exist")</script>';
    }
    else{
        if($password===$cpassword)
        {
          $c = "INSERT INTO `customer`(`name`, `address`, `phone`, `email`, `password`, `image`, `user`, `gender`, `token`, `status`,`user_id`) VALUES ('$name','$address','$phone','$email','$password','$imagename','$user','$gender','$token','$status','$uid')";
          $sql3 = "INSERT INTO `user`(`u_name`, `u_password`, `u_type`,`token`,`status`) VALUES ('$user','$password','$type','$token','$status')"; 
           $query2 = mysqli_query($con,$c);
           $query3 = mysqli_query($con,$sql3);
            $subject = "Account Activation";
            $body = "Hi,$name. click on the link to active your account http://localhost/CRM/customer/activation.php?token=$token";
            $headers = "From: fuaduddinador@gmail.com";

          if (mail($email, $subject, $body, $headers)) {
              echo '<script>alert("Email sucessfully sent ")</script>';
          } else {
             echo '<script>alert("failto sent email ")</script>';
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
            <form id="login-form" method="POST" action="customerregistr.php" enctype="multipart/form-data">
                <input name="name" type="name" class="form-login" placeholder="Full Name" required><br />
                <input name="email" type="email" class="form-login" placeholder="E-mail" required><br />
                <input name="phone" type="phone" class="form-login" placeholder="Phone Number" required><br />
                <input name="user" type="email/phone" class="form-login" placeholder="Email/Number" required><br />
                <input name="address" type="address" class="form-login" placeholder="Address" required><br />
                <input name="password" type="password" class="form-login" placeholder="Password" required><br />
                <input name="cpassword" type="password" class="form-login" placeholder="Repeat Password" required><br />
                <input type="radio" value="male" name="gender"  > Male
                <input type="radio" value="female" name="gender" > Female <br / >
                <input type="file" alt="pro-pic" name="profilepic" class="form-control"><br />
                <input type="submit" name="submit" class="form-login submit" value="Registration">
                <p style="text-align: right; font-size: 18px; font-family: cursive; color: white; padding-right: 380px">Back to <a href="home.php" style="color: white">HOME</a></p>
            </form>
        </div>
    </body>
</html>