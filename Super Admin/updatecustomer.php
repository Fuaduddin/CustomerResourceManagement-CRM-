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
            <table id="example" class="table bg-white table-hover table-active-bg-factor table-bordered" style="width: 90%;">
                <thead class="bg-light">
                    <tr>

                        <th>Customer ID</th>
                        <th>Customer</th>
                        <th>Address</th>
                        <th>Contact Information</th>
                        <th>User Name & Password </th>
                        <th>Status</th>
                        <th>Delete</th>
                        <th>Edit</th>

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
                        <td>
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
                        <td><a href="updatecustomer.php?del=<?php echo $row["c_id"];?>" class="btn btn-primary" style="text-align: right; font-family: cursive" class="btn text-danger">Delete</a></td>
                          <td><a href="updatecustomerinfo.php?edi=<?php echo  $row["c_id"];?>" class="btn btn-primary" style="text-align: right; font-family: cursive" class="btn text-danger">Update</a></td>

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
                        url: "ucustomersearch.php",
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
    $sql1 = "select user from customer where c_id= '$id'";
    $query = mysqli_query($con,$sql1); 
    $row = mysqli_fetch_assoc($query);
        $user=$row["user"];
        if(quiery1)
        {
            $sql2 = "Delete from customer where user= '$user'";
    $sql3 = "Delete from user where u_name=$user";
    $query2 = mysqli_query($con,$sql2);
    $query3 = mysqli_query($con,$sql3);
         if($query3 && $query2 ){
        echo "<script type='text/javascript'> alert('Customer is deleted')</script>";
        echo '<script>window.location="updatecustomer.php"</script>';
    }
        }
     else{
        echo "<script type='text/javascript'> alert('Error while deleting the Admin')</script>";
        echo '<script>window.location="updatecustomer.php"</script>';
    }
    }
    
?>
</body>

</html>