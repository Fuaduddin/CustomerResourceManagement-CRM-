<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Your Awsome Company </title>
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
         <div class="login-title">
            <h1 style="font-size: 18px; font-family: cursive; color:black; text-align: center; ">Login</h1>
        </div>
        <div class="login-form">
            <form id="login-form" method="POST" action="login.php">
                <input name="user" type="text" class="form-login" placeholder="User Name" required><br />
                <input name="password" type="password" class="form-login" placeholder="Password" required><br />
                
                <input type="submit" name="submit" class="form-login submit" value="Login"><br />
            </form>
            <p style="text-align: right; font-size: 18px; font-family: cursive; color:black; text-align: center; "><a href="changepass.php" style="color:black; text-align: center;">Forgetten Password ?</a></p>
                  <p style="text-align: right; font-size: 18px; font-family: cursive; color:black; text-align: center; ">If you are not  Sign Up, click on Sign Up<a href="cadd.php" style="color: black"> Sign Up</a></p>
        </div>
    <?php
   $con = mysqli_connect("localhost","root","","crm");
   if(isset($_POST['submit'])){
		 $user = $_POST['user'];
		 $password = $_POST['password'];
         $sql1 = "SELECT u_type FROM `user` WHERE u_name = '$user' AND status = 'active' limit 1 ";
         $query1 = mysqli_query($con, $sql1);
         while($row1 = mysqli_fetch_assoc($query1))
        {
           $type = $row1["u_type"];
             if ($type == 'customer') {
                    $_SESSION['username'] = $user ;
					header('location:http://localhost/CRM/customer/confirmcode/Customer/cprofile.php');		  
			}
			elseif($type == 'admin'){
                   $_SESSION['username'] = $user ;
					header('location:http://localhost/CRM/customer/confirmcode/Admin/aprofile.php');
			}
            elseif($type== 'superadmin'){
                   $_SESSION['username'] = $user ;
					header('location:http://localhost/CRM/customer/confirmcode/Super%20Admin/sprofile.php');
                   date_default_timezone_set('Asia/Dhaka');
                   $date=date('Y-m-d');
                   $today = date("Y-m-d", strtotime($date.'+1day'));
                    $con = mysqli_connect("localhost","root","","crm");
                    $sql = "Select * from appointment where due = '$today' and status = '0'"; 
                    $query = mysqli_query($con,$sql);
                   while($row=mysqli_fetch_array($query))
                {
                $cname= $row['customer'];
                $aname= $row['aname'];
                $cemail= $row['email'];
                $time= $row['time']; 
                $subject = "Appoinment Reminder";
                $body = "Hi,$cname. Your have an appointment with $aname. today. Your appointment time is $time. ";
                $headers = "From: fuaduddinador@gmail.com";
               mail($cemail, $subject, $body, $headers);
                }
               $sql1 = "Select * from appointment where due = '$today' and status = '0' "; 
               $query1 = mysqli_query($con,$sql);
              while($row=mysqli_fetch_array($query1))
              {
               $cuname= $row['customer'];
              $adname= $row['aname'];
              $ademail= $row['amail'];
              $ctime= $row['time']; 
              $subject = "Appoinment Reminder";
             $body = "Hi,$adname. Your have an appointment with $cuname. today. Your appointment time is $ctime. ";
             $headers = "From: fuaduddinador@gmail.com";
             mail($ademail, $subject, $body, $headers);
              }
			}
            elseif($type== 'staff'){
                  $_SESSION['username'] = $user ;
				   header('location:staff/sprofile.php');
			}
		 	else {
             echo '<script>alert("Your password or email is wrong")</script>';
             header('location:login.php');
            }
             }
        }
                 
?>

           </body>
</html>