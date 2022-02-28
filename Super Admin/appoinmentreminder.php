<?php
$today = date("Y-m-d");
$con = mysqli_connect("localhost","root","","crm");
$sql = "Select * from appointment where due = '$today' and status = '0'"; 
   $query = mysqli_query($con,$sql);
   while($row=mysqli_fetch_array($query))
  {
     $cname= $row['customer'];
     $aname= $row['aname'];
     $cemail= $row['email'];
     $time= $row['time']; 
    $subject = "Appoinment Reminder";
    $body = "Hi,$cname. Your have an appointment with $aname. today. Your appointment time is $time. ";
    $headers = "From: fuaduddinador@gmail.com";
       mail($cemail, $subject, $body, $headers);
   }
?>
<?php
date_default_timezone_set('Asia/Dhaka');
$date=date('Y-m-d');
$today = date("Y-m-d", strtotime($date.'+1day'));
echo $today;
$con = mysqli_connect("localhost","root","","crm");
$sql = "Select * from appointment where due = '$today' and status = '0' "; 
   $query = mysqli_query($con,$sql);
   while($row=mysqli_fetch_array($query))
  {
     $cuname= $row['customer'];
     $adname= $row['aname'];
     $ademail= $row['amail'];
     $ctime= $row['time']; 
     $subject = "Appoinment Reminder";
     $body = "Hi,$adname. Your have an appointment with $cuname. today. Your appointment time is $ctime. ";
     $headers = "From: fuaduddinador@gmail.com";
    mail($ademail, $subject, $body, $headers);
  }
?>