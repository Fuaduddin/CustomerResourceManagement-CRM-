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
$sql = "select * from staff where user = '$un' limit 1";       
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
            <li><a href="viewcustomer.php"><i class='fas fa-business-time' style='font-size:20px'></i>ADD Appointments</a></li>
            <li><a href="viewappointment.php"><i class='fas fa-business-time' style='font-size:20px'></i>Appointments Details</a></li>
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
            <table id="example" class="table bg-white table-hover table-active-bg-factor table-bordered" style="width: 75%;">
                <thead class="bg-light">
                    <tr>

                        <th>Appointment ID</th>
                        <th>Customer Name</th>
                        <th>Contact Details</th>
                        <th>Subject </th>
                         <th>Appointment Details </th>
                         <th>Appointment Piroty</th>
                         <th>Assignment Date </th>
                        <th>Assignment Update </th>
                        <th>Cancle</th>
                        <th>Complete</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                     $un = $_SESSION['username'];
$con = mysqli_connect("localhost","root","","crm");
$sql = "select * from staff where user = '$un' limit 1";       
$query = mysqli_query($con,$sql); 
$row = mysqli_fetch_assoc($query);
                     $email= $row["email"];
                                        
                  $sql1 = "select * from `appointment` where s_email= '$email'order by done ASC";//ORDER BY id desc
                $result = mysqli_query($con, $sql1);
         if(mysqli_num_rows($result)>0 )
                {
                
                            
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    ?>
                    <tr>
                        <td><?php echo $row["ap_id"];?></td>
                        <td ><?php echo $row["c_name"];?> </td>
                        <td ><?php echo $row["c_email"];?> <br/>
                            <?php echo $row["c_phone"];?>
                        </td>
                         <td> <?php echo $row["subject"];?> </td>
                        <td> <?php echo $row["details"];?> </td>
                           <td><?php if( $row["piroty"] !='') 
                                    {
                                       echo  $row["piroty"];
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
                                       echo $row["date"];
                                    }
                                    else
                                    {
                                        ?>
                             <span class="badge badge-yellow rounded-pill" style=" color= red;"> Pending</span>
                            <?php
                                    }
                            ?>
                        </td>
                            <td><?php if($row["done"] !=0) 
                                    {
                                ?>
                                      <span class="badge badge-yellow rounded-pill" style=" color= yellow;"> Pending</span>
                                <?php   
                                }
                                    elseif($row["done"] !=1) 
                                    {
                                        ?>
                                          <span class="badge badge-yellow rounded-pill" style=" color= green;"> Complete</span>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                 <span class="badge badge-yellow rounded-pill" style=" color= red;"> Cancle</span>
                                <?php
                                    }
                                    
                            ?>
                        </td>
                         <td><a href="viewappointment.php?del=<?php echo $row["a_id"];?>" class="btn btn-primary" style="text-align: right; font-family: cursive" class="btn text-danger">Cancle</a></td>
                        <td><a href="viewappointment.php?edi=<?php echo  $row["a_id"];?>" class="btn btn-primary" style="text-align: right; font-family: cursive" class="btn text-danger">Complete</a></td>

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
    <?php

if(isset($_GET['del'])){
    $id = $_GET['del']; 
    $con = mysqli_connect("localhost","root","","crm");
    $sql2 = "UPDATE `appointment` SET `done`='2'  WHERE a_id='$id'";
    $query2 = mysqli_query($con,$sql2);
         if($query2){
        echo "<script type='text/javascript'> alert('Appointment is canceled ')</script>";
        echo '<script>window.location="viewappointment.php"</script>';
    }
     else{
        echo "<script type='text/javascript'> alert('Error while canceling appointment')</script>";
        echo '<script>window.location="viewappointment.php"</script>';
    }
    }
    
?>
    <?php
    if(isset($_GET['edi'])){
    $id = $_GET['edi']; 
    $con = mysqli_connect("localhost","root","","crm");
    $sql1= "UPDATE `appointment` SET `done`='1'  WHERE a_id='$id'";
    $query2 = mysqli_query($con,$sql1);
         if($query2){
        echo "<script type='text/javascript'> alert('Appointment is updated')</script>";
        echo '<script>window.location="viewappointment.php"</script>';
    }
     else{
        echo "<script type='text/javascript'> alert('Error while updating appointment')</script>";
        echo '<script>window.location="viewappointment.php"</script>';
    }
    }
    
?>
</body>

</html>