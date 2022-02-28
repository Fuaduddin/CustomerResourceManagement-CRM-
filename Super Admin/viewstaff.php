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
            <li><a href="viewstaff.php"><i class='fas fa-business-time' style='font-size:20px'></i>UPDATE OR ADD STAFFS</a></li>
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
   <div id="result" style="padding-left: 140px; align-content: center;">
        <div class="container ">
        <div class="shadow-4 rounded-5 overflow-hidden">
            <table id="example" class="table bg-white table-hover table-active-bg-factor table-bordered" style="width: 85%;">
                <thead class="bg-light">
                    <tr>

                        <th>Staff ID</th>
                        <th>Staff</th>
                        <th>Address</th>
                        <th>Contact Information</th>
                        <th>User Name & Password </th>
                        <th>Status</th>
                        <th>Delete</th>
                        <th>Update</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                                        $con = mysqli_connect("localhost","root","","crm");
                                        
                  $sql = "select * from staff order by name";//ORDER BY id desc
                $result = mysqli_query($con, $sql);
         if(mysqli_num_rows($result)>0 )
                {
                
                            
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    ?>
                    <tr>
                        <td>
                            <?php 
                                    if($row["s_idd"] != 0)
                                    {
                                    echo $row["s_idd"] ;
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
                         <td> <?php echo $row["phone"];?> 
                        <?php echo $row["email"];?></td>
                        <td ><?php 
                                    if($row["user"] != 0)
                                    {
                                    echo $row["user"] ;
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
                         <td><a href="viewstaff.php?del=<?php echo $row["s_id"];?>" class="btn btn-primary" style="text-align: right; font-family: cursive" class="btn text-danger">Delete</a></td>
                          <td><a href="updatestaffinfo.php?edi=<?php echo  $row["s_id"];?>" class="btn btn-primary" style="text-align: right; font-family: cursive" class="btn text-danger">Update</a></td>

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
                        url: "staffsearch.php",
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
    if(isset($_GET['del'])){
    $id = $_GET['del']; 
    $sql1 = "select user from staff where s_id= '$id'";
    $query = mysqli_query($con,$sql1); 
    $row = mysqli_fetch_assoc($query);
        $user=$row["user"];
        if(quiery1)
        {
            $sql2 = "Delete from staff where user= '$user'";
    $sql3 = "Delete from user where u_name=$user";
    $query2 = mysqli_query($con,$sql2);
    $query3 = mysqli_query($con,$sql3);
         if($query3 && $query2 ){
        echo "<script type='text/javascript'> alert('Staff is deleted')</script>";
        echo '<script>window.location="viewstaff.php"</script>';
    }
        }
     else{
        echo "<script type='text/javascript'> alert('Error while deleting the Staff')</script>";
        echo '<script>window.location="viewstaff.php"</script>';
    }
    }
    
?>      <button class="open-button" onclick="openForm()">ADD STAFF</button>

<div class="form-popup" id="myForm">
     <div>
       <form class="form-container" method="POST" action="viewstaff.php" enctype="multipart/form-data">
                        <label><b>Staff Name</b></label><br/>
                        <input name="name" type="text" class="form-login" placeholder="Full Name" required><br />
                        <label><b>Staff Email</b></label><br/>
                        <input name="email" type="text" class="form-login" placeholder="E-mail" required><br />
                        <label><b>Staff Phone Number</b></label><br/>
                        <input name="phone" type="text" class="form-login" placeholder="Phone Number" required><br />
                        <label><b>Staff Address</b></label><br/>
                        <textarea name="address" class="form-login" placeholder="Address" row="10" required></textarea><br />
                        <label><b>Gender</b></label> <br />
                        <input type="radio" class="form-login" value="male" name="gender"> Male 
                        <input type="radio" value="female" name="gender"> Female <br />
                        <label><b>Profile Picture</b></label>
                        <input type="file" alt="pro-pic" name="profilepic" class="form-control" required><br />
             <button type="submit" name="add" class="btn">ADD</button>
          <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                    </form>
</div>
    </div>
    
  <?php
          $con = mysqli_connect("localhost","root","","crm");
if(isset($_POST['add'])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $imagename = $_FILES["profilepic"]["name"]; //storing file name
    $tempimagename = $_FILES["profilepic"]["tmp_name"]; //storing temp name  
    move_uploaded_file($tempimagename,"imgs/$imagename"); //storing file in image file
    $gender = $_POST["gender"]; 
    $type = "staff";
    $status = "inactive";
     $token=bin2hex(random_bytes(15));
    $s_idd=0;
    if(strlen($phone)==11){
          $c = "INSERT INTO `staff`(`name`, `address`, `phone`, `email`,`image`, `gender`, `token`, `status`,`user`,`password`,`s_idd`) VALUES ('$name','$address','$phone','$email','$imagename','$gender','$token','$status','0','0','$s_idd')";
          $sql3 = "INSERT INTO `user`(`u_type`,`token`,`status`,`u_name`,`u_password`,`email`) VALUES ('$type','$token','$status','0','0','$email')"; 
           $query2 = mysqli_query($con,$c);
           $query3 = mysqli_query($con,$sql3);
            $subject = "Account Setup";
            $body = "Hi,$name. click on the link to active your account http://localhost/CRM/customer/confirmcode/Super%20Admin/staffuserpass.php?token=$token";
            $headers = "From: fuaduddinador@gmail.com";
          if (mail($email, $subject, $body, $headers) & $query2 & $query3 ) {
              echo '<script>alert("Email sucessfully sent ")</script>';
          } else {
             echo '<script>alert("failto sent email ")</script>';
            }

            }
        }
    else{
      echo '<script>alert("Error while adding new customer")</script>';
}	
    mysqli_close($con);
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