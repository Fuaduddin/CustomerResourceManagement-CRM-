<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Your Awosome Company</title>
    <link rel="stylesheet" href="view.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="profile.css">
     <link rel="stylesheet" href="form.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
            <div class="wrapper">
    <div class="sidebar" >
        <?php 
        $un = $_SESSION['username'];
$con = mysqli_connect("localhost","root","","crm");
$sql = "select * from admin where user = '$un' limit 1";       
$query = mysqli_query($con,$sql); 
$row = mysqli_fetch_assoc($query);
        ?>
        <div class="images">
        <img src="<?php echo 'imgs/' . $row['image'] ?>" alt='Profile pic'><br /><br />
            <?php
                echo "<i style='font-size: 20px; color: white; text-align: center;'>"."<b>".$row["name"]."</i>"."</b>"."<br /><br />"; 
                echo "<i style='font-size: 14px; color: white;'>".$row["a_idd"]."</i>"."<br />"; 
            ?>
         <a href="superadmineditprofile.php"<?php  $_SESSION['superadmin']=$row["a_id"]; ?> style="text-align: right; font-family: cursive" class="btn btn-secondary">Edit Profile</a>
            </div>
        <ul style="padding-top: 3px;">
            <li><a href="Sprofile.php"><i class="fas fa-home"></i>Home</a></li>
            <li><a href="updatecustomer.php"><i class='fas fa-business-time' style='font-size:20px'></i>UPDATE OR ADD CUSOMERS</a></li>
            <li><a href="viewadmin.php"><i class='fas fa-business-time' style='font-size:20px'></i>UPDATE OR ADD ADMINS</a></li>
            <li><a href="viewstaff.php"><i class='fas fa-business-time' style='font-size:20px'></i>UPDATE OR ADD STAFFS</a></li>
            <li><a href="viewproductcategory.php"><i class='fas fa-business-time' style='font-size:20px'></i>UPDATE OR ADD PRODUCT CATEGORYS</a></li>
            <li><a href="viewaproduct.php"><i class='fas fa-business-time' style='font-size:20px'></i>UPDATE OR ADD PRODUCTS</a></li>
            <li><a href="viewannoucement.php"><i class='fas fa-business-time' style='font-size:20px'></i>UPDATE OR POST ANOUCEMENTS</a></li>
            <li><a href="viewcustomer.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD APPOINTMENTS</a></li>
            <li><a href="viewappointment.php"><i class='fas fa-business-time' style='font-size:20px'></i>UPDATE APPOINTMENTS</a></li>
            <li><a href="logout.php"><i class='fas fa-backward' style='font-size:20px'></i> Log Out</a></li>
        </ul> 
    </div>
</div>
<div class="container" style=" align-content: center; padding-top:40px;">
   <br />
    <div style="align=center; padding-left: 180px;">
   <div class="form-group">
    <div class="input-group">
     <span class="input-group-addon">Search</span>
     <input type="text"  id="search"  placeholder="Search ....." class="form-control" />
    </div>
   </div>
    </div>
   <br />
   <div id="result" style="padding-left: 150px; align-content: center;">
        <div class="container ">
        <div class="shadow-4 rounded-5 overflow-hidden">
            <table id="example" class="table bg-white table-hover table-active-bg-factor table-bordered" style="width: 90%;">
                <thead class="bg-light">
                    <tr>

                        <th>Product</th>
                        <th>Product Name</th>
                        <th>Product Details</th>
                        <th>Product Category </th>
                        <th>Delete</th>
                        <th>Update</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                                        $con = mysqli_connect("localhost","root","","crm");
                                        
                  $sql = "select * from `productdetails` order by name";//ORDER BY id desc
                $result = mysqli_query($con, $sql);
         if(mysqli_num_rows($result)>0 )
                {
                
                            
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    ?>
                    <tr>
                        <td> <img src="<?php echo 'imgs/' . $row['image'] ?>" class="rounded-circle" alt='' style="width: 110px; height: 100px"></td>
                        <td ><?php echo $row["name"];?> </td>
                        <td> <?php echo $row["details"];?> </td>
                        <td> <?php echo $row["category"];?></td>

                         <td><a href="viewaproduct.php?del=<?php echo $row["p_id"];?>" class="btn btn-primary" style="text-align: right; font-family: cursive" class="btn text-danger">Delete</a></td>
                          <td><a href="updateproductinfo.php?edi=<?php echo  $row["p_id"];?>" class="btn btn-primary" style="text-align: right; font-family: cursive" class="btn text-danger">Update</a></td>

                    </tr>
                    <?php
                                }
                }
    
            ?>

                </tbody>
            </table>
        </div>
    </div>
    </div>
  </div>
        <script>
         $(document).ready(function() {
            $('#search').keyup(function() {
                var search = $(this).val();
               var output=console.log(search.lenght);
                if ( output != 0) {
                    $.ajax({
                        url: "product search.php",
                        method: "POST",
                        data: {
                            search: search
                        },
                        success: function(data) {
                            $('#result').html(data);
                        }
                    });
                }
                else
                    {
                       document.getElementById("result").innerHTML="";
                    }
            });
        });
    </script>
 <?php
          $con = mysqli_connect("localhost","root","","crm");
if(isset($_POST['add'])){
    $name = $_POST["name"];
    $details = $_POST["details"];
    $imagename = $_FILES["profilepic"]["name"]; //storing file name
    $tempimagename = $_FILES["profilepic"]["tmp_name"]; //storing temp name  
    move_uploaded_file($tempimagename,"imgs/$imagename"); //storing file in image file
    $type = $_POST["category"]; 
    $c = "INSERT INTO `productdetails`(`name`, `details`, `image`, `category`) VALUES ('$name','$details','$imagename','$type')";
    $query2 = mysqli_query($con,$c);
    if($query2)
    {
         echo '<script>alert("new product is added")</script>';
        echo '<script>window.location="viewaproduct.php"</script>';
    }
    else{
      echo '<script>alert(" new product is ")</script>';
      echo '<script>window.location="viewaproduct.php"</script>';
}
}
            
		
    mysqli_close($con);
?>

    <?php

if(isset($_GET['del'])){
    $id = $_GET['del']; 
    $con = mysqli_connect("localhost","root","","crm");
    $sql2 = "Delete from `productdetails` where p_id = '$id'";
    $query2 = mysqli_query($con,$sql2);
         if($query2){
        echo "<script type='text/javascript'> alert('Product is deleted')</script>";
        echo '<script>window.location="viewaproduct.php"</script>';
    }
     else{
        echo "<script type='text/javascript'> alert('Error while deleting the product')</script>";
        echo '<script>window.location="viewaproduct.php"</script>';
    }
    }
    
?>
    <button class="open-button" onclick="openForm()">ADD PRODUCT</button>

<div class="form-popup" id="myForm">
    <form  class="form-container"  method="POST" action="viewaproduct.php" enctype="multipart/form-data">
            <label><b>Product Name</b></label><br/>
            <input name="name" type="text" class="form-login"  placeholder="Product Name" required><br />
            <label><b>Product Details </b></label><br/>
            <textarea name="details" class="form-message" placeholder="Product Details" row="10" required></textarea><br />
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
            </select>
             <label><b>Product Picture</b></label>
            <input type="file" alt="pro-pic" name="profilepic" class="form-control" required><br />
              <button name="add" type="submit" class="btn">ADD</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
        </form>
</div>

<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
</body>

</html>