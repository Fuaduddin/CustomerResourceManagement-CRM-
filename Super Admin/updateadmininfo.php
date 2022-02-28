<?php
session_start();
?>
<?php
$con = mysqli_connect("localhost","root","","crm");
 $aid = $_SESSION["adminid"];
if(isset($_POST['submit'])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $user = $_POST["user"];
    $id = $_POST["id"];
    $status = $_POST["status"];
    $address = $_POST["address"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"]; 
    $imagename = $_FILES["profilepic"]["name"]; //storing file name
    $tempimagename = $_FILES["profilepic"]["tmp_name"]; //storing temp name  
    move_uploaded_file($tempimagename,"imgs/$imagename"); //storing file in image file
    $gender = $_POST["gender"];
    $exit= "select * from user where user='$user'" ;
    $query1=mysqli_query($con,$exit);
    $row = mysqli_fetch_assoc($query1);
    if(mysqli_num_rows($query1)==1)
    {
       echo '<script>alert("An account is already exist")</script>';
    }
    else{
        if($name!=='')
        {
    $sql1= "UPDATE `admin` SET `name`='$name'  WHERE a_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:viewadmin.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }
          if($email!=='')
        {
    $sql1= "UPDATE `admin` SET `email`='$email'  WHERE a_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:viewadmin.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }
                if($phone!=='')
        {
    $sql1= "UPDATE `admin` SET `phone`='$phone'  WHERE a_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:viewadmin.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }
               
                if($user!=='')
        {
    $sql1= "UPDATE `admin` SET `user`='$user'  WHERE a_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:viewadmin.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }
               
                if($password!=='')
        {
                    if($password == $cpassword)
                    {
                        
                    
    $sql1= "UPDATE `admin` SET `password`='$password'  WHERE a_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:viewadmin.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }
                }
               
                if($imagename!=='')
        {
    $sql1= "UPDATE `admin` SET `image`='$imagename'  WHERE a_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:viewadmin.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }
               
                if($address!=='')
        {
    $sql1= "UPDATE `admin` SET `address`='$address'  WHERE a_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:viewadmin.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }
                 if($gender!=='')
        {
    $sql1= "UPDATE `admin` SET `gender`='$gender'  WHERE a_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:viewadmin.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }          
          if($id!=='')
        {
    $sql1= "UPDATE `admin` SET `user_id`='$id'  WHERE a_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:viewadmin.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }          
        if($status!=='')
        {
    $sql1= "UPDATE `admin` SET `gender`='$status'  WHERE a_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:viewadmin.php');  
    }
             else{
               echo '<script>alert("Error while updating profile")</script>';
            }
        }          
		}
        }
		
    mysqli_close($con);
?>
<?php
if(isset($_GET['edi'])){
    $id = $_GET['edi']; 
    $_SESSION["adminid"]=$id;
    $con = mysqli_connect("localhost","root","","crm");
    $sql1= "Select * from `admin` where a_id= '$id' limit 1";
    $query1 = mysqli_query($con,$sql1);
    while($row = mysqli_fetch_assoc($query1))
    {
     $id = $row["a_idd"];
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
            <form id="login-form" method="POST" action="updateadmininfo.php" enctype="multipart/form-data">
                <label style="text-color: white"><b>Admin ID</b></label> <br/>
                <input name="id" id="name" type="text" class="form-login" placeholder="<?php  echo $id; ?>"><br />
                <label style="text-color: white"><b>Admin Name</b></label> <br/>
                <input name="name" type="name" class="form-login" placeholder="<?php echo $name;?>"><br />
                <label><b>Admin Email</b></label><br/>
                <input name="email" type="email" class="form-login"  placeholder="<?php echo $email;?>"><br />
                <label><b>Admin Phone Number</b></label><br/>
                <input name="phone" type="phone" class="form-login"  placeholder="<?php echo $phone;?>"><br />
                 <label><b>Admin Address</b></label><br/>
                <input name="address" type="address" class="form-login" placeholder="<?php echo $address;?>"><br />
                <label><b>Gender</b></label><br/>
                              <select name="gender" type="text" class="form-login">
                               <option value='' ><?php echo $gender; ?></option>
                                  <option value='male' > Male</option>
                                  <option value='female' > Female  </option>
                       </select> <br/>
                <label><b>Staff User ID</b></label><br/>
                <input name="user" type="email/phone" class="form-login"  placeholder="<?php echo $user;?>"><br />
                 <label><b>Admin User ID Password</b></label><br/>
                <input name="password" type="password" class="form-login" placeholder="<?php echo $password;?>"><br />
                 <label><b>Confirm Password</b></label><br/>
                <input name="cpassword" type="password" class="form-login" placeholder="Repeat Password"><br />
                            <label><b>Status </b></label><br/>
                              <select name="status" type="text" class="form-login">
                             <option value='' ><?php echo $status; ?></option>
                                  <option value='active' >Active</option>
                                  <option value='inactive' > Inactive  </option>
                       </select> <br/>
              <label><b>Profile Picture</b></label><br/>
                        <input type="file" alt="pro-pic" name="profilepic" class="form-login"><br />
                <input type="submit" name="submit" class="form-login submit" value="Update">
                <p style="text-align: right; font-size: 18px; font-family: cursive; color: white; padding-right: 380px">Back to <a href="viewadmin.php" style="color: white">HOME</a></p>
            </form>
            </div>
        </div>
    </body>
</html>