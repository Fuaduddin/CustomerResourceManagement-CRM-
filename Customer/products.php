<?php
session_start();
$con = mysqli_connect("localhost","root","","crm");

if(isset($_GET['id'])){
    
    $token=$_GET['id'];
    $sql1= "select type from `productcategory` where p_id = '$token' limit 1";
    $query1 = mysqli_query($con,$sql1);
    while ($row = mysqli_fetch_assoc($query1)){
    $_SESSION['producttype']=$row['type']; 
                   }
}
?>
<!DOCTYPE html>
<html>
<head>
      
    <title>Your Awsome Company</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <link rel="stylesheet" href="profile.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.cs">
  <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
     <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
</head>
<body>
 <div class="wrapper">
    <div class="sidebar" >
        <?php 
        $un = $_SESSION['username'];
$con = mysqli_connect("localhost","root","","crm");
$sql = "select * from customer where user = '$un' limit 1";       
$query = mysqli_query($con,$sql); 
$row = mysqli_fetch_assoc($query);
        ?>
        <div class="images">
        <img src="<?php echo 'imgs/' . $row['image'] ?>" alt='Profile pic'><br /><br />
            <?php
                echo "<i style='font-size: 20px; color: white; text-align: center;'>"."<b>".$row["name"]."</i>"."</b>"."<br /><br />"; 
                echo "<i style='font-size: 14px; color: white;'>".$row["user_id"]."</i>"."<br />"; 
            ?>
         <a href="customereditprofile.php"<?php  $_SESSION['customerid']=$row["c_id"]; ?> style="text-align: right; font-family: cursive" class="btn btn-secondary">Edit Profile</a>
            </div>
        <ul style="padding-top: 3px;">
            <li><a href="cprofile.php"><i class="fas fa-home"></i>Home</a></li>
                <li>
                 <a href="#" class=" fa fa-steam-square feat-btn" style="font-size:20px"> Products
                 <span class="fas fa-caret-down first"></span>
                 </a>
                 <ul class="feat-show">
                     <?php
                     $con = mysqli_connect("localhost","root","","crm");
                     $sql1 = "SELECT * FROM `productcategory` ORDER BY p_id  ASC";
                     $query1 = mysqli_query($con,$sql1);
                   while ($row = mysqli_fetch_assoc($query1)){
                       $pid=$row['p_id'];
                       echo " <li style='font-size: 18px;  color: white; text-transform:uppercase;'><a href='http://localhost/CRM/customer/products.php?id=$pid'></li>" .$row["type"]."</a></li>";
                   }
                        ?>
                 </ul>
              </li>
            <li><a href="viewappointment.php"><i class='fas fa-business-time' style='font-size:20px'></i> Appointments</a></li>
            <li><a href="logout.php"><i class='fas fa-backward' style='font-size:20px'></i> Log Out</a></li>
        </ul> 
    </div>
</div>   
          
  	<div style="padding-top:100px;">	
    <div class="fooditems" style="text-align: center; padding-left: 250px;">
			<?php
                $type = $_SESSION['producttype'];
	            $query = "SELECT * FROM `productdetails` where category='$type ' ORDER BY name ASC";
	            $result = mysqli_query($con,$query);
	            if(mysqli_num_rows($result) > 0) {

	                while ($row = mysqli_fetch_array($result)) {

	                    ?>
	                    <div style="float:left;">

                            <div class="item"style="padding-left: 20px">
                            	<div class="foodpic">
	                                <img src="<?php echo 'imgs/' . $row['image'] ?>" width="150" height="120" alt='Profile pic' class="img-responsive"><br /><br />
	                            </div>
                                <div style=" min-width:200px; hight:100px; background-color:white;">
	                            <div class="description" style="padding-top: 5px;">
	                                <h5 class="text-info" style=" font-size: 20px; font-family: cursive;"><?php echo $row["name"]; ?></h5>
	                            </div>
                                <div class="description">
	                                <h5 class="text-info" style=" font-size: 15px; font-family: cursive;"><?php echo $row["category"]; ?></h5>
	                            </div>
	                            <div class="pricetag">
	                                <h5 class="text-danger"  style=" font-size: 15px; font-family: cursive;">Type<?php echo $row["details"]; ?></h5>
	                            </div> 
        </div>
                            </div>
	                        
	                    </div>
	                    <?php
	                }
	                
	            }
	        ?>
    </div>
         </div>
    
    </body>
</html>