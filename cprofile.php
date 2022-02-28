<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
      
    <title>Your Awsome Company</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <link rel="stylesheet" href="css/profile.css">
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
            <li><a href="cappointment.php"><i class='fas fa-business-time' style='font-size:20px'></i> Appointments</a></li>
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
            <div class="container" style="text-align: center; padding-top: 20px;">
            <h1> Annoucement </h1>
        <?php
              
               $sql1 = "SELECT * FROM `announcement` ORDER BY a_id DESC limit 1";
                $query1 = mysqli_query($con,$sql1);
                if(mysqli_num_rows($query1)>0){
     
            while ($row = mysqli_fetch_assoc($query1)){
                echo "<div class='container jumbotron' style='margin-top: 30px;'>";
                echo " New Annoucement By:  "."<b><i>".$row["aname"]."</b></i>";
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
    <div class='card mb-3 container' style='margin-top: 30px; padding-left: 15px;'>
          <h1> Appoinment </h1>
     <div class="container">
 <table  class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Product</th>
											<th>Subject</th>
                                            <th>Appointment With</th>
											<th>Appointment Date</th>
                                            <th>Details</th>
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
                                        echo "<td>";
                                            echo $row["product"];
                                        echo "</td>";
                                    echo "<td>";
                                            echo $row["subject"];
                                        echo "</td>";
                                    echo "<td>";
                                            echo $row["s_name"]."<br />";
                                            echo $row["s_email"];   
                                        echo "</td>";
                                  echo "<td>";
                                            ?>
                                            <a href="blockstaff.php?del=<?php echo $row["id"];?>" style="text-align: right; font-family: cursive" class="btn text-danger">Delete</a>
                                            <?php
                                        echo "</td>";
                                        echo "<td>";
                                            ?>
                                            <a href="blockstaff.php?del=<?php echo $row["id"];?>" style="text-align: right; font-family: cursive" class="btn text-danger">Delete</a>
                                            <?php
                                        echo "</td>";
                                    echo "</tr>";
                                }
                            echo "</table>";
                        echo "</div>";
                    echo "</div>";
                }
                mysqli_close($con);
            ?>
     </tbody>
         </table>
        </div>
         
        </div>
</body>
</html>
