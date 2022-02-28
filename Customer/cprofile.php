<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
      
    <title>Your Awsome Company</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <link rel="stylesheet" href="profile.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
    <div class="header">                  
    <h1 class="page-header">
                    <?php
                    echo "<p style=' font-size: 20px; text-align: center; padding-top: 100px; color: black;'>"."Hi "."<i>".$row["name"]."</i>"." Welcome </p>";
                ?>
                        </h1>
                   </div>    
            <div class="container">
            <h1 style="text-align: center;"> Annoucement </h1>
                <div style="padding-left:80px;  width: 40%;">
        <?php
              
               $sql1 = "SELECT * FROM `announcement` ORDER BY a_id DESC limit 1";
                $query1 = mysqli_query($con,$sql1);
                if(mysqli_num_rows($query1)>0){
     
            while ($row = mysqli_fetch_assoc($query1)){
                echo "<div class='container jumbotron' style='margin-top: 30px;'>";
                echo "<hr align='left'>";
            
                echo "<div class='text-justify' style='padding-left: 50px'>";
                
                    echo "<b><i>".$row["subject"]."</b></i><br />";
               
                echo "<b><i>".$row["body"]."</b></i><br />";
                echo "Annouced on "."<b><i>".$row["date"]."</b></i><br />";
                    
                echo "</div>";
                echo "</div>";
            }
                }
                else{
                    echo "There is no ANNOUCEMENT YET";
                }
        ?>
            <hr>
        </div>
        </div>
    <div class='card mb-3 container' style='margin-top: 30px; padding-left: 15px;'>
          <h2 style="text-align: center;"> Yoy have Appoinment </h2>
     <div class="container" style="align: center;">
         <div style="padding-left: 200px;">
 <table  class="table table-bordered" style=" width: 100%;">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Appointment ID </th>
                                            <th>Product</th>
											<th>Subject</th>
                                            <th>Details</th>
                                            <th>Appointment With</th>
											<th>Appointment Date & Time</th>
                                            <th>Cancel</th>
                                        </tr>
                                    </thead>
                                    <tbody>
            
            									<?php
                                         $un = $_SESSION['username'];
              $con = mysqli_connect("localhost","root","","crm");
              $sql = "select * from customer where user = '$un' limit 1";       
              $query = mysqli_query($con,$sql); 
              $row = mysqli_fetch_assoc($query);
                                        
              $email= $row["email"];
             $sql = "select * from `appointment` where c_email='$email' and done='0' order by date ASC";
            $result = mysqli_query($con, $sql);
                if(mysqli_num_rows($result)>0)
                {
                                           while($row = mysqli_fetch_assoc($result))
                                {
                                    ?>
                    <tr>
                        <td><?php echo $row["ap_id"];?></td>
                         <td> <?php echo $row["product"];?> <br/>
                        Product Category: <?php echo $row["productcategory"];?> 
                        </td>
                         <td> <?php echo $row["subject"];?> </td>
                        <td> <?php echo $row["details"];?> </td>
                        <td><?php if($row["s_name"] !='') 
                                    {
                                       echo $row["s_name"]."<br/>";
                                        echo $row["s_email"];
                                    }
                                    else
                                    {
                                        ?>
                             <span class="badge badge-yellow rounded-pill" style=" color= yellow;"> Pending</span>
                            <?php
                                    }
                            ?>
                        </td>
                          <td><?php if($row["date"] !=0) 
                                    {
                                       echo $row["date"]."<br/>";
                                       echo $row["time"];
                                    }
                                    else
                                    {
                                        ?>
                             <span class="badge badge-yellow rounded-pill" style=" color= red;"> Pending</span>
                            <?php
                                    }
                            ?>
                        </td>
                         <td><a href="cprofile.php?del=<?php echo $row["a_id"];?>" class="btn btn-primary" style="text-align: right; font-family: cursive" class="btn text-danger">Cancle</a></td>

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
        <?php

if(isset($_GET['del'])){
    $id = $_GET['del']; 
    $con = mysqli_connect("localhost","root","","crm");
    $sql2 = "Delete from `appointment` where a_id = '$id'";
    $query2 = mysqli_query($con,$sql2);
         if($query2){
        echo "<script type='text/javascript'> alert('Appointment is canceled ')</script>";
        echo '<script>window.location="cprofile.php"</script>';
    }
     else{
        echo "<script type='text/javascript'> alert('Error while canceling appointment')</script>";
        echo '<script>window.location="cprofile.php"</script>';
    }
    }
    
?>
</body>
</html>
