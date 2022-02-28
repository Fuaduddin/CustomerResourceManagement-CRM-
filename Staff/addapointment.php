<?php
session_start();
?>

<?php
if(isset($_GET['edi'])){
    $id = $_GET['edi']; 
    $con = mysqli_connect("localhost","root","","crm");
    $sql1= "Select * from `productdetails` where p_id= '$id' limit 1";
    $query1 = mysqli_query($con,$sql1);
    while($row = mysqli_fetch_assoc($query1))
    {
    $name = $row["name"];
    $details = $row["details"];
    $category= $row["category"];
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
        <?php
if(isset($_GET['edi'])){
    $id = $_GET['edi']; 
    $con = mysqli_connect("localhost","root","","crm");
    $sql1= "Select * from `customer` where c_id= '$id' limit 1";
    $query1 = mysqli_query($con,$sql1);
    while($row = mysqli_fetch_assoc($query1))
    {
    $name = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    }
}
?>

        <div class="login-title">
            <h2>Give all the information carefully</h2>
        </div>
        <div class="login-form">
            <div class="container">
    <form class="modal-content"  method="POST" action="addapointment.php" enctype="multipart/form-data">
        <div class="container">
            <h1 style="text-align=center;">New Appointment</h1>
            <label><b>Customer Name</b></label><br/>
            <input name="cname" type="text" class="form-login" value="<?php  echo $name; ?>" required><br />
            <label><b>Customer Email </b></label><br/>
            <input name="cmail" type="text" class="form-login" value="<?php echo $email; ?>"  required><br />
            <label><b>Customer Phone </b></label><br/>
            <input name="cphone" type="text" class="form-login" value="<?php echo $phone; ?>"  required><br />
            <label><b>Subject </b></label><br/>
            <input name="subject" type="text" class="form-login" placeholder="Subject" required><br />
            <label><b>Details </b></label><br/>
            <textarea name="message" class="form-message" placeholder="Write your message" row="10" required></textarea><br />
            <label>Product Category </label><br/>
            <select name="category" class="form-control" required>
                <option value selected></option>
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
                <select name="product" type="text" class="form-control" required>
                <option value selected></option>
                    <option value='test' > test </option>
                <?php
                   $con = mysqli_connect("localhost","root","","crm");
     
                  $sql2 = "SELECT * FROM `product` order by name";//ORDER BY id desc
                  $te = mysqli_query($con,$sql2);
  	
                 while($row=mysqli_fetch_array($te))
                  {    $name=$row['name'];
                
                     echo "<option value='$name' > $name </option>";
                
                 }?>
            </select><br/>
             <button name="post" type="submit" class="signupbtn">Post</button>
        </div>
        </form>
            <?php
if(isset($_POST['post'])){
    $con = mysqli_connect("localhost","root","","crm");
    $cname= $_POST['cname'];
    $email = $_POST['cmail'];
    $cphone = $_POST['cphone'];	
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $product = $_POST["product"];
    $category = $_POST["category"];
    $piroty = 0;
    $staff = 0;
    $id=bin2hex(random_bytes(10));
    $due=0;
    $time=0;
    $done=0;
    $amail=$semail;
        
          $sql1 = "INSERT INTO `appointment`(`c_name`, `product`,`productcategory`, `subject`, `details`,`s_name`,`c_email`, `ap_id`, `piroty`,`c_phone`,`date`,`time`,`s_email`,`done`) VALUES ('$cname','$product','$category','$subject','$message','$staff','$email','$id','$piroty','$cphone','$due','$time','$amail','$done')"; 
          $query2 = mysqli_query($con,$sql1);
        if(query2){
             echo '<script>alert("New appointment is added ")</script>';
            echo '<script>window.location="viewcustomer.php"</script>';
        }
        else{
            echo '<script>alert("There is a problem while  adding the appoinment ")</script>';
             echo '<script>window.location="viewcustomer.php"</script>';
        }
    }		
    mysqli_close($con);
?>
    </div>
</div>
    </body>
</html>