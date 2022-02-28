<?php
session_start();
?>
<?php
$con = mysqli_connect("localhost","root","","crm");
 $id = $_SESSION['productid'];
if(isset($_POST['submit'])){
    $name = $_POST["name"];
    $details = $_POST["details"];
    $category= $_POST["category"];
    $imagename = $_FILES["profilepic"]["name"]; //storing file name
    $tempimagename = $_FILES["profilepic"]["tmp_name"]; //storing temp name  
    move_uploaded_file($tempimagename,"imgs/$imagename"); //storing file in image file
        if($name!=='')
        {
    $sql1= "UPDATE `productdetails` SET `name`='$name'  WHERE p_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your product have been updated")</script>';
        header('location:viewaproduct.php');  
    }
             else{
               echo '<script>alert("Error while updating product")</script>';
            }
        }
          if($email!=='')
        {
    $sql1= "UPDATE `productdetails` SET `details`='$details'  WHERE p_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:viewaproduct.php');  
    }
             else{
               echo '<script>alert("Error while updating product")</script>';
            }
        }
                if($category!=='')
        {
    $sql1= "UPDATE `productdetails` SET `category`='$category'  WHERE p_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:viewaproduct.php');  
    }
             else{
               echo '<script>alert("Error while updating product")</script>';
            }
        }
               
                if($imagename!=='')
        {
   $sql1= "UPDATE `productdetails` SET `image`='$imagename'  WHERE p_id='$id'";
    $query1 = mysqli_query($con,$sql1);
    if($query1){
         echo '<script>alert("Your Account have been updated")</script>';
        header('location:viewaproduct.php');  
    }
             else{
               echo '<script>alert("Error while updating product")</script>';
            }
        }
               
        }
		
    mysqli_close($con);
?>
<?php
if(isset($_GET['edi'])){
    $id = $_GET['edi']; 
    $_SESSION['productid']=$id;
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
       <link rel="stylesheet" href="login.css">
    </head>
    <body>
        <div class="login-title">
            <h2>Give all the information carefully</h2>
        </div>
        <div class="login-form">
            <div class="container">
                <div class="form-popup" id="myForm">
    <form  class="form-container"  method="POST" action="updateproductinfo.php" enctype="multipart/form-data">
            <label><b>Product Name</b></label><br/>
            <input name="name" type="text" class="form-login"  placeholder="<?php  echo $name; ?>" ><br />
            <label><b>Product Details </b></label><br/>
            <textarea name="details" class="form-login" placeholder="<?php  echo $details; ?>"  row="10" ></textarea><br />
        <label><b>Product Category </b></label><br/>
            <select name="category"  class="form-login">
                <option value="" > <?php  echo $category; ?> </option>
                <?php
                   $con = mysqli_connect("localhost","root","","crm");
     
                  $sql2 = "SELECT * FROM `productcategory` order by type";//ORDER BY id desc
                  $te = mysqli_query($con,$sql2);
  	
                 while($row=mysqli_fetch_array($te))
                  {    $type=$row['type'];
                
                     echo "<option value='$type' > $type </option>";
                
                 }?>
            </select> <br/>
             <label><b>Product Picture</b></label><br/>
            <input type="file" alt="pro-pic" name="profilepic" class="form-login" ><br />
        <input type="submit" name="submit" class="form-login submit" value="Update">
               <p style="text-align: right; font-size: 18px; font-family: cursive; color: white; padding-right: 380px">Back to <a href="viewaproduct.php" style="color: white">HOME</a></p>
        </form>
</div>

            </div>
        </div>
    </body>
</html>