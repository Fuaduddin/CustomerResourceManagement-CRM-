<?php
session_start();
$con = mysqli_connect("localhost","root","","crm");
if(isset($_POST['submit'])){
    $user = $_POST["user"];
    $sql1 = "SELECT * FROM `customer` WHERE `user`='$user'AND `status`= 'active' ";
	$sql3 = "SELECT * FROM `admin` WHERE `user`='$user' AND `status` = 'active'  ";
	$sql4 = "SELECT * FROM `staff` WHERE `user`='$user'  AND `status` = 'active' ";
    $sql2 = "SELECT * FROM  `user` WHERE `u_name`='$user' AND `status` = 'active'  "; 
    $query1 = mysqli_query($con,$sql1);
    $query2 = mysqli_query($con,$sql2);
	$query3 = mysqli_query($con,$sql3);
    $query4 = mysqli_query($con,$sql4);
    $row1 = mysqli_fetch_assoc($query1);
    $row2 = mysqli_fetch_assoc($query2);
	$row3 = mysqli_fetch_assoc($query3);
    $row4 = mysqli_fetch_assoc($query4);
    $cid = $row1["c_id"];
    $uid = $row2["u_id"];
	$aid = $row3["a_id"];
    $sid = $row4["s_id"];
	   if(mysqli_num_rows($query1)==1 && mysqli_num_rows($query4)==1)
    {
        $_SESSION['userid'] = $uid;
        $_SESSION['customerid'] = $cid;
        header("location:changepassword.php");
    }
    else if(mysqli_num_rows($query2)==1 && mysqli_num_rows($query4)==1)
    {
        $_SESSION['userid'] = $uaid;
        $_SESSION['adminid'] = $aid;
        header("location:changepassword.php");
    }
	else if(mysqli_num_rows($query3)==1 && mysqli_num_rows($query4)==1)
    {
        $_SESSION['userid'] = $uaid;
        $_SESSION['staffid'] = $sid;
        header("location:changepassword.php");
    }
    else
    {
       echo '<script>alert("Your Username Dosent match !!!")</script>';
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
            <h3 style="font-size: 13px; font-family: cursive; color:black; text-align: center;">If you are admin please contact with the admin panel</h3>
        </div>
        <div class="login-form">
            <form id="login-form" method="POST" action="changepass.php" enctype="multipart/form-data">
			<div>
                <input name="user" type="text" class="form-login" placeholder="User Name" required><br />
				 <input type="submit" name="submit" class="form-login submit" value="Continue">
				</div>
            </form>
        </div>
		
    </body>
</html>