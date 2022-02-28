<?php
$con = mysqli_connect("localhost","root","","crm");

if(isset($_GET['token'])){
    
    $token=$_GET['token'];
    $sql1= "UPDATE `customer` SET `status`='active'  WHERE token='$token'";
    $id=bin2hex(random_bytes(10));
    $sql3 = "UPDATE `customer` SET `user_id`= '$id'  WHERE token='$token'";
    $sql2= "UPDATE `user` SET `status`='active'  WHERE token='$token'";
     $sql4 = "UPDATE `user` SET `user_id`= '$id'  WHERE token='$token'";
    $query1 = mysqli_query($con,$sql1);
    $query2 = mysqli_query($con,$sql2);
    $query3 = mysqli_query($con,$sql3);
    $query4 = mysqli_query($con,$sql4);
    if($query1 && $query2 && $query3 && $query4){
         echo '<script>alert("Your Account have been activated")</script>';
        header('location:login.php');    
    }
    else{
        
          echo '<script>alert("failto activate your account ")</script>';
        header('location:customerregistr.php');  
    }
}
?>