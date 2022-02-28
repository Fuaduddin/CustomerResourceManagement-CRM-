<!DOCTYPE html>
<html>

<head>
    <title>Your Awosome Company</title>
</head>
<body>
    <div id="result" style="padding-left: 10px; align-content: center;">
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
                         <th>Update</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                      $con = mysqli_connect("localhost","root","","crm");
                          if(isset($_POST["search"]))
                {
                 $search = $_POST["search"];
                $query = " SELECT * FROM customer WHERE `name` LIKE '%".$search."%' OR `phone` LIKE '%".$search."%'  OR email LIKE '%".$search."%'  OR user_id LIKE '%".$search."%' ";
                $result = mysqli_query($con,$query);
               if(mysqli_num_rows ($result) > 0)
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
                        <td><button class="btn btn-primary" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Appointment</button></td>

                    </tr>
                    <?php
                                }
                }
                          }
    
            ?>

                </tbody>
            </table>
        </div>
    </div>
    </div>
</body>

</html>
