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
   <div id="result" style="padding-left: 140px; align-content: center;">
        <div class="container ">
        <div class="shadow-4 rounded-5 overflow-hidden">
            <table id="example" class="table bg-white table-hover table-active-bg-factor table-bordered" style="width: 85%;">
                <thead class="bg-light">
                    <tr>

                        <th>Customer ID</th>
                        <th>Customer</th>
                        <th>Address</th>
                        <th>Contact Information</th>
                        <th>User Name & Password </th>
                        <th>Status</th>
                        <th>Appointment</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                                        $con = mysqli_connect("localhost","root","","crm");
                                        
                  $sql = "select * from customer order by name";//ORDER BY id desc
                $result = mysqli_query($con, $sql);
         if(mysqli_num_rows($result)>0 )
                {
                
                            
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    ?>
                    <tr>
                        <td <?php echo $row["c_id"]; $_SESSION["customerid"]= $row["c_id"];?>>
                            <?php 
                                    if($row["user_id"] != 0)
                                    {
                                    echo $row["user_id"] ;
                                    }
                                    else
                                    { ?>
                            <span class="badge badge-yellow rounded-pill" style=" color= yellow;"> Pending</span>
                            <?php
                                    }
                                    ?>
                           </td>
                        <td> <img src="<?php echo 'imgs/' . $row['image'] ?>" class="rounded-circle" alt='' style="width: 110px; height: 100px">
                           Name: <?php echo $row["name"]; ?> <br/>
                            Gender: <?php echo $row["gender"];?>
                        </td>
                        <td ><?php echo $row["address"];?> </td>
                         <td> <?php echo $row["phone"];?><br/>
                        <?php echo $row["email"];?></td>
                        <td ><?php 
                                    if($row["user"] != 0)
                                    {
                                    echo $row["user"] ."<br/>";
                                    echo $row["password"] ;
                                    }
                                    else
                                    { ?>
                            <span class="badge badge-yellow rounded-pill" style=" color= yellow;"> Pending</span>
                            <?php
                                    }
                                    ?>
                        </td>
                        <td>
                            <?php
                                    if ($row["status"]== 'active')
                                    {?>
                            <span class="badge badge-success rounded-pill" style="color= green;"> Active </span>
                            <?php
                                    }
                                    else
                                    {
                                        ?>
                            <span class="badge badge-yellow rounded-pill" style=" color= yellow;"> Inactive</span>
                            <?php
                                        
                                    }
                                    ?>

                        </td>
                        <td><a href="addapointment.php?edi=<?php echo  $row["c_id"];?>" class="btn btn-primary" style="text-align: right; font-family: cursive" class="btn text-danger">Appointment</a></td>
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
                        url: "customersearch.php",
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
        <button class="open-button" onclick="openForm()">ADD CUSTOMER</button>

<div class="form-popup" id="myForm">
                      <form class="form-container" method="POST" action="viewcustomer.php" enctype="multipart/form-data">
                        <label><b>Customer Name</b></label>
                        <input name="name" type="text" class="form-login" placeholder="Full Name" required><br />
                        <label><b>Customer Email</b></label>
                        <input name="email" type="text" class="form-login" placeholder="E-mail" required><br />
                        <label><b>Customer Phone Number</b></label>
                        <input name="phone" type="text" class="form-login" placeholder="Phone Number" required><br />
                        <label><b>Customer Address</b></label>
                        <textarea name="address" class="form-message" placeholder="Address" row="10" required></textarea><br />
                        <label><b>Gender</b></label> <br />
                        <input type="radio" value="male" name="gender"> Male
                        <input type="radio" value="female" name="gender"> Female <br />
                        <label><b>User Name</b></label>
                        <input name="user" type="text" class="form-login" placeholder="User Name" required><br />
                        <label><b>User Password</b></label>
                        <input name="password" type="password" class="form-login" placeholder="password" required><br />
                           <label><b>Confirm Password</b></label>
                        <input name="cpassword" type="password" class="form-login" placeholder="password" required><br />
                        <label><b>Profile Picture</b></label>
                        <input type="file" alt="pro-pic" name="profilepic" class="form-control" required><br />

    <button type="submit" name="add"class="btn">ADD</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>
<?php
$con = mysqli_connect("localhost","root","","crm");
if(isset($_POST['add'])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $user = $_POST["user"];
    $address = $_POST["address"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"]; 
    $imagename = $_FILES["profilepic"]["name"]; //storing file name
    $tempimagename = $_FILES["profilepic"]["tmp_name"]; //storing temp name  
    move_uploaded_file($tempimagename,"imgs/$imagename"); //storing file in image file
    $gender = $_POST["gender"]; 
    $type = "customer";
    $uid=bin2hex(random_bytes(15));
    $status = "inactive";
    $token=bin2hex(random_bytes(15)); 
    $exit= "select * from user where u_name='$user'" ;
    $query1=mysqli_query($con,$exit);
    $row = mysqli_fetch_assoc($query1);
    if(mysqli_num_rows($query1)==1)
    {
       echo '<script>alert("An account is already exist")</script>';
    }
    else{
        if($password===$cpassword)
        {
          $c = "INSERT INTO `customer`(`name`, `address`, `phone`, `email`, `password`, `image`, `user`, `gender`, `token`, `status`,`user_id`) VALUES ('$name','$address','$phone','$email','$password','$imagename','$user','$gender','$token','$status','$uid')";
          $sql3 = "INSERT INTO `user`(`u_name`, `u_password`, `u_type`,`token`,`status`) VALUES ('$user','$password','$type','$token','$status')"; 
           $query2 = mysqli_query($con,$c);
           $query3 = mysqli_query($con,$sql3);
            $subject = "Account Activation";
            $body = "Hi,$name. click on the link to active your account http://localhost/CRM/customer/activation.php?token=$token";
            $headers = "From: fuaduddinador@gmail.com";

          if (mail($email, $subject, $body, $headers)) {
              echo '<script>alert("Email sucessfully sent ")</script>';
          } else {
             echo '<script>alert("failto sent email ")</script>';
            }

            }
            else{
               echo '<script>alert("Password does not match ")</script>';
            }
		}
        }
?>
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