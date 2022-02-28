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

                       <th>Subject</th>
                        <th>Details</th>
                        <th>Published Date</th>
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
                $query = " SELECT * FROM `announcement`  WHERE `subject` LIKE '%".$search."%' OR `date` LIKE '%".$search."%'  ";
                $result = mysqli_query($con,$query);
        if(mysqli_num_rows($result)>0 )
                {
                
                            
                                while($row = mysqli_fetch_assoc($result))
                                {
                            ?>
                    <tr>
                        <td ><?php echo $row["subject"];?> </td>
                        <td> <?php echo $row["body"];?> </td>
                        <td> <?php echo $row["date"];?></td>

                         <td><a href="viewannoucement.php?del=<?php echo $row["a_id"];?>" class="btn btn-primary" style="text-align: right; font-family: cursive" class="btn text-danger">Delete</a></td>
                          <td><a href="updateproductinfo.php?edi=<?php echo  $row["p_id"];?>" class="btn btn-primary" style="text-align: right; font-family: cursive" class="btn text-danger">Update</a></td>

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
