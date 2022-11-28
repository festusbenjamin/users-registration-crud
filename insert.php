<?php
include './database/connection.php';

extract($_POST);

if(isset($_POST['sendName']) && isset($_POST['sendEmail']) && isset($_POST['sendMobile'])
 && isset($_POST['sendResidence'])){
    
    $sql = "insert into `users` (name, email, mobile, residence)
     values ('$sendName','$sendEmail','$sendMobile','$sendResidence')";
    
    $result = mysqli_query($con,$sql);
}

?>