<?php
session_start();
?>
<?php
$con = mysqli_connect("localhost","root","","crm");
$sid= $_SESSION["staffid"];
if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $user = $_POST["user"];
    $id = $_POST["sid"];
    $status = $_POST["status"];
    $address = $_POST["address"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"]; 
    $imagename = $_FILES["profilepic"]["name"]; //storing file name
    $tempimagename = $_FILES["profilepic"]["tmp_name"]; //storing temp name  
    move_uploaded_file($tempimagename,"imgs/$imagename"); //storing file in image file
    $gender = $_POST["gender"];
        if($name!=='')
        {
    $sql1= "UPDATE `staff` SET `name`='$name'  WHERE s_id='$sid'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:viewstaff.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }
          if($email!=='')
        {
    $sql1= "UPDATE `staff` SET `email`='$email'  WHERE s_id='$sid'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:viewstaff.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }
                if($phone!=='')
        {
    $sql1= "UPDATE `staff` SET `phone`='$phone'  WHERE s_id='$sid'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:viewstaff.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }
               
                if($user!=='')
        {
    $sql1= "UPDATE `staff` SET `user`='$user'  WHERE s_id='$sid'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:viewstaff.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }
               
                if($password!=='')
        {
                    if($password == $cpassword)
                    {
                        
                    
    $sql1= "UPDATE `staff` SET `password`='$password'  WHERE s_id='$sid'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:viewstaff.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }
                }
               
                if($imagename!=='')
        {
    $sql1= "UPDATE `staff` SET `image`='$imagename'  WHERE s_id='$sid'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:viewstaff.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }
               
                if($address!=='')
        {
    $sql1= "UPDATE `staff` SET `address`='$address'  WHERE s_id='$sid'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:viewstaff.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }
                 if($gender!=='')
        {
    $sql1= "UPDATE `staff` SET `gender`='$gender'  WHERE s_id='$sid'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:viewstaff.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }          
          if($id!=='')
        {
    $sql1= "UPDATE `staff` SET `user_id`='$id'  WHERE s_id='$sid'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:viewstaff.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }          
        if($status!=='')
        {
    $sql1= "UPDATE `staff` SET `gender`='$status'  WHERE s_id='$sid'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:viewstaff.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }          
		}
		
?>
<?php
if(isset($_GET['edi'])){
    $id = $_GET['edi']; 
    $_SESSION["staffid"]=$id;
    $con = mysqli_connect("localhost","root","","crm");
    $sql1= "Select * from `staff` where s_id= '$id' limit 1";
    $query1 = mysqli_query($con,$sql1);
    while($row = mysqli_fetch_assoc($query1))
    {
    $sid = $row["s_idd"];
    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $user = $row["user"];
    $address = $row["address"];
    $password = $row["password"];
    $gender = $row["gender"];
        $status = $row["status"];
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
            <div class="container">
            <form id="login-form" method="POST" action="updatestaffinfo.php" enctype="multipart/form-data">
                <label style="text-color: white"><b>Staff ID</b></label> <br/>
                <input name="sid" id="name" type="text" class="form-login" placeholder="<?php  echo $sid; ?>"><br />
                <label style="text-color: white"><b>Staff Name</b></label> <br/>
                <input name="name" type="name" class="form-login" placeholder="<?php echo $name;?>"><br />
                <label><b>Staff Email</b></label><br/>
                <input name="email" type="email" class="form-login"  placeholder="<?php echo $email;?>"><br />
                <label><b>StaffPhone Number</b></label><br/>
                <input name="phone" type="phone" class="form-login"  placeholder="<?php echo $phone;?>"><br />
                 <label><b>Staff Address</b></label><br/>
                <input name="address" type="address" class="form-login" placeholder="<?php echo $address;?>"><br />
                <label><b>Gender</b></label><br/>
                              <select name="gender" type="text" class="form-login">
                               <option value='' ><?php echo $gender; ?></option>
                                  <option value='male' > Male</option>
                                  <option value='female' > Female  </option>
                       </select> <br/>
                <label><b>Staff User ID</b></label><br/>
                <input name="user" type="email/phone" class="form-login"  placeholder="<?php echo $user;?>"><br />
                 <label><b>Staff User ID Password</b></label><br/>
                <input name="password" type="password" class="form-login" placeholder="<?php echo $password;?>"><br />
                 <label><b>Confirm Password</b></label><br/>
                <input name="cpassword" type="password" class="form-login" placeholder="Repeat Password"><br />
                            <label><b>Status</b></label><br/><br/>
                              <select name="status" type="text" class="form-login">
                             <option value='' ><?php echo $status; ?></option>
                                  <option value='active' >Active</option>
                                  <option value='inactive' > Inactive  </option>
                       </select> <br/>
              <label><b>Profile Picture</b></label><br/>
                        <input type="file" alt="pro-pic" name="profilepic" class="form-login"><br />
                <input type="submit" name="submit" class="form-login submit" value="Update">
                <p style="text-align: right; font-size: 18px; font-family: cursive; color: white; padding-right: 380px">Back to <a href="viewstaff.php" style="color: white">HOME</a></p>
            </form>
            </div>
        </div>
    </body>
</html>