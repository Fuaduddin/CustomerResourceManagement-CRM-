<?php
session_start();
?>
<?php
  $con = mysqli_connect("localhost","root","","crm");
 $id = $_SESSION["appointmentid"];
if(isset($_POST['submit'])){
    $cname= $_POST['cname'];
    $email = $_POST['cmail'];
    $cphone = $_POST['cphone'];	
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $product = $_POST["product"];
    $category = $_POST["category"];
    $piroty = $_POST["piroty"];
    $staff = $_POST["staff"];
    $amail=$semail;
        if($cname!=='')
        {
    $sql1= "UPDATE `appointment` SET `c_name`='$cname'  WHERE a_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Appointment have been updated")</script>';
        header('location:viewappointment.php');  
    }
             else{
               echo '<script>alert("Error while updating appointment")</script>';
            }
        }
                 if($email!=='')
        {
    $sql1= "UPDATE `appointment` SET `c_email`='$email'  WHERE a_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Appointment have been updated")</script>';
        header('location:viewappointment.php');  
    }
             else{
               echo '<script>alert("Error while updating appointment")</script>';
            }
        }
                       if($cphone!=='')
        {
    $sql1= "UPDATE `appointment` SET `c_phone`='$cphone'  WHERE a_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Appointment have been updated")</script>';
        header('location:viewappointment.php');  
    }
             else{
               echo '<script>alert("Error while updating appointment")</script>';
            }
        }
               
                        if($subject!=='')
        {
    $sql1= "UPDATE `appointment` SET `subject`='$subject'  WHERE a_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Appointment have been updated")</script>';
        header('location:viewappointment.php');  
    }
             else{
               echo '<script>alert("Error while updating appointment")</script>';
            }
        }
            if($message !=='')
        {
    $sql1= "UPDATE `appointment` SET `details`='$message'  WHERE a_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Appointment have been updated")</script>';
        header('location:viewappointment.php');  
    }
             else{
               echo '<script>alert("Error while updating appointment")</script>';
            }
        }
            if($product!=='')
        {
    $sql1= "UPDATE `appointment` SET `prduct`='$product'  WHERE a_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Appointment have been updated")</script>';
        header('location:viewappointment.php');  
    }
             else{
               echo '<script>alert("Error while updating appointment")</script>';
            }
        }
            if($category!=='')
        {
    $sql1= "UPDATE `appointment` SET `productcategory`='$category'  WHERE a_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Appointment have been updated")</script>';
        header('location:viewappointment.php');  
    }
             else{
               echo '<script>alert("Error while updating appointment")</script>';
            }
        }
            if($staff!=='')
        {
    $sql1= "UPDATE `appointment` SET `s_name`='$staff'  WHERE a_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Appointment have been updated")</script>';
        header('location:viewappointment.php');  
    }
             else{
               echo '<script>alert("Error while updating appointment")</script>';
            }
        }
            if($amail!=='')
        {
    $sql1= "UPDATE `appointment` SET `s_email`='$amail'  WHERE a_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Appointment have been updated")</script>';
        header('location:viewappointment.php');  
    }
             else{
               echo '<script>alert("Error while updating appointment")</script>';
            }
        }
          if($piroty!=='')
        {
    $sql1= "UPDATE `appointment` SET `piroty`='$piroty'  WHERE a_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Appointment have been updated")</script>';
        header('location:viewappointment.php');  
    }
             else{
               echo '<script>alert("Error while updating appointment")</script>';
            }
        }
}
		
?>
<?php
if(isset($_GET['edi'])){
    $id = $_GET['edi']; 
    $_SESSION["appointmentid"]=$id;
    $con = mysqli_connect("localhost","root","","crm");
    $sql1= "Select * from `appointment` where a_id= '$id' limit 1";
    $query1 = mysqli_query($con,$sql1);
    while($row = mysqli_fetch_assoc($query1))
    {
    $cname = $row["c_name"];
    $cemail = $row["c_email"];
    $cphone = $row["c_phone"];
    $subject = $row["subject"];
    $details = $row["details"];
    $product = $row["product"];
    $category= $row["productcategory"];
    $sname = $row["s_name"];
    $semail = $row["s_email"];
    $piroty = $row["piroty"];
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
    <form class="modal-content"  method="POST" action="updateappointment.php" enctype="multipart/form-data">
        <div class="container">
            <h1 style="text-align=center;">New Appointment</h1>
            <label><b>Customer Name</b></label><br/>
            <input name="cname" type="text" class="form-login"  placeholder="<?php  echo $cname; ?>" ><br />
            <label><b>Customer Email </b></label><br/>
            <input name="cmail" type="text" class="form-login" placeholder="<?php echo $cemail; ?>"  ><br />
            <label><b>Customer Phone </b></label><br/>
            <input name="cphone" type="text" class="form-login" placeholder="<?php echo $cphone; ?>" ><br />
            <label><b>Subject </b></label><br/>
            <input name="subject" type="text" class="form-login" placeholder="<?php echo $subject; ?>"><br />
            <label><b>Details </b></label><br/>
            <textarea name="message" class="form-login" placeholder= "<?php echo $details; ?>" row="10" ></textarea><br />
           <label><b>Prroduct Category </b></label><br/>
            <select name="category" class="form-login">
                <option > <?php echo $category; ?> </option>
                <?php
                   $con = mysqli_connect("localhost","root","","crm");
     
                  $sql2 = "SELECT * FROM `productcategory` order by type";//ORDER BY id desc
                  $te = mysqli_query($con,$sql2);
  	
                 while($row=mysqli_fetch_array($te))
                  {    $type=$row['type'];
                
                     echo "<option value='$type' > $type </option>";
                
                 }?>
            </select><br/>
            <label><b>Product </b></label><br/>
                <select name="product" type="text" class="form-login" >
                  <option > <?php echo $product; ?> </option>
                <?php
                   $con = mysqli_connect("localhost","root","","crm");
     
                  $sql2 = "SELECT * FROM `product` order by name";//ORDER BY id desc
                  $te = mysqli_query($con,$sql2);
  	
                 while($row=mysqli_fetch_array($te))
                  {    $name=$row['name'];
                
                     echo "<option value='$name' > $name </option>";
                
                 }?>
            </select><br/>
            <label><b>Assign To </b></label><br/>
                <select name="staff" type="text" class="form-login" >
               <option> <?php echo $sname.($semail); ?> </option>
                <?php
                   $con = mysqli_connect("localhost","root","","crm");
     
                  $sql2 = "SELECT * FROM `staff` order by name";//ORDER BY id desc
                  $te = mysqli_query($con,$sql2);
  	
                 while($row=mysqli_fetch_array($te))
                  {    $name=$row['name'];
                       $semail=$row['email'];
                     echo "<option value='$name' > $name.($semail) </option>";
                
                 }?>
            </select><br/>
             <label><b>Piroty</b></label><br/>
                <select name="piroty" type="text" class="form-login" >
                <option  > <?php echo $piroty; ?> </option>
                <option value='emergency' >Emergency </option>
                <option value='average' >Average </option>
                <option value='low' >Low </option>
            </select><br/>
              <input type="submit" name="submit" class="form-login submit" value="Update">
        </div>
        </form>
            </div>
        </div>
    </body>
</html>