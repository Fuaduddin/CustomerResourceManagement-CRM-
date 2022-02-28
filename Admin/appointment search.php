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

                       <th>Appointment ID</th>
                        <th>Customer Details</th>
                         <th>Product Details </th>
                         <th>Appointment Details </th>
                         <th>Appointment Piroty</th>
                         <th>Assign To</th>
                         <th>Assignment Details </th>
                         <th>Assignment Update </th>
                        <th>Cancle</th>
                        <th>Update</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                      $con = mysqli_connect("localhost","root","","crm");
                          if(isset($_POST["search"]))
                {
                 $search = $_POST["search"];
                $query = " SELECT * FROM `appointment` WHERE `ap_id` LIKE '%".$search."%' OR `c_name` LIKE '%".$search."%'  OR `date` LIKE '%".$search."%' OR `c_email` LIKE '%".$search."%' ";
                $result = mysqli_query($con,$query);
        if(mysqli_num_rows($result)>0 )
                {
                
                                           
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    ?>
                    <tr>
                        <td><?php echo $row["ap_id"];?></td>
                        <td > Name: <?php echo $row["c_name"];?><br/>
                            Email: <?php echo $row["c_email"];?> <br/>
                            Phone NUmber<?php echo $row["c_phone"];?>
                        </td>
                        <td ><?php echo $row["product"];?><br/>
                            <?php echo $row["productcategory"];?><br/>
                        </td>
                         <td>Subject: <?php echo $row["subject"];?>
                        <?php echo $row["details"];?>
                        </td>
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
                        <td><?php if($row["s_name"] !='0') 
                                    {
                                       echo "Name: " .$row["s_name"]."<br/>";
                                        echo "Email: ".$row["s_email"];
                                    }
                            ?>
                        </td>
                          <td><?php if($row["date"] !=0) 
                                    {
                                       echo "Date: ".$row["date"]."<br/>";
                                       echo "Time: ".$row["time"];
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
                           <td><a href="updateappointment.php?edi=<?php echo  $row["a_id"];?>" class="btn btn-primary" style="text-align: right; font-family: cursive" class="btn text-danger">Update</a></td>

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
