<?php
include './database/connection.php';

// Get user query
if(isset($_POST['userId'])){
   $user_id = $_POST['userId'];

   $sql = "select * from `users` where id = $user_id";

   $result = mysqli_query($con,$sql);

   $response = [];

   while($row = mysqli_fetch_assoc($result)){
       $response = $row;
   }

   echo json_encode($response);
} else{
    $response['status'] = 200;
    $response['message'] = "Invalid or data not found";
}


//Update query

if(isset($_POST['hiddenData'])){
    $uniqueId = $_POST['hiddenData'];
    $name = $_POST['updateName'];
    $email = $_POST['updateEmail'];
    $mobile = $_POST['updateMobile'];
    $residence = $_POST['updateResidence'];

    $sql = "update `users` set name='$name', email='$email',mobile='$mobile',residence='$residence' where id = $uniqueId";

    $result = mysqli_query($con,$sql);
}
?>