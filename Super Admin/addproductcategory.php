<?php
$con = mysqli_connect("localhost","root","","crm");
if(isset($_POST['submit'])){
    $itype= $_POST['type'];
    $sql = "INSERT INTO productcategory (type) values('$itype')";
    $query = mysqli_query($con,$sql);
    if($query)
    {
        echo "<script type='text/javascript'> alert('Your Category  Is Saved')</script>";
        echo '<script>window.location="addproductcategory.php"</script>';
    }
    else
    {
        die(mysqli_connect_error());
    }
    
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Your Awsome Company </title>
    </head>
    <body>
        <div class="login-title">
            <h1> Add Product Category</h1>
        </div>
        <div class="login-form">
            <form id="login-form" method="POST" action="addproductcategory.php" enctype="multipart/form-data">
                <input name="type" type="text" class="form-login" placeholder="Product Category Name" required><br />
                <input type="submit" name="submit" class="form-login submit" value="Add">
                
                <p style="text-align: right; font-size: 18px; font-family: cursive; color: white; padding-right: 380px">Back to <a href="updatedatabase.php" style="color: white">HOME</a></p>
            </form>
        </div>
         <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Product Category Name</th>
                                            <th>Delete</th>
								
                                            
                                        </tr>
                                    </thead>
                                    <tbody>    
									<?php
                $con = mysqli_connect("localhost","root","","crm");
    
                $sql = "SELECT * FROM `productcategory` order by type ASC";//ORDER BY id asc
                $result = mysqli_query($con, $sql);

                if(mysqli_num_rows($result)>0)
                {
                
                            
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    echo "<tr>";
                                        
                                        echo "<td>";
                                            echo $row["type"];
                                        echo "</td>";
                                        echo "<td>";
                                            ?>
                                            <a href="addproductcategory.php?del=<?php echo $row["p_id"]; $_SESSION['categoryid']= $row["p_id"];?>" style="text-align: right; font-family: cursive" class="btn text-danger">Delete</a>
                                        <?php
                                        echo "</td>";
                                    echo "</tr>";
                                }
                            echo "</table>";
                        echo "</div>";
                    echo "</div>";
                }
                else
                {
                    echo "There is no Product Category  yet.";
                }
                mysqli_close($con);
            ?>                     
                                        
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
<?php

if(isset($_GET['del'])){
    $id = $_GET['del']; 
    $con = mysqli_connect("localhost","root","","crm");
    $sql2 = "Delete from productcategory where p_id = '$id'";
    $query2 = mysqli_query($con,$sql2);
         if($query2){
        echo "<script type='text/javascript'> alert('Category is deleted')</script>";
        echo '<script>window.location="addproductcategory.php"</script>';
    }
     else{
        echo "<script type='text/javascript'> alert('Error while deleting the Category')</script>";
        echo '<script>window.location="addproductcategory.php"</script>';
    }
    }
    
?>
             
    </body>
</html>