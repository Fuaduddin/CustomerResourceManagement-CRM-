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
    $date= $_POST["date"];
    $time= $_POST["time"];
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
            if($amail!=='')
        {
    $sql1= "UPDATE `appointment` SET `time`='$time'  WHERE a_id='$id'";
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
    $sql1= "UPDATE `appointment` SET `date`='$date'  WHERE a_id='$id'";
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
       <link rel="stylesheet" href="css\login.css">
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
            <textarea name="message" class="form-message" placeholder= "<?php echo $details; ?>" row="10" ></textarea><br />
            <label>Product Category </label><br/>
            <select name="category" class="form-control">
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
            <label>Product </label><br/>
                <select name="product" type="text" class="form-control" >
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
            <label>Product Category </label><br/>
            <select name="category" class="form-control">
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
                                 <label>Appointment Date</label><br/>
                <input name="date" type ="date" class="form-control"> <br/>
                <?php
$time = array("12:00-12:30 AM", "12:30-1:00 AM", "12:30-1:00 AM", "1:00-1:30 AM", "1:30-2:00 AM", "2:00-2:30 AM", "2:30-3:00 AM", "3:00-3:30 AM", "3:30-4:00 AM", "4:00-4:30 AM", "4:30-5:00 AM", "5:00-5:30 AM", "5:30-6:00 AM", "6:00-6:30 AM", "6:30-7:00 AM", "7:00-7:30 AM", "7:30-8:00 AM", "8:00-8:30 AM", "8:30-9:00 AM", "9:00-9:30 AM", "9:30-10:00 AM", "10:00-10:30 AM", "10:30-11:00 AM","11:00-11:30 AM", "11:30-12:00 AM", "12:00-12:30 PM", "12:30-1:00 PM", "12:30-1:00 PM", "1:00-1:30 PM", "1:30-2:00 PM", "2:00-2:30 PM", "2:30-3:00 PM", "3:00-3:30 PM", "3:30-4:00 PM", "4:00-4:30 PM", "4:30-5:00 PM", "5:00-5:30 PM", "5:30-6:00 PM", "6:00-6:30 PM", "6:30-7:00 PM", "7:00-7:30 PM", "7:30-8:00 PM", "8:00-8:30 PM", "8:30-9:00 PM", "9:00-9:30 PM", "9:30-10:00 PM", "10:00-10:30 PM", "10:30-11:00 PM", "11:00-11:30 PM","11:30-12:00 AM");
?>
  <label>Appointment Time Slots</label><br/>
   <select name="time" class="form-control" required>
<option value selected ></option>
  <?php
	foreach($time as $key => $value):
	echo '<option value="'.$value.'">'.$value.'</option>'; //close your tags!!
		endforeach;
	?>
       </select><br/>
              <input type="submit" name="submit" class="form-login submit" value="Update">
        </div>
        </form>
            </div>
        </div>
    </body>
</html>