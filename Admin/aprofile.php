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
            <li><a href="viewstaff.php"><i class='fas fa-business-time' style='font-size:20px'></i>UPDATE OR ADD STAFFS</a></li>
            <li><a href="viewaproduct.php"><i class='fas fa-business-time' style='font-size:20px'></i>UPDATE OR ADD PRODUCTS</a></li>
            <li><a href="viewannoucement.php"><i class='fas fa-business-time' style='font-size:20px'></i>UPDATE OR POST ANOUCEMENTS</a></li>
            <li><a href="viewcustomer.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD APPOINTMENTS</a></li>
            <li><a href="viewappointment.php"><i class='fas fa-business-time' style='font-size:20px'></i>UPDATE APPOINTMENTS</a></li>
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
    <div class='card mb-3 container' style='margin-top: 30px; padding-left: 15px;'>
          <h2 style="text-align: center;"> New Appoinment Added </h2>
     <div class="container" style="align: center;">
         <div style="padding-left: 200px;">
 <table  class="table table-bordered" style=" width: 100%;">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Appointment ID </th>
                                            <th>Customer Name</th>
											<th>Contact Information</th>
                                            <th>Product Details</th>
											<th>Subject</th>
                                            <th>Details</th>
                                             <th>Assign To</th>
                                            <th>Assign</th>
                                        </tr>
                                    </thead>
                                    <tbody>
            
            									<?php
            
             $sql = "select * from `appointment` where s_name='0' order by date ASC";
            $result = mysqli_query($con, $sql);
                if(mysqli_num_rows($result)>0)
                {
                                           while($row = mysqli_fetch_assoc($result))
                                {
                                    ?>
                    <tr>
                        <td><?php echo $row["ap_id"];?></td>
                         <td><?php echo $row["c_name"];?></td>
                         <td>Phone Number: <?php echo $row["c_phone"];?>
                             Email: <?php echo $row["c_phone"];?>
                        </td>
                         <td> <?php echo $row["product"];?> <br/>
                        Product Category: <?php echo $row["productcategory"];?> 
                        </td>
                         <td> <?php echo $row["subject"];?> </td>
                        <td> <?php echo $row["details"];?> </td>
                        <td><?php if($row["s_name"] != 0) 
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
                         <td><a href="assignappointment.php?edi=<?php echo $row["a_id"];?>" class="btn btn-primary" style="text-align: right; font-family: cursive" class="btn text-danger">Assign</a></td>

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
